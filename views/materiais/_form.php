<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Materiais */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="materiais-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'mat_tiulo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mat_link')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mat_dat_cadastro')->textInput() ?>

    <?= $form->field($model, 'mat_id_tur')->textInput() ?>

    <?= $form->field($model, 'mat_teste')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
