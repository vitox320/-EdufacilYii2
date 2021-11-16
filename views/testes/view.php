<?php

use app\models\TesteQuestoes;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TestesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Testes';

?>
<div class="testes-index">

    <div class="row mb-5">
        <div class="col-md-12 text-center">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>

    </div>

    <?php ActiveForm::begin([
        "id" => "form-avaliacao"
    ]); ?>

    <?= Html::hiddenInput("id_teste", $id_teste) ?>
    <?php $alternativaNameCount = 0; ?>
    <?php foreach ($enunciados as $enunciado): ?>
        <div class="container bg-white p-5 mt-5 shadow">
            <div class="row">
                <div class="col-md-12">
                    <p class="text-justify">
                        <?= $enunciado["enu_nom_enunciado"] ?>
                    </p>
                </div>

            </div>
            <?php $alternativas = TesteQuestoes::find()->where(["tqu_id_enu" => $enunciado["enu_id_enu"]])->all(); ?>

            <div class="alternativas">
                <?php
                $alternativaNameCount++
                ?>
                <?php foreach ($alternativas as $testeQuestoes): ?>

                    <div class="row">
                        <div class="col-md-12 mt-3">
                            <input type="radio" name="gabaritos<?= $alternativaNameCount ?>[]"
                                   id="<?= $testeQuestoes["tqu_id_tqu"] ?>"
                                   value="<?= $testeQuestoes["tqu_gabaritos"] ?>"> <?= $testeQuestoes["tqu_alternativa"] ?>
                        </div>
                    </div>
                <?php endforeach; ?>

            </div>
        </div>
    <?php endforeach; ?>

    <div class="row">
        <div class="col-md-12 text-right mt-3">
            <button type="submit" class="btn-lg btn-info ">Terminar Teste</button>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
</div>
