<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MateriaisCorrecao */

$this->title = 'Create Materiais Correcao';
$this->params['breadcrumbs'][] = ['label' => 'Materiais Correcaos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="materiais-correcao-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
