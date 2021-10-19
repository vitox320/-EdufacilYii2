<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TesteQuestoes */

$this->title = 'Create Teste Questoes';
$this->params['breadcrumbs'][] = ['label' => 'Teste Questoes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teste-questoes-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
