<?php

use yii\helpers\Html;
use yii\grid\GridView;

use frontend\models\UserKoperasi;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\FishSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Daftar Ikan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fish-index">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php
        $Object = UserKoperasi::find()->all();
        $objectArray = ArrayHelper::map($Object, 'koperasi_id', 'koperasi_name');
    ?>

    <p>
        <?= Html::a('Create Fish', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'fish_id',
            // 'fish_image:ntext',
            [
                'attribute'=>'fish_image',
                'format' => 'html',
                'value' => function ($data){
                    return Html::img(Yii::$app->request->baseUrl . '/'. $data['fish_image'], ['width' => '120px','height' => '75px']);
                },
                'headerOptions' => ['style' => 'width:130px;'],
            ],

            'fish_name',
            // [
            //     'attribute'=>'fish_koperasi_id',
            //     'value' => function ($data){
            //         $object  = UserKoperasi::find()->where(['koperasi_id' => $data['fish_koperasi_id']])->one();
            //         return $object->koperasi_name;
            //     },
            //     'filterInputOptions' => [
            //         'class' => 'form-control',
            //         'prompt'=>'Pilih Lokasi Distribusi',
            //     ],
            //     'filter'=> $objectArray,
            //     // 'headerOptions' => ['style' => 'width:20%'],
            // ],
            // 'fish_price',
            [
                'attribute'=>'fish_price',
                'value' => function ($data){
                    return "Rp. ". $data['fish_price'];
                },
            ],
            [
                'attribute'=>'fish_stock',
                'value' => function ($data){
                    return $data['fish_stock']  . " ekor";
                },
            ],
            // 'fish_category_id',
            // 'fish_condition_id',
            // 'fish_size_id',
            // 'fish_stock',

            // 'fish_description:ntext',
            // 'fish_date',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
