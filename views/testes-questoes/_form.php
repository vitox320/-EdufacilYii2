<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TesteQuestoes */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="teste-questoes-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tqu_enunciado')->textInput() ?>

    <?= $form->field($model, 'tqu_alternativa')->textInput() ?>

    <?= $form->field($model, 'tqu_gabaritos')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tqu_valor')->textInput() ?>

    <?= $form->field($model, 'tqu_id_tes')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
