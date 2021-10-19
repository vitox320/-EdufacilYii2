<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Testes */

$this->title = 'Update Testes: ' . $model->tes_id_tes;
$this->params['breadcrumbs'][] = ['label' => 'Testes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->tes_id_tes, 'url' => ['view', 'tes_id_tes' => $model->tes_id_tes]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="testes-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
