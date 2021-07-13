<?php
namespace app\src;

class routeCollection{
    protected $routes_POST = [];
    protected $routes_GET = [];
    protected $routes_PUT = [];
    protected $routes_DELETE = [];
    protected $route_names = [];

    public function add($request_type, $pattern, $callback){
        switch($request_type){
            case 'post':
                return $this->addPOST($pattern, $callback);
                break;

            case 'get':
                return $this->addGET($pattern, $callback);
                break;

            case 'put':
                return $this->addPUT($pattern, $callback);
                break;
                
            case 'delete':
                return $this->addDELETE($pattern, $callback);
                break;
            
            default:
                throw new \Exception('Requisição não encontrada!');                
        }
    }

    public function where($request_type, $pattern){
        switch ($request_type){
            case 'post':
                return $this->findPOST($pattern);
                break;

            case 'get':
                return $this->findGET($pattern);
                break;

            case 'put':
                return $this->findPUT($pattern);
                break;

            case 'delete':
                return $this->findDELETE($pattern);
                break;

            default:
                throw new \Exception('Requisição não encontrada!');
        }

    }

    protected function parseURI($URI){
        return implode('/', array_filter(explode('/', $URI)));
    }

    protected function findPOST($pattern_sent){
        $pattern_sent = $this->parseUri($pattern_sent);
        
        foreach($this->routes_POST as $pattern => $callback){         
            if(preg_match($pattern, $pattern_sent, $pieces)){
                return (object) ['callback' => $callback, 'uri' => $pieces];
            }
        }
        return false;
    }
 
 
    protected function findGET($pattern_sent){
        $pattern_sent = $this->parseUri($pattern_sent);
 
        foreach($this->routes_GET as $pattern => $callback){         
            if(preg_match($pattern, $pattern_sent, $pieces)){
                return (object) ['callback' => $callback, 'uri' => $pieces];
            }
        }
        return false;
    }
 
 
    protected function findPUT($pattern_sent){
        $pattern_sent = $this->parseUri($pattern_sent);
 
        foreach($this->routes_PUT as $pattern => $callback){         
            if(preg_match($pattern, $pattern_sent, $pieces)){
                return (object) ['callback' => $callback, 'uri' => $pieces];
            }
        }
        return false; 
    }
 
 
    protected function findDELETE($pattern_sent){
        $pattern_sent = $this->parseUri($pattern_sent);
 
        foreach($this->routes_DELETE as $pattern => $callback){         
            if(preg_match($pattern, $pattern_sent, $pieces)){
                return (object) ['callback' => $callback, 'uri' => $pieces];
            }
        }
        return false;
    }

    protected function definePattern($pattern){ 
        $pattern = implode('/', array_filter(explode('/', $pattern)));
        $pattern = '/^' . str_replace('/', '\/', $pattern) . '$/';
     
        if (preg_match("/\{[A-Za-z0-9\_\-]{1,}\}/", $pattern)) {
            $pattern = preg_replace("/\{[A-Za-z0-9\_\-]{1,}\}/", "[A-Za-z0-9]{1,}", $pattern);
        }     
        return $pattern;     
    }

    public function isThereAnyHow($name){
        return $this->route_names[$name] ?? false;
    }

    protected function addPOST($pattern, $callback){
        if (is_array($pattern)) {             
            $settings = $this->parsePattern($pattern);             
            $pattern = $settings['set'];
        } 
        else{             
            $settings = [];
        }
        $values = $this->toMap($pattern);

        $this->routes_POST[$this->definePattern($pattern)] = ['callback' => $callback,
                                                             'values' => $values,
                                                             'namespace' => $settings['namespace'] ?? null];
        if (isset($settings['as'])){
            $this->route_names[$settings['as']] = $pattern;
        }
        return $this;     
    }
     
    protected function addGET($pattern, $callback){         
        if (is_array($pattern)) {             
            $settings = $this->parsePattern($pattern);             
            $pattern = $settings['set'];
        } 
        else{             
            $settings = [];
        }     
        $values = $this->toMap($pattern);         
        $this->routes_GET[$this->definePattern($pattern)] = ['callback' => $callback,
                                                             'values' => $values,
                                                             'namespace' => $settings['namespace'] ?? null];
        if (isset($settings['as'])){
            $this->route_names[$settings['as']] = $pattern;
        }
        return $this;     
    }
     
    protected function addPUT($pattern, $callback){         
        if (is_array($pattern)){             
            $settings = $this->parsePattern($pattern);             
            $pattern = $settings['set'];
        } 
        else{             
            $settings = [];
        }     
        $values = $this->toMap($pattern);         
        $this->routes_PUT[$this->definePattern($pattern)] = ['callback' => $callback,
                                                             'values' => $values,
                                                             'namespace' => $settings['namespace'] ?? null];
        if (isset($settings['as'])){
            $this->route_names[$settings['as']] = $pattern;
        }
        return $this;     
    }
     
    protected function addDELETE($pattern, $callback){     
        if (is_array($pattern)){             
            $settings = $this->parsePattern($pattern);             
            $pattern = $settings['set'];
        } 
        else{             
            $settings = [];
        }     
        $values = $this->toMap($pattern);     
        $this->routes_DELETE[$this->definePattern($pattern)] = ['callback' => $callback,
                                                             'values' => $values,
                                                             'namespace' => $settings['namespace'] ?? null];
        if (isset($settings['as'])){
            $this->route_names[$settings['as']] = $pattern;
        }
        return $this;     
    }

    protected function strposarray(string $haystack, array $needles, int $offset = 0){
        $result = false;
        if(strlen($haystack) > 0 && count($needles) > 0){
            foreach($needles as $element){
                $result = strpos($haystack, $element, $offset);
                if($result !== false){
                    break;
                }
            }
        }
        return $result;
    }

    protected function toMap($pattern){    
        $result = [];    
        $needles = ['{', '[', '(', "\\"];    
        $pattern = array_filter(explode('/', $pattern));

        foreach($pattern as $key => $element){
            $found = $this->strposarray($element, $needles);
    
            if($found !== false){
                if(substr($element, 0, 1) === '{'){
                    $result[preg_filter('/([\{\}])/', '', $element)] = $key - 1;
                } 
                else{
                    $index = 'value_' . !empty($result) ? count($result) + 1 : 1;
                    array_merge($result, [$index => $key - 1]);
                }
            }
        }
        return count($result) > 0 ? $result : false;
    }

    protected function parsePattern(array $pattern){
        // Define the pattern
        $result['set'] = $pattern['set'] ?? null;
    
        // Allows route name settings
        $result['as'] = $pattern['as'] ?? null;
    
        // Allows new namespace definition for Controllers
        $result['namespace'] = $pattern['namespace'] ?? null;
        return $result;
    }
}

?>