<div class="panel-heading">
    Loja VIP
</div>

<div class="panel-body">
    <?= ajuda("Loja VIP", "Aqui você consegue comprar recompensas exclusivas por Ouro"); ?>

    <h3>
        Você possui <?= mascara_numeros_grandes($userDetails->conta["gold"]) ?>
        <img src="Imagens/Icones/Gold.png"> de Ouro para gastar
    </h3>
    <?php
    $recompensas = DataLoader::load("loja_gold");

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
                                <img src="Imagens/Itens/<?= $reagents[$recompensa["cod_item"]]["img"] ?>.png">
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
                    <img src="Imagens/Icones/Gold.png">
                </p>
                <?php $recompensado = $connection->run("SELECT count(*) AS total FROM tb_evento_amizade_recompensa WHERE tripulacao_id = ? AND recompensa_id = ?",
                        "ii", array($userDetails->tripulacao["id"], $id))->fetch_array()["total"]; ?>

                <p>
                    
                    <button class="btn btn-success link_confirm" href="Eventos/vip.php?rec=<?= $id ?>"
                            data-question="Deseja comprar este item?"
                        <?= $userDetails->conta["gold"] >= $recompensa["preco"] ? "" : "disabled" ?>>
                        Comprar
                    </button>
                </p>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php function render_vantagem($img, $titulo, $descricao, $duracao, $preco_gold, $preco_dobrao, $link_gold, $link_dobrao) { ?>
    <?php global $userDetails; ?>
    <li class="list-group-item">
        <div class="row">
            <div class="col-xs-2 col-md-2">
                <img src="Imagens/Vip/<?= $img ?>" height="60px"/>
            </div>
            <div class="col-xs-7 col-md-7">
                <h4><?= $titulo ?></h4>
                <p><?= $descricao ?></p>
                <?php if ($duracao === FALSE): ?>
                    <p>
                        Instantâneo
                    </p>
                <?php else: ?>
                    <?php if ($duracao == 0 OR $duracao < atual_segundo()) : ?>
                        <p>
                            Duração: 30 dias
                        </p>
                    <?php else : ?>
                        <p class="text-success">
                            <i class="fa fa-check"></i> <span>Você já possui essa vantagem!</span>
                        </p>
                        <p>
                            Tempo Restante: <?= transforma_tempo_min($duracao - atual_segundo()) ?>
                        </p>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
            <div class="col-xs-3 col-md-3">
                <p>
                    <button href="<?= $link_gold ?>" class="link_confirm btn btn-success"
                            data-question="Deseja adquirir essa vantagem?"
                        <?= $userDetails->conta["gold"] < $preco_gold ? "disabled" : "" ?>>
                        <?= $preco_gold ?> <img src="Imagens/Icones/Gold.png"/>
                        <?= $duracao !== FALSE && ($duracao >= atual_segundo()) ? "Extender" : "Comprar" ?>
                    </button>
                </p>
                <p>
                    <button href="<?= $link_dobrao ?>" class="link_confirm btn btn-info"
                            data-question="Deseja adquirir essa vantagem?"
                        <?= $userDetails->conta["dobroes"] < $preco_dobrao ? "disabled" : "" ?>>
                        <?= $preco_dobrao ?> <img src="Imagens/Icones/Dobrao.png"/>
                        <?= $duracao !== FALSE && ($duracao >= atual_segundo()) ? "Extender" : "Comprar" ?>
                    </button>
                </p>
            </div>
        </div>
    </li>
<?php } ?>

<script type="text/javascript">
    $(function () {
        $("#renomeia_trip").click(function () {
            bootbox.prompt('Escreva um novo nome para sua tripulação:', function (input) {
                if (input) {
                    sendGet('Vip/reset_tripulacao.php?nome=' + input);
                }
            });
        });
        $("#renomeia_trip_dobrao").click(function () {
            bootbox.prompt('Escreva um novo nome para sua tripulação:', function (input) {
                if (input) {
                    sendGet('VipDobroes/reset_tripulacao.php?nome=' + input);
                }
            });
        });
    });
