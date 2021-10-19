<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TestesQuestoesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="teste-questoes-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'tqu_id_tqu') ?>

    <?= $form->field($model, 'tqu_enunciado') ?>

    <?= $form->field($model, 'tqu_alternativa') ?>

    <?= $form->field($model, 'tqu_gabaritos') ?>

    <?= $form->field($model, 'tqu_valor') ?>

    <?php // echo $form->field($model, 'tqu_id_tes') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
