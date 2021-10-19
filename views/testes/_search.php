<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TestesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="testes-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'tes_id_tes') ?>

    <?= $form->field($model, 'tes_nome_teste') ?>

    <?= $form->field($model, 'tes_id_tur') ?>

    <?= $form->field($model, 'tes_valor_teste') ?>

    <?= $form->field($model, 'tes_unidade_teste') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
