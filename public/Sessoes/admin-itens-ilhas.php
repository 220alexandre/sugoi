<style type="text/css">
    .equipamentos_casse_1 {
        color: white;
    }
</style>
<div class="panel-heading">
    Reagents
</div>

<div class="panel-body">
    <?php $equipamentos = $connection->run("SELECT * FROM tb_ilha_itens")->fetch_all_array(); ?>
    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th width="50" class="text-center">Ilha</th>
            <th th width="50" class="text-center">Item</th>
            <th width="50" class="text-center">tipo_item</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ( $equipamentos as $equipamento): ?>
            <tr>
                <td style="vertical-align: middle;" class="text-center"><?php echo $equipamento['ilha'] ?></td>
                <td style="vertical-align: middle;" class="text-center"><?php echo $equipamento['cod_item'] ?></td>
                <td style="vertical-align: middle;" class="text-center"><?php echo $equipamento['tipo_item'] ?></td>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>