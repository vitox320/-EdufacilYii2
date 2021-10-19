<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Alunos */

$this->title = 'Create Alunos';
$this->params['breadcrumbs'][] = ['label' => 'Alunos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="alunos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
