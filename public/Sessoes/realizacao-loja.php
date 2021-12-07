<div class="panel-heading">
    Evento Conquistas
</div>

<div class="panel-body">
    <?= ajuda("Loja VIP", "Aqui você consegue comprar recompensas exclusivas por Pontos de Conquista durante o evento"); ?>

    <h3>
        Você possui <?= mascara_numeros_grandes($userDetails->tripulacao["realizacoes"]) ?>
        <img src="Imagens/Icones/Recompensas.png"> Pontos de Conquistas
    </h3>
    <?php
    $recompensas = DataLoader::load("loja_realizacao");

    $reagents_db = $connection->run("SELECT * FROM tb_item_reagents")->fetch_all_array();
    $reagents = array();
    foreach ($reagents_db as $reagent) {
        $reagents[$reagent["cod_reagent"]] = $reagent;
    }
    $equipamentos_db = $connection->run("SELECT * FROM tb_equipamentos")->fetch_all_array();
    $equipamentos = array();
    foreach ($equipamentos_db as $equip) {
        $equipamentos[$equip["item"]] = $equip;
    }
    $comidas_db = $connection->run("SELECT * FROM tb_item_comida")->fetch_all_array();
    $comidas = array();
    foreach ($comidas_db as $comida) {
        $comidas[$comida["cod_comida"]] = $comida;
    }
    ?>
    <div class="row">
        <?php foreach ($recompensas as $id => $recompensa): ?>
            <div class="list-group-item col-xs-6 col-md-4">
                <?php if (isset($recompensa["haki"])): ?>
                    <p>
                        <i class="fa fa-certificate"></i>
                        <?= $recompensa["haki"] ?> pontos de Haki para toda a tripulação
                    </p>
                <?php endif; ?>
                <?php if (isset($recompensa["xp"])): ?>
                    <p>
                        <?= $recompensa["xp"] ?> pontos de experiência para toda a tripulação
                    </p>
                <?php endif; ?>
                <?php if (isset($recompensa["dobroes"])): ?>
                    <p>
                        <?= $recompensa["dobroes"] ?> <img src="Imagens/Icones/Dobrao.png">
                    </p>
                <?php endif; ?>
                <?php if (isset($recompensa["akuma"])): ?>
                    <div class="equipamentos_casse_6 pull-left">
                        <img src="Imagens/Itens/100.png">
                    </div>
                    <p>
                        Akuma no Mi aleatória
                    </p>
                <?php endif; ?>
                <?php if (isset($recompensa["alcunha"])): ?>
                    <?php $alcunha = $connection->run("SELECT * FROM tb_titulos WHERE cod_titulo = ?", "i", array($recompensa["alcunha"]))->fetch_array(); ?>
                    <p>
                        Alcunha: <?= $alcunha["nome"]; ?>
                    </p>
                <?php endif; ?>
                <?php if (isset($recompensa["img"]) && isset($recompensa["skin"])): ?>
                    <p>Aparência exclusiva</p>
                    <p>
                        <img src="Imagens/Personagens/Icons/<?= get_img(array("img" => $recompensa["img"], "skin_r" => $recompensa["skin"]), "r") ?>.jpg">
                    </p>
                    <p>
                        <img src="Imagens/Personagens/Big/<?= get_img(array("img" => $recompensa["img"], "skin_c" => $recompensa["skin"]), "c") ?>.jpg">
                    </p>
                <?php endif; ?>
                <?php if (isset($recompensa["tipo_item"])): ?>
                    <?php if ($recompensa["tipo_item"] == TIPO_ITEM_REAGENT): ?>
                        <div class="clearfix">
                            <div class="equipamentos_casse_1 pull-left">
                                <img src="Imagens/Itens/<?= $reagents[$recompensa["cod_item"]]["img"] ?>.jpg" >
                            </div>
                            <p>
                                <?= $reagents[$recompensa["cod_item"]]["nome"] ?>
                                 <?= $recompensa["quant"] ?>
                            </p>
                        </div>
                    <?php elseif ($recompensa["tipo_item"] == TIPO_ITEM_EQUIPAMENTO): ?>
                        <?= info_item_with_img($equipamentos[$recompensa["cod_item"]], $equipamentos[$recompensa["cod_item"]], FALSE, FALSE, FALSE) ?>
                    <?php elseif ($recompensa["tipo_item"] == TIPO_ITEM_COMIDA): ?>
                        <div class="clearfix">
                            <div class="equipamentos_casse_1 pull-left">
                                <img src="Imagens/Itens/<?= $comidas[$recompensa["cod_item"]]["img"] ?>.png">
                            </div>
                            <p>
                                <?= $comidas[$recompensa["cod_item"]]["nome"] ?>
                                x <?= $recompensa["quant"] ?>
                            </p>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
                <br/>
                <p>
                    Preço: <?= mascara_numeros_grandes($recompensa["preco"]) ?>
                    <img src="Imagens/Icones/Recompensas.png">
                </p>
                <p>
                    <button class="btn btn-success link_confirm" href="Eventos/realizacao-premio.php?rec=<?= $id ?>"
                            data-question="Deseja comprar este item?"
                        <?= $userDetails->tripulacao["realizacoes"] >= $recompensa["preco"] ? "" : "disabled" ?>>
                        Comprar
                    </button>
                </p>
            </div>
        <?php endforeach; ?>
    </div>
</div>