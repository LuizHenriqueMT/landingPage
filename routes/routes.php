<?php

$router->get('/', function(){

});

$router->get('/contatos', function(){
    echo 'pagina de contatos';
});

$router->get('/teste/{teste}', function($teste){
 
    echo "Agora foi recebido da URI o parâmetro: " . $teste;
 
});

$router->get('/produto/{produto}/categoria/{categoria}/editar', function($produto, $categoria){
 
    echo "Recebeu => produto: " . $produto . "<br />";
    echo "Recebeu => categoria: " . $categoria . "<br />";
 
});

$router->get(['set' => '/cliente/{cliente_id}', 'as' => 'clientes.edit'], function($cliente_id){
 
    echo "Cliente => " . $cliente_id;
 
});

$router->post('/contatos/store', "controllesaddas@dsads");

?>