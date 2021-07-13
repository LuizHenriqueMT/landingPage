<?php
namespace app\src;

use app\src\request;
use app\src\dispacher;
use app\src\routeCollection;

class router{
    protected $route_collection;

    public function __construct(){
        $this->route_collection = new routeCollection;
        $this->dispacher = new dispacher;
    }

    public function POST($pattern, $callback){
        $this->route_collection->add('post', $pattern, $callback);
        return $this;
    }

    public function GET($pattern, $callback){
        $this->route_collection->add('get', $pattern, $callback);
        return $this;
    }

    public function PUT($pattern, $callback){
        $this->route_collection->add('put', $pattern, $callback);
        return $this;        
    }

    public function DELETE($pattern, $callback){
        $this->route_collection->add('delete', $pattern, $callback);
        return $this;        
    }

    public function find($request_type, $pattern){
        return $this->route_collection->where($request_type, $pattern);
    }

    protected function dispach($route, $params, $namespace = "App\\"){     
        return $this->dispacher->dispach($route->callback, $params, $namespace);
    }

    protected function notFound(){
        return header("HTTP/1.0 404 Not Found", true, 404);
    }

    public function resolve($request){     
        $route = $this->find($request->method(), $request->uri());
        if ($route){             
            $params = $route->callback['values'] ? $this->getValues($request->uri(), $route->callback['values']) : [];     
            return $this->dispach($route, $params);
        }
        return $this->notFound();     
    }

    public function convert($pattern, $params){
        if (!is_array($params)){
            $params = array($params);
        }
 
        $positions = $this->toMap($pattern);
        if($positions === false){
            $positions = [];
        }
        $pattern = array_filter(explode('/', $pattern));
 
        if(count($positions) < count($pattern)){
            $uri = [];
            foreach($pattern as $key => $element){
                if (in_array($key - 1, $positions)){
                    $uri[] = array_shift($params);
                }
                else{
                    $uri[] = $element;
                }
            }
            return implode('/', array_filter($uri));
        }
        return false;
    }

    protected function getValues($pattern, $positions){
        $result = [];
        $pattern = array_filter(explode('/', $pattern));
 
        foreach($pattern as $key => $value){
            if(in_array($key, $positions)) {
                $result[array_search($key, $positions)] = $value;
            }
        }
        return $result;        
    }
}

?>