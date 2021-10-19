<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Notas */

$this->title = $model->not_id_not;
$this->params['breadcrumbs'][] = ['label' => 'Notas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="notas-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'not_id_not' => $model->not_id_not], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'not_id_not' => $model->not_id_not], [
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
            'not_id_not',
            'not_id_tes',
            'not_id_alu',
            'not_valor_nota',
        ],
    ]) ?>

</div>
