<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\MateriaisCorrecao */

$this->title = $model->mac_id_mac;
$this->params['breadcrumbs'][] = ['label' => 'Materiais Correcaos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="materiais-correcao-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'mac_id_mac' => $model->mac_id_mac], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'mac_id_mac' => $model->mac_id_mac], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'mac_id_mac',
            'mac_id_alu',
            'mac_id_mat',
        ],
    ]) ?>

</div>
