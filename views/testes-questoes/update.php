<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TesteQuestoes */

$this->title = 'Update Teste Questoes: ' . $model->tqu_id_tqu;
$this->params['breadcrumbs'][] = ['label' => 'Teste Questoes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->tqu_id_tqu, 'url' => ['view', 'tqu_id_tqu' => $model->tqu_id_tqu]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="teste-questoes-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
