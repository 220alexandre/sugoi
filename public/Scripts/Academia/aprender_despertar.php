<?php
require "../../Includes/conectdb.php";

$protector->need_tripulacao();
$protector->must_be_out_of_any_kind_of_combat();

$pers = $protector->get_tripulante_or_exit("cod");
$cod_skill = $protector->get_number_or_exit("codskill");
$tipo_skill = $protector->get_enum_or_exit("tiposkill", array(TIPO_SKILL_ATAQUE_CLASSE, TIPO_SKILL_BUFF_CLASSE, TIPO_SKILL_PASSIVA_CLASSE));

$exists = $connection->run("SELECT * FROM tb_personagens_skil WHERE cod = ? AND cod_skil = ? AND tipo = ?",
    "iii", array($pers["cod"], $cod_skill, $tipo_skill));

if ($exists->count()) {
    $protector->exit_error("Você já possui essa habilidade");
}

if ($tipo_skill == TIPO_SKILL_ATAQUE_CLASSE) {
    $tb = "tb_skil_atk";
} else if ($tipo_skill == TIPO_SKILL_BUFF_CLASSE) {
    $tb = "tb_skil_buff";
} else {
    $tb = "tb_skil_passiva";
}

$skill = $connection->run("SELECT * FROM $tb WHERE cod_skil = ? AND despertar = 1", "i", array($cod_skill));

if (!$skill->count()) {
    $protector->exit_error("Habilidade inválida");
}

$skill = $skill->fetch_array();

if ($pers["lvl"] < $skill["requisito_lvl"]
    || $pers["despertar"] < $skill["requisito_despertar"]
    || $userDetails->tripulacao["berries"] < $skill["requisito_berries"]
    || $pers["tipo_akm"] != $skill["requisito_akuma"]
    || $pers["maestria"]
) {
    $protector->exit_error("Você não cumpre os requisitos para aprender essa habilidade");
}

$habilidade = habilidade_random();
$icon = rand(1, SKILLS_ICONS_MAX);

$connection->run("INSERT INTO tb_personagens_skil (cod, cod_skil, tipo, nome, descricao, icon) VALUE (?,?,?,?,?,?)",
    "iiissi", array($pers["cod"], $cod_skill, $tipo_skill, $habilidade["nome"], $habilidade["descricao"], $icon));

$userDetails->reduz_berries($skill["requisito_berries"]);

$response->send($pers["nome"] . " aprendeu uma nova habilidade. Visite o menu de Habilidades para customiza-la!");