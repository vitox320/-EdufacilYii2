<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Professores */

$this->title = 'Create Professores';
$this->params['breadcrumbs'][] = ['label' => 'Professores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="professores-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
