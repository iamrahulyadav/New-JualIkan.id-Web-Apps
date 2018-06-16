<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use backend\models\UserLevel;

/* @var $this yii\web\View */
/* @var $model backend\models\Articel */

$this->title = $model->articel_name;
$this->params['breadcrumbs'][] = ['label' => 'Articels', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="articel-view">

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->articel_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->articel_id], [
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
            'articel_id',
            'articel_name',
            [
                'attribute'=>'articel_user_level_id',
                'value' => function ($data){
                    $object  = UserLevel::find()->where(['user_level_id' => $data['articel_user_level_id']])->one();
                    return $object->user_level_name;
                },
                'filterInputOptions' => [
                    'class' => 'form-control',
                    'prompt'=>'Pilih User Level',
                ],
            ],
            'articel_url:ntext',
        ],
    ]) ?>

</div>
