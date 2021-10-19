<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MateriaisCorrecao */

$this->title = 'Update Materiais Correcao: ' . $model->mac_id_mac;
$this->params['breadcrumbs'][] = ['label' => 'Materiais Correcaos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->mac_id_mac, 'url' => ['view', 'mac_id_mac' => $model->mac_id_mac]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="materiais-correcao-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
