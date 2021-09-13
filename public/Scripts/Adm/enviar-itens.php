<?php
require "../../Includes/conectdb.php";

$protector->need_tripulacao();

$id_trip	= $protector->post_value_or_exit('id');
$cod_item		= $protector->post_value_or_exit('cod_item');
$tipo_itemo	= $protector->post_value_or_exit('tipo_item');
$quant		= $protector->post_value_or_exit('quant');
$novo	= $protector->post_value_or_exit('novo');
$okok		= $protector->post_value_or_exit('okok');



$connection->run("INSERT INTO tb_usuario_itens (`id`, `cod_item`, `tipo_item`,`quant`, `novo`, `okok`) VALUES (?, ?, ?, ?, ?, ?)", 'iiiiii', [
	$id_trip,
    $cod_item,
    $tipo_itemo,
    $quant,
    $novo,
    $okok
	
]);
echo "Mensagem enviada com sucesso!";