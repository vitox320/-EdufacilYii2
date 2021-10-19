<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Alunos */

$this->title = 'Update Alunos: ' . $model->alu_id_alu;
$this->params['breadcrumbs'][] = ['label' => 'Alunos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->alu_id_alu, 'url' => ['view', 'alu_id_alu' => $model->alu_id_alu]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="alunos-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
