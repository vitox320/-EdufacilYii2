<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Materiais */

$this->title = 'Update Materiais: ' . $model->mat_id_mat;
$this->params['breadcrumbs'][] = ['label' => 'Materiais', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->mat_id_mat, 'url' => ['view', 'mat_id_mat' => $model->mat_id_mat]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="materiais-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
