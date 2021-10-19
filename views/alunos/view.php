<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Alunos */

$this->title = $model->alu_id_alu;
$this->params['breadcrumbs'][] = ['label' => 'Alunos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="alunos-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'alu_id_alu' => $model->alu_id_alu], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'alu_id_alu' => $model->alu_id_alu], [
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
            'alu_id_alu',
            'alu_nome_alunos',
            'alu_email_alunos:email',
            'alu_senha_alunos',
            'alu_id_tur',
            'alu_id_pro',
        ],
    ]) ?>

</div>
