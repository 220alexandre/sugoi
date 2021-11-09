<?php
require "../../Includes/conectdb.php";

$recompensa = $connection->run("SELECT * FROM tb_campanha WHERE tripulacao_id = ?", "i", array($userDetails->tripulacao["id"]))->count();
if ($recompensa) {
    $protector->exit_error("Você já recebeu sua recompensa");
}
$connection->run("UPDATE tb_usuarios SET campanha_enies_lobby =  1 WHERE id = ?",
        "i", array($userDetails->tripulacao["id"]));

        $connection->run("INSERT INTO tb_campanha (tripulacao_id) VALUE (?)",
    "i", array($userDetails->tripulacao["id"]));