<?php

use yii\bootstrap4\ActiveForm;
$this->title = 'Cadastro';
?>

<?php $form = ActiveForm::begin([
    'id' => 'cadastro-aluno-form',
    'layout' => 'horizontal',
    /*    'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 col-form-label'],
        ],*/
]); ?>


<?= \yii\helpers\Html::hiddenInput("user", $user) ?>

    <div class="container d-flex justify-content-center align-center flex-column login-f">

        <h1 class="text-center" style="margin-left: 80px;"> Edufácil</h1>
        <h4 class="text-center" style="margin-left: 80px;">Entrar</h4>

        <div class="form-group text-center">
            <div class="col-md-6 offset-md-3">
                <?= $form->field($model, 'usu_email_usuario', [
                    "inputOptions" => [
                        "placeholder" => "Email",
                        "type" => "email",
                        "class" => "form-control text-center email_alunos"
                    ]
                ])->label("") ?>
            </div>
            <span class="email-validator text-danger d-none">Campo Inválido</span>
        </div>

        <div class="form-group text-center">
            <div class="col-md-6 offset-md-3 center-block">
                <?= $form->field($model, 'usu_nom_usuario', [
                    "inputOptions" => [
                        "placeholder" => "Insira o nome",
                        "type" => "text",
                        "class" => "form-control text-center nome_alunos"
                    ]
                ])->label("") ?>
            </div>
            <span class="nome-validator text-danger d-none">Campo Inválido</span>
        </div>

        <div class="form-group d-flex flex-column text-center">
            <div class="col-md-6 offset-md-3">
                <?= $form->field($model, 'usu_senha_usuario', [
                    "inputOptions" => [
                        "placeholder" => "Senha",
                        "type" => "password",
                        "class" => "form-control text-center senha_alunos"
                    ]
                ])->label("") ?>
            </div>
            <span class="senha-validator text-danger d-none">Campo Inválido</span>
        </div>
        <div class="form-group">
            <div class="col-md-6 offset-md-3 text-center">
                <?= $form->field($model, 'usu_senha_usuario', [
                    "inputOptions" => [
                        "placeholder" => "Confirma Senha",
                        "type" => "password",
                        "class" => "form-control text-center confirma-senha ",
                        "name" => "confirma_senha",
                        "id" => "id_aluno_confirma_senha"
                    ]
                ])->label("") ?>
                <span class="confirma-senha-validator text-danger d-none">Campo Inválido</span>
            </div>
        </div>


        <div class="form-group text-center" style="margin-left: 80px;">
            <div class="col-md-6 offset-3">
                <button type="submit" class="btn-lg color-button-aluno cadastrar-aluno ">Cadastrar</button>
            </div>
        </div>

    </div>

    <style>
        span {
            margin-left: 100px;
        }
    </style>
<?php ActiveForm::end(); ?>
<?php
$this->registerCssFile("@web/css/login_edufacil/login_edufacil.css");
$this->registerJs($this->renderPhpFile(Yii::$app->basePath . '/assets/php-js/aluno/_js-cadastrar-aluno.php'), $this::POS_END);
?>