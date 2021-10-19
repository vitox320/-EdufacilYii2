<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Notas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="notas-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'not_id_tes')->textInput() ?>

    <?= $form->field($model, 'not_id_alu')->textInput() ?>

    <?= $form->field($model, 'not_valor_nota')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
