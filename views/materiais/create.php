<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Materiais */

$this->title = 'Create Materiais';
$this->params['breadcrumbs'][] = ['label' => 'Materiais', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="materiais-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
