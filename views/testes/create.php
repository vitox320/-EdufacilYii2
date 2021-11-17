<?php

use app\models\TesteQuestoes;
use app\models\Testes;
use app\models\Turma;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

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

        <div class="col-md-4">
            <?= $form->field(new Turma(), 'tur_id_tur')->widget(Select2::class, [
                'data' => $todasAsTurmasOptions,
                'options' => ['placeholder' => 'Selecione uma turma ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ])->label(""); ?>
        </div>

        <div class="col-md-4">
            <?= $form->field(new Testes(), 'tes_unidade_teste')->widget(Select2::class, [
                'data' => [1 => "A1", 2 => "A2"],
                'options' => ['placeholder' => 'Selecione a unidade do teste ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ])->label(""); ?>
        </div>

    </div>


    <div class="row mt-3">
        <div class="col-md-6">
            <button class="btn text-white adicionar mr-3 float-left" style="background-color: #4F647F;"><i
                        class="far fa-plus-square"></i> Adicionar Novas Questões
            </button>
        </div>

        <div class="col-md-6">
            <button class="btn text-white mr-3 float-right salvarProva" style="background-color: #4F647F;"> Salvar
            </button>
        </div>
    </div>


    <div class="conteudo-principal">

        <div class="d-flex justify-content-center conteudo-perguntas mt-5">

            <div class="container bg-white shadow lista-perguntas">

                <div class="row">
                    <div class="col-md-12">
                        <?= $form->field($enunciados, "enu_nom_enunciado[]")->textInput(['placeholder' => "Enunciado"])->label(""); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <?= $form->field(new TesteQuestoes(), "tqu_alternativa[]")->textInput(['placeholder' => "Alternativa 1"])->label(""); ?>
                    </div>
                    <div class="col-md-4 mt-5">
                        Resposta Verdadeira: <input type="checkbox" name="gabarito[]" class="cl_gabarito" value="1"
                                                    checked>
                        Resposta Falsa: <input type="checkbox" name="gabarito[]" class="cl_gabarito" value="0">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <?= $form->field(new TesteQuestoes(), "tqu_alternativa[]")->textInput(['placeholder' => "Alternativa 2", "id" => "alt2"])->label(""); ?>
                    </div>
                    <div class="col-md-4 mt-5">
                        Resposta Verdadeira: <input type="checkbox" name="gabarito[]" class="cl_gabarito" value="1">
                        Resposta Falsa: <input type="checkbox" name="gabarito[]" class="cl_gabarito" value="0" checked>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <?= $form->field(new TesteQuestoes(), "tqu_alternativa[]")->textInput(['placeholder' => "Alternativa 3", "id" => "alt3"])->label(""); ?>
                    </div>
                    <div class="col-md-4 mt-5">
                        Resposta Verdadeira: <input type="checkbox" name="gabarito[]" class="cl_gabarito" value="1">
                        Resposta Falsa: <input type="checkbox" name="gabarito[]" class="cl_gabarito" value="0" checked>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <?= $form->field(new TesteQuestoes(), "tqu_alternativa[]")->textInput(['placeholder' => "Alternativa 4", "id" => "alt4"])->label(""); ?>
                    </div>
                    <div class="col-md-4 mt-5">
                        Resposta Verdadeira: <input type="checkbox" name="gabarito[]" class="cl_gabarito" value="1">
                        Resposta Falsa: <input type="checkbox" name="gabarito[]" class="cl_gabarito" value="0" checked>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <?= $form->field(new TesteQuestoes(), "tqu_alternativa[]")->textInput(['placeholder' => "Alternativa 5", "id" => "alt5"])->label(""); ?>
                    </div>
                    <div class="col-md-4 mt-5">
                        Resposta Verdadeira: <input type="checkbox" name="gabarito[]" class="cl_gabarito" value="1">
                        Resposta Falsa: <input type="checkbox" name="gabarito[]" class="cl_gabarito" value="0" checked>
                    </div>
                </div>

            </div>

            <div class="d-flex flex-column ml-3">
                <span class="cursors"> <i class="fas fa-trash fa-2x excluirDiv" title=""></i></span>
            </div>
        </div>


    </div>


<?php ActiveForm::end(); ?>

    <style>
        .form-control {
            border-top: none;
            border-left: none;
            border-right: none;

        }

        .cursors {
            float: right;
            cursor: pointer;
        }
    </style>


<?php $this->registerJs($this->renderPhpFile(Yii::$app->basePath . '/assets/php-js/teste/_js-cadastrar-testes.php'), $this::POS_END);




