<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Materiais */

$this->title = $model->mat_id_mat;
$this->params['breadcrumbs'][] = ['label' => 'Materiais', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="materiais-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'mat_id_mat' => $model->mat_id_mat], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'mat_id_mat' => $model->mat_id_mat], [
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
            'mat_id_mat',
            'mat_tiulo',
            'mat_link',
            'mat_dat_cadastro',
            'mat_id_tur',
            'mat_teste',
        ],
    ]) ?>

</div>
