<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TestesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Testes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="testes-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Testes', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'tes_id_tes',
            'tes_nome_teste',
            'tes_id_tur',
            'tes_valor_teste',
            'tes_unidade_teste',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
