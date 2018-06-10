<?php

use yii\helpers\Html;
use yii\grid\GridView;

use backend\models\UserLevel;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ArticelSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Daftar Artikel Bantuan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="articel-index">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php
        $Object = UserLevel::find()->all();
        $objectArray = ArrayHelper::map($Object, 'user_level_id', 'user_level_name');
    ?>

    <p>
        <?= Html::a('Tambah Daftar Artikel', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'articel_id',
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
                'filter'=> $objectArray,
            ],
            [
                'attribute'=>'articel_url',
                'value' => function ($data){
                    return substr($data['articel_url'], 0, 70). "...";
                },
                'filterInputOptions' => [
                    'class' => 'form-control',
                    'prompt'=>'Pilih User Level',
                ],
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
