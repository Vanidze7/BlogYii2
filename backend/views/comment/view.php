<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Comment */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Комментарии', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="comment-view">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Ты уверен что хочешь удалить этот комментарий?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'text:raw',
            [
                'attribute' => 'created_at',
                'value' => date("Y-m-d H:i:s", $model->created_at),
                'format' => 'raw',
            ],
            [
                'attribute' => 'updated_at',
                'value' => date("Y-m-d H:i:s", $model->updated_at),
                'format' => 'raw',
            ],
            [
                'attribute' => 'user_id',
                'value' => '<a href="' . \yii\helpers\Url::to(['site/user-view', 'id' => $model->user->id]) . '">' . $model->user->id . ' - ' . $model->user->username . '</a>',
                'format' => 'raw'
            ],
            [
                'attribute' => 'article_id',
                'value' => '<a href="' . \yii\helpers\Url::to(['article/view', 'id' => $model->article->id]) . '">' . $model->article->id . ' - ' . $model->article->title . '</a>',
                'format' => 'raw'
            ],
        ],
    ]) ?>
</div>
