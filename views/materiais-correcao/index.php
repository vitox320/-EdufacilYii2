<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MateriaisCorrecaoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Materiais Correcaos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="materiais-correcao-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Materiais Correcao', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'mac_id_mac',
            'mac_id_alu',
            'mac_id_mat',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
