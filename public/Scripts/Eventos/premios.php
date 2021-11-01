<?php
require "../../Includes/conectdb.php";

$protector->need_tripulacao();


$recompensa = $connection->run("SELECT * FROM tb_recompensa_premios WHERE tripulacao_id = ?", "i", array($userDetails->tripulacao["id"]))->count();

if ($recompensa) {
    $protector->exit_error("Você já recebeu sua recompensa");
}

if (!$userDetails->can_add_item(4)) {
    $protector->exit_error("Você não tem espaço disponível suficiente no inventário");
}

$userDetails->add_item(121, TIPO_ITEM_REAGENT, 1);
$userDetails->add_item(208, TIPO_ITEM_REAGENT, 1);
$userDetails->add_berries(1000000);
$userDetails->add_item(143, TIPO_ITEM_ACESSORIO, 1, true);
$userDetails->add_medalha(10);


$connection->run("INSERT INTO tb_recompensa_premios (tripulacao_id) VALUE (?)",
    "i", array($userDetails->tripulacao["id"]));

echo "Você recebeu uma incrível recompensa!";
