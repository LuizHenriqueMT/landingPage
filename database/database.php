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
    $conexao = mysqli_connect("localhost", "id14076746_lucas", "Lucas#trafego2021","id14076746_landingpage");

    //Query para inserir dados
    $sql = 
        "INSERT INTO landingPage (
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
            '$_POST[nome_completo]',
            '$_POST[email]',
            '$_POST[celular]',
            '$_POST[nome_empresa]',
            '$_POST[atuacao_empresa]',
            '$_POST[instagram_empresa]',
            '$_POST[site_empresa]',
            '$_POST[pergunta_funciona]',
            '$_POST[pergunta_objetivo]',
            '$_POST[pergunta_investe_trafego]',
            '$_POST[pergunta_valor_mensal]',
            '$_POST[pergunta_valor_disponivel]',
            '$_POST[pergunta_faturamento_mensal]',
            '$_POST[pergunta_valor_investir]'
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