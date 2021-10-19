<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Professores */

$this->title = 'Update Professores: ' . $model->pro_id_pro;
$this->params['breadcrumbs'][] = ['label' => 'Professores', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->pro_id_pro, 'url' => ['view', 'pro_id_pro' => $model->pro_id_pro]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="professores-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
