<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Usuarios */

$this->title = $model->usu_id_usu;
$this->params['breadcrumbs'][] = ['label' => 'Usuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="usuarios-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'usu_id_usu' => $model->usu_id_usu], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'usu_id_usu' => $model->usu_id_usu], [
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
            'usu_id_usu',
            'usu_nom_usuario',
            'usu_email_usuario:email',
            'usu_senha_usuario',
        ],
    ]) ?>

</div>
