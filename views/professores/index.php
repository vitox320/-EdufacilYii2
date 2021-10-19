<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProfessoresSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Professores';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="professores-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Professores', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'pro_id_pro',
            'pro_nome_professor',
            'pro_email_professor:email',
            'pro_senha_professor',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
