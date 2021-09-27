<?php
$valida = "EquipeSugoiGame2012";
include "../../Includes/conectdb.php";

$protector->reject_conta();

$protector->redirect_alphanumeric_invalid($_POST["token"]);

$token = $_POST["token"];
$senha = $_POST["senha"];

$result = $connection->run(
    "SELECT 
    tb_conta.conta_id AS conta_id, 
    tb_conta.email AS email
    FROM tb_reset_senha_token 
    INNER JOIN tb_conta ON tb_reset_senha_token.conta_id = tb_conta.conta_id 
    WHERE tb_reset_senha_token.token = ?",
    "s", $token
);

if (!$result->count()) {
    $protector->redirect_error("Token invalido informado");
}

$conta = $result->fetch_array();

$connection->run(
    "UPDATE tb_conta SET senha = ? WHERE conta_id = ?",
    "si", array(password_hash($senha, PASSWORD_BCRYPT), $conta["conta_id"])
);

$connection->run("DELETE FROM tb_reset_senha_token WHERE conta_id = ?", "i", $conta["conta_id"]);


header("location:../../?msg2=Senha alterada! Efetue login para começar a jogar!");
exit;