</script>
<div class="panel-body">

    <ul class="list-group">
        <?php render_vantagem(
            "tatics.png",
            "Táticas",
            "Defina uma posição fixa para cada tripulante antes de combates.",
            $userDetails->vip["tatic_duracao"],
            PRECO_GOLD_TATICAS,
            PRECO_DOBRAO_TATICAS,
            "Vip/tatics_comprar.php",
            "VipDobroes/tatics_comprar.php"
        ); ?>

        <?php render_vantagem(
            "luneta.png",
            "Luneta",
            "Aumenta o campo de visão no oceano em um quadro em cada direção.",
            $userDetails->vip["luneta_duracao"],
            PRECO_GOLD_LUNETA,
            PRECO_DOBRAO_LUNETA,
            "Vip/luneta_comprar.php",
            "VipDobroes/luneta_comprar.php"
        ); ?>

        <?php render_vantagem(
            "img.png",
            "Formações de tripulantes",
            "Permite criar e ativar formações de tripulantes fora do barco.",
            $userDetails->vip["formacoes_duracao"],
            PRECO_GOLD_USAR_FORMACOES,
            PRECO_DOBRAO_USAR_FORMACOES,
            "Vip/formacao_comprar.php?tipo=gold",
            "Vip/formacao_comprar.php?tipo=dobrao"
        ); ?>

        <?php /*render_vantagem(
            "atributos.png",
            "Conhecimento estratégico",
            "Permite ver os atributos, experiência de profissão, categoria de akuma e score dos seus tripulantes durante um combate. Exibe também os atributos dos personagens ao clicar nos respectivos cartazes de procurado no topo da tela.",
            $userDetails->vip["conhecimento_duracao"],
            PRECO_GOLD_CONHECIMENTO,
            PRECO_DOBRAO_CONHECIMENTO,
            "Vip/conhecimento_comprar.php?tipo=gold",
            "Vip/conhecimento_comprar.php?tipo=dobrao"
        );*/ ?>

        <?php render_vantagem(
            "coup-de-burst.gif",
            "Pacote de Coup De Burst diário",
            "Reduz em 10 segundos o tempo necessário para navegar 1 quadro da rota traçada. Pode ser usado 5 vezes por dia. Não pode ser usado se você estiver invisível. Não pode ser usado duas vezes no mesmo quadro.",
            $userDetails->vip["coup_de_burst_duracao"],
            PRECO_GOLD_COUP_DE_BURST,
            PRECO_DOBRAO_COUP_DE_BURST,
            "Vip/coup_de_burst_comprar.php?tipo=gold",
            "Vip/coup_de_burst_comprar.php?tipo=dobrao"
        ); ?>

        <?php render_vantagem(
            "ocultar.jpg",
            "Camuflagem",
            "Esconda seu navio no oceano ficando invisível para os outros jogadores. Você só estará invisível enquanto estiver parado, quando navegar voltará a ser visível.",
            FALSE,
            PRECO_GOLD_CAMUFLAGEM,
            PRECO_DOBRAO_CAMUFLAGEM,
            "Vip/ocultar.php",
            "VipDobroes/ocultar.php"
        ); ?>
        <li class="list-group-item">
            <div class="row">
                <div class="col-xs-2 col-md-2">
                    <img src="Imagens/Vip/gold_berries.png"/>
                </div>
                <div class="col-xs-7 col-md-7">
                    <h4>Trocar Moedas de Ouro por Berries</h4>
                    <p>
                        Instantâneo
                    </p>
                </div>
                <div class="col-xs-3 col-md-3">
                    <p>
                        <a href="./?ses=leiloes" class="link_content btn btn-success">
                            Centro de Comércio
                        </a>
                    </p>
                </div>
            </div>
        </li>
        <li class="list-group-item">
            <div class="row">
                <div class="col-xs-2 col-md-2">
                    <img src="Imagens/Vip/renomear.png"/>
                </div>
                <div class="col-xs-7 col-md-7">
                    <h4>Renomear tripulação</h4>
                    <p>Mude o nome da sua tripulação.</p>
                    <p>
                        Instantâneo
                    </p>
                </div>
                <div class="col-xs-3 col-md-3">
                    <p>
                        <button id="renomeia_trip" class="btn btn-success"
                            <?= $userDetails->conta["gold"] < PRECO_GOLD_RENOMEAR_TRIPULACAO ? "disabled" : "" ?>>
                            <?= PRECO_GOLD_RENOMEAR_TRIPULACAO ?> <img src="Imagens/Icones/Gold.png"/> Comprar
                        </button>
                    </p>
                    <p>
                        <button id="renomeia_trip_dobrao" class="btn btn-info"
                            <?= $userDetails->conta["dobroes"] < PRECO_DOBRAO_RENOMEAR_TRIPULACAO ? "disabled" : "" ?>>
                            <?= PRECO_DOBRAO_RENOMEAR_TRIPULACAO ?> <img src="Imagens/Icones/Dobrao.png"/> Comprar
                        </button>
                    </p>
                </div>
            </div>
        </li>
        <li class="list-group-item">
            <div class="row">
                <div class="col-xs-2 col-md-2">
                    <img src="Imagens/Vip/faccao.png"/>
                </div>
                <div class="col-xs-7 col-md-7">
                    <h4>Mudar de facção</h4>
                    <p>Piratas se tornam marinheiros e Marinheiros se tornam piratas.</p>
                    <p>Não é possível trocar de facção se você fizer parte de uma Aliança ou Frota.</p>
                    <p>ATENÇÃO: Ao trocar de facção seus pontos de reputação serão resetados.</p>
                    <p>
                        Instantâneo
                    </p>
                </div>
                <div class="col-xs-3 col-md-3">
                    <p>
                        <button href="Vip/faccao_trocar.php" data-question="Deseja trocar de facção?"
                                class="link_confirm btn btn-success"
                            <?= $userDetails->ally
                            || $userDetails->conta["gold"] < PRECO_GOLD_TROCAR_FACCAO ? "disabled" : "" ?>>
                            <?= PRECO_GOLD_TROCAR_FACCAO ?> <img src="Imagens/Icones/Gold.png"/> Comprar
                        </button>
                    </p>
                    <p>
                        <button href="VipDobroes/faccao_trocar.php" data-question="Deseja trocar de facção?"
                                class="link_confirm btn btn-info"
                            <?= $userDetails->ally
                            || $userDetails->conta["dobroes"] < PRECO_DOBRAO_TROCAR_FACCAO ? "disabled" : "" ?>>
                            <?= PRECO_DOBRAO_TROCAR_FACCAO ?> <img src="Imagens/Icones/Dobrao.png"/> Comprar
                        </button>
                    </p>
                </div>
            </div>
        </li>
    </ul>
</div>