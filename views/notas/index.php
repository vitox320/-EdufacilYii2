<?php

use app\models\Notas;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\NotasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Notas';

?>

<div class="row">
    <div class="col-md-4">
        <h2>Minhas Notas</h2>
    </div>
</div>

<?php if (!is_null($turmas)) { ?>
    <div class="row mt-5 d-flex justify-content-between">
        <?php foreach ($turmas as $turma): ?>

            <div class="col-md-4 ">
                <label for="" style="color: #506580; "><h3><?= $turma["tur_nom_turma"]; ?></h3></label>
                <div class="shadow notas">
                    <?php $notas = Notas::buscarNotasDasTurmas($turma["tur_id_tur"],$aluno["alu_id_alu"]); ?>
                    <?php
                    $contagemNotas = 0;
                    foreach ($notas as $nota): ?>
                        <div class="informacoes-notas">
                            <h3>A<?= $nota["tes_unidade_teste"] ?? null ?> </h3>

                            <h3><?= $nota["not_valor_nota"] ?? null ?></h3>
                        </div>

                        <?php
                        $contagemNotas += $nota["not_valor_nota"];
                    endforeach; ?>

                    <div class="informacoes-notas">
                        <h3>Média</h3>
                        <?php $media = $contagemNotas / sizeof($notas) ?>
                        <h3><?= $media ?></h3>
                    </div>

                </div>
            </div>

        <?php endforeach; ?>

    </div>
<?php } ?>

<style>
    .notas {
        width: 380px;
        height: 250px;
        background-color: white;
        display: flex;
        justify-content: space-around;
        flex-direction: column;
        padding: 15px;
    }

    .informacoes-notas {
        display: flex;
        justify-content: space-between;

    }
</style>