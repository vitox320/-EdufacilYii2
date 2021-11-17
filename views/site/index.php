<?php

/* @var $this yii\web\View */

$this->title = 'Edufacil-index ';
$this->registerCssFile("@web/css/site/index.css");

?>

<div class="container-principal">
    <div class="text-center container-titulos">
        <h2 class="titulo-edufacil">Edufácil</h2>
        <h5>Seja Bem vindo. Você é: </h5>
    </div>
    <div class="d-flex justify-content-between w-75">

        <a href="<?= Yii::$app->urlManager->createUrl(["site/login","user"=>"aluno"]) ?>" class="caixa-escolha aluno">
            Aluno
        </a>

        <a href="<?= Yii::$app->urlManager->createUrl(["site/login","user"=>"professor"]) ?>" class="caixa-escolha professor">
            Professor
        </a>
    </div>

</div>
