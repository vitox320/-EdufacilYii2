<?php

/* @var $this yii\web\View */

use app\models\Turma;
use yii\bootstrap4\ActiveForm;

$this->title = 'Turmas';
$this->registerCssFile("@web/css/turmas/turma.css");

//var_dump(Yii::$app->user->getIdentity()->professores, Yii::$app->user->getIdentity()->alunos);
?>


    <div class="container" style="margin-top: 12%;">
        <div class="row">
            <div class="col-md-12 text-center">
                <h2 class="titulo-edufacil"> Turmas </h2>

                <?php if (sizeof(Yii::$app->user->getIdentity()->professores) != 0) { ?>
                    <i class="fas fa-plus-square adicionar fa-2x" data-toggle="modal"
                       data-target="#exampleModalCenter"></i>
                <?php } ?>
            </div>
        </div>


        <div class="row d-flex justify-content-center mt-5">
            <?php if (!is_null($turmas)) { ?>
                <?php foreach ($turmas as $turma): ?>
                    <div class="col-md-4 mt-3">
                        <?php
                        if (sizeof(Yii::$app->user->getIdentity()->professores) != 0) {
                            $url = "turma/view";
                        }
                        if (sizeof(Yii::$app->user->getIdentity()->alunos) != 0) {
                            $url = "testes/index";
                        }
                        ?>
                        <a href="<?= Yii::$app->urlManager->createUrl([$url, "turma" => $turma["tur_id_tur"]]) ?>"
                           class="caixa-escolha ">
                            <?= $turma['tur_nom_turma'] ?>
                        </a>
                    </div>

                <?php endforeach; ?>
            <?php } else { ?>
                <h4 style="margin-top: -200px">Você ainda não foi incluído em nenhuma turma.</h4>
            <?php } ?>
        </div>

    </div>

<?php if (sizeof(Yii::$app->user->getIdentity()->professores) != 0) { ?>
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class=" text-center">
                    <h5 class="modal-title" id="exampleModalLongTitle">Nova Turma</h5>
                </div>

                <?php $form = ActiveForm::begin([
                    'id' => 'cadastro-aluno-form',
                    'action' => 'cadastra-turma',
                    'layout' => 'horizontal',
                ]); ?>

                <div class="modal-body">
                    <?= $form->field($turmaModel, 'tur_nom_turma')->textInput()->label("Nome") ?>
                </div>


                <div class="d-flex justify-content-around pb-3 pt-3">
                    <button type="button" class="btn  text-white" style="background-color: #4F647F; "
                            data-dismiss="modal">
                        Fechar
                    </button>
                    <button type="submit" class="btn btn-success text-white">Salvar</button>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
<?php } ?>