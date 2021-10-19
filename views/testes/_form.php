<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Testes */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="testes-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tes_nome_teste')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tes_id_tur')->textInput() ?>

    <?= $form->field($model, 'tes_valor_teste')->textInput() ?>

    <?= $form->field($model, 'tes_unidade_teste')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
