<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TestesQuestoesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Teste Questoes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teste-questoes-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Teste Questoes', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'tqu_id_tqu',
            'tqu_enunciado',
            'tqu_alternativa',
            'tqu_gabaritos',
            'tqu_valor',
            //'tqu_id_tes',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
