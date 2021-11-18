<?php

use yii\bootstrap4\ActiveForm;

?>

<?php $form = ActiveForm::begin([
    'id' => 'login-form',
    'layout' => 'horizontal',
    /*    'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 col-form-label'],
        ],*/
]); ?>


    <div class="container d-flex justify-content-center align-center flex-column login-f">

        <h1 class="text-center" style="margin-left: 80px;"> Edufácil</h1>
        <h4 class="text-center" style="margin-left: 80px;">Entrar</h4>
        <div class="form-group">
            <div class="col-md-6 offset-md-3 center-block">
                <?= $form->field(new \app\models\LoginForm(), 'username', [
                    "inputOptions" => ["placeholder" => "Email", "type" => "email", "class" => "form-control text-center"]
                ])->label("") ?>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-6 offset-md-3">
                <?= $form->field(new \app\models\LoginForm(), 'password', [
                    "inputOptions" => ["placeholder" => "Senha", "type" => "password", "class" => "form-control text-center"]
                ])->label("") ?>
            </div>
        </div>

        <?= \yii\helpers\Html::hiddenInput("user", $user) ?>


        <div class="form-group text-center" style="margin-left: 80px;">
            <div class="col-md-6 offset-3">
                <?php if ($user == "aluno") { ?>
                    <button type="submit" class="btn-lg color-button-aluno ">Entrar</button>
                <?php } ?>

                <?php if ($user == "professor") { ?>
                    <button type="submit" class="btn-lg color-button-professor ">Entrar</button>
                <?php } ?>
            </div>
            <a href="<?= Yii::$app->urlManager->createUrl(["usuarios/create", "user" => $user]); ?>">Não possui login?
                Cadastre-se
                agora! </a>
        </div>

    </div>


<?php ActiveForm::end(); ?>
<?php
$this->registerCssFile("@web/css/login_edufacil/login_edufacil.css");

?>