<?php

use common\models\Comment;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Комментарии';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comment-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('Добавить комментарий', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'text:raw',
            'created',
            'updated',
            [
                'attribute' => 'user_id',
                'value' => function(Comment $model){
                    return '<a href="' . \yii\helpers\Url::to(['site/userview', 'id' => $model->user->id]) . '">' . $model->user->id . ' - ' . $model->user->username . '</a>';
                },
                'format' => 'raw',
            ],
            [
                'attribute' => 'article_id',
                'value' => function(Comment $model){
                    return '<a href="' . \yii\helpers\Url::to(['article/view', 'id' => $model->article->id]) . '">' . $model->article->title . '</a>';
                },
                'format' => 'raw',
            ],
            [
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, Comment $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>
</div>
