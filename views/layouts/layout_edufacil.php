<?php

/* @var $this \yii\web\View */

/* @var $content string */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>


<main role="main" class="flex-shrink-0">
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<?php
$user = Yii::$app->request->get("user");
if ($user == "aluno") {
    ?>
    <footer class="footer mt-auto py-3 text-muted">
        <div class="container text-center">

            <p class="text-white">Edufácil <?= date('Y') ?></p>

        </div>
    </footer>
<?php } ?>

<?php if ($user == "professor") { ?>
    <footer class="footer mt-auto py-3 text-muted " style="background-color: #28a745 !important;">
        <div class="container text-center">

            <p class="text-white">Edufácil <?= date('Y') ?></p>

        </div>
    </footer>
<?php } ?>



<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
