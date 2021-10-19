<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Professores */

$this->title = $model->pro_id_pro;
$this->params['breadcrumbs'][] = ['label' => 'Professores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="professores-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'pro_id_pro' => $model->pro_id_pro], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'pro_id_pro' => $model->pro_id_pro], [
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
            'pro_id_pro',
            'pro_nome_professor',
            'pro_email_professor:email',
            'pro_senha_professor',
        ],
    ]) ?>

</div>
