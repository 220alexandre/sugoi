<div class="panel-heading">
    Pegue seus Premios
</div>


<div class="panel-body">

    <?php $recompensas = DataLoader::load("loja_recrutamento"); ?>
    <h3>Recolha os Premios:</h3>
    <h4>
        Você possui <?= $userDetails->conta["medalhas_recrutamento"] ?>
        <img src="Imagens/Icones/MoedaRecrutamento.png">
        Medalhas
    </h4>

    <div class="row">
        <?php foreach ($recompensas as $id => $recompensa): ?>
            <div class="list-group-item col-md-4">
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
                <?php if (isset($recompensa["skin_navio"])): ?>
                    <p>Aparência de navio exclusiva</p>
                    <p>
                        <?php render_navio_skin($userDetails->tripulacao["bandeira"], $userDetails->tripulacao["faccao"], $recompensa["skin_navio"]); ?>
                    </p>
                <?php endif; ?>
                <br/>
                <p>
                    <button class="btn btn-success link_confirm" href="Geral/recrutamento_comprar.php?rec=<?= $id ?>"
                            data-question="Deseja comprar este item?"
                        <?= $userDetails->conta["medalhas_recrutamento"] >= $recompensa["preco"] ? "" : "disabled" ?>>
                        Comprar
                    </button>
                </p>
            </div>
        <?php endforeach; ?>
    </div>