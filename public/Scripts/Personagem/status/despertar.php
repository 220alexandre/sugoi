<?php
include "../../../Includes/conectdb.php";
$protector->need_tripulacao();
$pers_cod = $protector->get_number_or_exit("cod");

$pers = $userDetails->get_pers_by_cod($pers_cod);

if (!$pers) {
    $protector->exit_error("Personagem inválido");
}
?>

<?php $skills_classe = []; ?>

<?php render_personagem_panel_top($pers, 0) ?>
    <div class="panel panel-default">
        <div class="panel-body">
            <h4>
                O despertar é para os usuarios mais fortes de Akumas no Mi.
            </h4>
            <p>
                Apenas os tripulantes capazes de se dedicar em 100% a sua Akuma no mi podem evoluir seu Despertar!!
            </p>
            <?php if ($pers["akuma"] && $pers["tipo_akm"]) : ?>
                <?php $skills_classe = get_basic_despertar("requisito_akuma", $pers["tipo_akm"], 0, 1); ?>
                <h4>Pontos do Despertar:</h4>
                <p>Seu tripulante ganha Pontos de despertar toda vez que atacar em combate.</p>
                <div class="progress">
                    <div class="progress-bar progress-bar-warning"
                         style="width: <?= $pers["despertar"] / 50000 * 100 ?>%">
                    </div>
                    <a>
                        <?= $pers["despertar"] . " / 50000" ?>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php if ($pers["akuma"] && $pers["tipo_akm"]) : ?>
    <h4> Habilidades do Despertar</h4>
    <?php $pode_aprender_func = function ($pers, $skill) {
        global $userDetails;
        return $pers["lvl"] >= $skill["requisito_lvl"]
            AND $userDetails->tripulacao["berries"] >= $skill["requisito_berries"]
            AND $pers["tipo_akm"] == $skill["requisito_akuma"]
            AND $pers["despertar"] >= $skill["requisito_despertar"];
    }; ?>
    <?php foreach ($skills_classe as $skill): ?>
        <?php $aprendida = $connection->run("SELECT cod FROM tb_personagens_skil WHERE cod = ? AND cod_skil = ? AND tipo = ?",
            "iii", array($pers["cod"], $skill["cod_skil"], $skill["tiponum"]))->count(); ?>

        <?php if ($aprendida) continue; ?>

        <div class="row">
            <div class="col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <?= $skill["tipo"] ?> <img src="Imagens/Skils/Tipo/<?= $skill["tipo"] ?>.png">
                        <?php if ($skill["requisito_lvl"] <= $pers["lvl"] && $skill["requisito_despertar"] <= $pers["despertar"]): ?>
                            <?= get_alert() ?>
                        <?php endif; ?>
                    </div>
                    <div class="panel-body">
                        <div>
                            <h5>Requisitos:</h5>
                            <?php render_skill_requisitos($skill, $pers) ?>
                        </div>
                        <div class="visible-xs visible-sm">
                            <button class="btn btn-info"
                                    data-toggle="popover" data-html="true" data-placement="bottom" data-trigger="focus"
                                    data-content='<div style="min-width: 250px"><?php render_skill_efeitos($skill) ?></div>'>
                                Efeitos
                            </button>
                        </div>
                        <div class="hidden-xs hidden-sm text-left">
                            <h5>Efeitos:</h5>
                            <?php render_skill_efeitos($skill) ?>
                        </div>
                        <div>
                            <?php render_new_skill_form($skill, $pers, "Academia/aprender_despertar.php", $pode_aprender_func, "Aprender", true) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>
<?php render_personagem_panel_bottom(); ?>