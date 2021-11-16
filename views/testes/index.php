<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TestesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Atividades';

?>
<div class="testes-index">

    <div class="row mb-5">
        <div class="col-md-12 text-center">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>

    </div>

    <?php foreach ($testes as $atvTestes): ?>


        <a href="<?= Yii::$app->urlManager->createUrl(["testes/ver-teste", "id_teste" => $atvTestes["tes_id_tes"]]) ?>">
            <div class="container bg-white p-5 mt-5 shadow">
                <div class="row">
                    <div class="col-md-2">
                        <h2><?= $atvTestes["tes_id_tes"] ?></h2>
                    </div>
                    <div class="col-md-8">
                        <h2> <?= $atvTestes["tes_nome_teste"] ?></h2>
                    </div>
                    <div class="col-md-2 d-flex flex-column text-center">
                        <span><?= date('j F,Y'); ?></span>
                        <span><?= date('H:i:s'); ?></span>
                    </div>
                </div>
            </div>
        </a>
    <?php endforeach; ?>
</div>

<style>
    a {
        text-decoration: none !important;
    }

    span {
        color: #506580 !important;
        font-weight: bold;
    }
</style>