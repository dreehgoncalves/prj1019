<?php
try {

    extract($_POST);

    $uf2 = strlen($uf);
    if ($uf2 > 2) {
        throw new Exception("Estado inválido");
    }

    if ($nome == '') {
        throw new Exception("O campo NOME não foi preenchido");
    }

    if ($cep == '') {
        throw new Exception("O CEP não foi preenchido");
    }

    if ($cidade == '') {
        throw new Exception("O campo CIDADE não foi preenchido");
    }

    ////$sql = "INSERT INTO ? (nome, cep, cidade, uf) values ('$nome', '$cep', '$cidade', '$uf')";
    //$res = mysqli_query($con, $sql);
    //$retorno = array();

    $retorno['resp'] = true;
    $retorno['msg'] = "Dados inseridos com sucesso";

    die(json_encode($retorno));
} catch (Exception $e) {

    $retorno = array();
    $retorno['resp'] = false;
    $retorno['msg'] = $e->getMessage();
    die(json_encode($retorno));
}
