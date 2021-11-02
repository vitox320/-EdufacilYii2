<?php

use app\models\TesteQuestoes;
use app\models\Testes;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Criar Testes';

?>

<div class="row">
    <div class="col-md-12 text-center">
        <h3> <?= $this->title ?> </h3>
    </div>
</div>

<?php
$form = ActiveForm::begin();
?>

<div class="row">
    <div class="col-md-4">
        <?= $form->field(new Testes(), "tes_nome_teste")->textInput(['placeholder' => "Título"])->label(""); ?>
    </div>

</div>

<div class="d-flex justify-content-center">

    <div class="container bg-white shadow">
        <div class="row">
            <div class="col-md-12">
                <?= $form->field(new TesteQuestoes(), "tqu_enunciado[]")->textInput(['placeholder' => "Enunciado"])->label(""); ?>
            </div>

        </div>
        <div class="row">
            <div class="col-md-4">
                <?= $form->field(new TesteQuestoes(), "tqu_alternativa[]")->textInput(['placeholder' => "Alternativa 1", "id" => "alt1"])->label(""); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <?= $form->field(new TesteQuestoes(), "tqu_alternativa[]")->textInput(['placeholder' => "Alternativa 2", "id" => "alt2"])->label(""); ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <?= $form->field(new TesteQuestoes(), "tqu_alternativa[]")->textInput(['placeholder' => "Alternativa 3", "id" => "alt3"])->label(""); ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <?= $form->field(new TesteQuestoes(), "tqu_alternativa[]")->textInput(['placeholder' => "Alternativa 4", "id" => "alt4"])->label(""); ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <?= $form->field(new TesteQuestoes(), "tqu_alternativa")->textInput(['placeholder' => "Alternativa 5", "id" => "alt5"])->label(""); ?>
            </div>
        </div>

    </div>
    <div class="d-flex flex-column ml-3">
        <span style="float: right; cursor: pointer; "> <i class="far fa-save fa-2x"></i></span>
        <span style="float: right; cursor: pointer;"> <i class="fas fa-trash fa-2x" title=""></i></span>
    </div>

</div>
<div class="row mt-2">
    <div class="col-md-2">
        <button class="btn text-white" style="background-color: #4F647F;"> Aberta</button>
    </div>
    <div class="col-md-2">
        <button class="btn text-white" style="background-color: #4F647F"> Fechada</button>
    </div>
</div>

<?php ActiveForm::end(); ?>

<style>
    .form-control {
        border-top: none;
        border-left: none;
        border-right: none;

    }
</style>

<?php $this->registerJs($this->renderPhpFile(Yii::$app->basePath . '/assets/php-js/teste/_js-cadastrar-testes.php'), $this::POS_END); ?>




