<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Professores */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="professores-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'pro_nome_professor')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pro_email_professor')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pro_senha_professor')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
