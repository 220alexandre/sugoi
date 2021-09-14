<style type="text/css">
    .equipamentos_casse_1 {
        color: white;
    }
</style>
<div class="panel-heading">
    Reagents
</div>

<div class="panel-body">
    <?php $equipamentos = $connection->run("SELECT * FROM tb_item_reagents")->fetch_all_array(); ?>
    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th width="50" class="text-center">Id</th>
            <th colspan="2">Nome</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ( $equipamentos as $equipamento): ?>
            <tr>
                <td style="vertical-align: middle;" class="text-center"><?php echo $equipamento['cod_reagent'] ?></td>
                <td style="vertical-align: middle;">
                    <span class="equipamentos_casse_<?= $equipamento["categoria"] ?>">
                    
                        <?php echo $equipamento['nome'] ?>
                    </span><br />
                    <small><?php echo $equipamento['descricao'] ?></small>
                    <td><img src="Imagens/Itens/<?= $equipamento["img"] ?>.png"/></td>
                </td>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>