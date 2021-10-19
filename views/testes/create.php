<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Testes */

$this->title = 'Create Testes';
$this->params['breadcrumbs'][] = ['label' => 'Testes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="testes-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
