<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Article */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Статьи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="article-view">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('Редактировать статью', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить статью', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Ты уверен что хочешь удалить эту статью?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'text:raw',
            'views',
            'img',
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
                'value' => '<a href="' . \yii\helpers\Url::to(['site/userview', 'id' => $model->user->id]) . '">' . $model->user->id . ' - ' . $model->user->username . '</a>',//создать метод и вид пользователя
                'format' => 'raw',
            ],
            [
                'attribute' => 'category_id',
                'value' => '<a href="' . \yii\helpers\Url::to(['category/view', 'id' => $model->category->id]) . '">' . $model->category->title . '</a>',
                'format' => 'raw',
            ],
        ],
    ]) ?>
</div>
