<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Testes */

$this->title = $model->tes_id_tes;
$this->params['breadcrumbs'][] = ['label' => 'Testes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="testes-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'tes_id_tes' => $model->tes_id_tes], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'tes_id_tes' => $model->tes_id_tes], [
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
            'tes_id_tes',
            'tes_nome_teste',
            'tes_id_tur',
            'tes_valor_teste',
            'tes_unidade_teste',
        ],
    ]) ?>

</div>
