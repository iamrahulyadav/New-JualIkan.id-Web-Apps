<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PromoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Daftar Promo';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="promo-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Daftar Promo', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'promo_id',
            [
                'attribute'=>'promo_image',
                'format' => 'html',
                'value' => function ($data){
                    return Html::img(Yii::$app->request->baseUrl . '../'. $data['promo_image'], ['width' => '100%','height' => '80px']);
                },
            ],
            'promo_name',
            'promo_start:date',
            'promo_end:date',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
