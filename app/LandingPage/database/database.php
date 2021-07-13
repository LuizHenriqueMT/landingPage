<?php

//Configuração da base de dados
$host = "localhost";
$database = "id14076746_landingpage"; //Nome do banco de dados
$user = "id14076746_lucas"; //Nome do usuario do banco de dados
$password = "Lucas#trafego2021"; //Senha do usuario do banco de dados

//Conectando no banco de dados
$conexao = mysqli_connect($host, $user, $password, $database);

//Erro ao conectar no banco de dados
if (!$conexao){
    die ("Não foi possível conectar com o banco de dados: ".mysqli_connect_error()."</br>");
}

function pegarUltimoCodigo(){
    //Conecta ao banco determinado
    $conexao = mysqli_connect("localhost", "id14076746_landingpage", "Lucas#trafego2021", "id14076746_lucas");
    
    //Query para inserir dados
    $sql = 
        "INSERT INTO teste (
            nome_completo,
            email,
            celular,
            nome_empresa,
            atuacao_empresa,
            instagram_empresa,
            site_empresa,
            pergunta_funciona,
            pergunta_objetivo,
            pergunta_investe_trafego,
            pergunta_valor_mensal,
            pergunta_valor_disponivel,
            pergunta_faturamento_mensal,
            pergunta_valor_investir) 
        VALUES (
            '$_POST[nome]',
            '$_POST[email]',
            '$_POST[mensagem]'
        )";        

    //Inserindo os dados na tabela        
    if (mysqli_query($conexao, $sql)){
        echo ("Suas informações foram salvas com sucesso! </br>");
    }
    else{
        echo ("Ops, ocorreu um erro ao salvar suas informações: ".mysqli_error($conexao)."</br>");               
    }

    //Finalizando conexão com banco de dados
    mysqli_close($conexao);
}

?>