<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MateriaisSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Materiais';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="materiais-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Materiais', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'mat_id_mat',
            'mat_tiulo',
            'mat_link',
            'mat_dat_cadastro',
            'mat_id_tur',
            //'mat_teste',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
