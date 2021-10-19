<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Alunos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="alunos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'alu_nome_alunos')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'alu_email_alunos')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'alu_senha_alunos')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'alu_id_tur')->textInput() ?>

    <?= $form->field($model, 'alu_id_pro')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
