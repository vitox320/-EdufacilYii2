<?php if (sizeof(Yii::$app->user->getIdentity()->alunos) != 0) { ?>
    <div class="sidebar">
        <a href="<?= Yii::$app->urlManager->createUrl(["turma/index"]);  ?>"><i class="fas fa-users"></i> </a>
        <a href="<?= Yii::$app->urlManager->createUrl(["notas/index"]); ?>"><i class="fa fa-fw fa-wrench"></i> </a>
        <a href="<?= Yii::$app->urlManager->createUrl(["site/logout"]) ?>"><i class="fas fa-sign-out-alt"></i></a>


    </div>
<?php } ?>

<?php if (sizeof(Yii::$app->user->getIdentity()->professores) != 0) { ?>
    <div class="sidebar bg-success">
        <a href="<?= Yii::$app->urlManager->createUrl(["turma/index"]);  ?>"><i class="fas fa-users"></i> </a>
        <a href="<?= Yii::$app->urlManager->createUrl(["testes/create"])?>"><i class="fab fa-leanpub"></i></a>

        <!--<a href="#clients"><i class="fa fa-fw fa-user"></i> </a>
        <a href="#contact"><i class="fa fa-fw fa-envelope"></i> </a>-->

        <a href="<?= Yii::$app->urlManager->createUrl(["site/logout"]) ?>"><i class="fas fa-sign-out-alt"></i></a>


    </div>
<?php } ?>

