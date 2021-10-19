<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TesteQuestoes */

$this->title = $model->tqu_id_tqu;
$this->params['breadcrumbs'][] = ['label' => 'Teste Questoes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="teste-questoes-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'tqu_id_tqu' => $model->tqu_id_tqu], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'tqu_id_tqu' => $model->tqu_id_tqu], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'tqu_id_tqu',
            'tqu_enunciado',
            'tqu_alternativa',
            'tqu_gabaritos',
            'tqu_valor',
            'tqu_id_tes',
        ],
    ]) ?>

</div>
