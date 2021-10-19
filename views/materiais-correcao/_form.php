<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MateriaisCorrecao */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="materiais-correcao-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'mac_id_alu')->textInput() ?>

    <?= $form->field($model, 'mac_id_mat')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
