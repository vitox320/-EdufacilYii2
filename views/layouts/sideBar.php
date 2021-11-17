<?php
$corSideBar = null;
if (!is_null(Yii::$app->professor->getIdentity())) {
    $corSideBar = "bg-success";
}

?>
<div class="sidebar <?= $corSideBar ?>">
    <a href="#home"><i class="fa fa-fw fa-home"></i> </a>
    <a href="#services"><i class="fa fa-fw fa-wrench"></i> </a>
    <a href="#clients"><i class="fa fa-fw fa-user"></i> </a>
    <a href="#contact"><i class="fa fa-fw fa-envelope"></i> </a>

    <?php if (!Yii::$app->aluno->isGuest) { ?>
        <a href="<?= Yii::$app->urlManager->createUrl(["site/logout"]) ?>"><i class="fa fa-user-times"
                                                                              aria-hidden="true"></i></a>
    <?php } ?>


</div>