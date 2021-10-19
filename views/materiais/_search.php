<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MateriaisSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="materiais-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'mat_id_mat') ?>

    <?= $form->field($model, 'mat_tiulo') ?>

    <?= $form->field($model, 'mat_link') ?>

    <?= $form->field($model, 'mat_dat_cadastro') ?>

    <?= $form->field($model, 'mat_id_tur') ?>

    <?php // echo $form->field($model, 'mat_teste') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
