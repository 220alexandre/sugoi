<?php
$pagina = 1;
$topicos_por_pagina = 1;

if (isset($_GET["pagina"]) && validate_number($_GET["pagina"])) {
    $pagina = $_GET["pagina"];
}
?>
<div class="panel-heading">
    Tripulaçoes
</div>

    <div class="panel-body">
    <?php $trip = $connection->run("SELECT * FROM tb_usuarios ORDER BY reputacao_mensal desc ")->fetch_all_array(); ?>
    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th width="50" class="text-center">Id</th>
            <th width="10" class="text-center">Conta Id</th>
            <th width="2">Tripulaçao</th>
            <th width="2">Berries</th>
            <th width="2">ADM</th>
            <th width="2">Vitorias</th>
            <th width="2">reputacao_mensal</th>
            <th width="2">reputacao</th>


        </tr>
        </thead>
        <tbody>
        <?php foreach ( $trip as $tripulacao): ?>
            <tr>
            <td style="vertical-align: middle;" class="text-center"><?php echo $tripulacao['id'] ?></td>
            <td style="vertical-align: middle;" class="text-center"><?php echo $tripulacao['conta_id'] ?></td>
            <td style="vertical-align: middle;" class="text-center"><?php echo $tripulacao['tripulacao'] ?></td>
            <td style="vertical-align: middle;" class="text-center"><?php echo $tripulacao['berries'] ?></td>
            <td style="vertical-align: middle;" class="text-center"><?php echo $tripulacao['adm'] ?></td>
            <td style="vertical-align: middle;" class="text-center"><?php echo $tripulacao['vitorias'] ?></td>
            <td style="vertical-align: middle;" class="text-center"><?php echo $tripulacao['reputacao_mensal'] ?></td>
            <td style="vertical-align: middle;" class="text-center"><?php echo $tripulacao['reputacao'] ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

</div>