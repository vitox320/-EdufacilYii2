<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AlunosSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="alunos-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'alu_id_alu') ?>

    <?= $form->field($model, 'alu_nome_alunos') ?>

    <?= $form->field($model, 'alu_email_alunos') ?>

    <?= $form->field($model, 'alu_senha_alunos') ?>

    <?= $form->field($model, 'alu_id_tur') ?>

    <?php // echo $form->field($model, 'alu_id_pro') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
