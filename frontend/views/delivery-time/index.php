<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $searchModel frontend\models\DeliveryTImeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Daftar Waktu Pengriman';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="delivery-time-index">

    <p>
        <?= Html::a('Tambah Waktu Pengriman', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//             'delivery_time_id',
//             'delivery_time_koperasi_id:datetime',
            'delivery_time_name',
            'delivery_time_start',
            'delivery_time_end',

          [
                'header' => 'Actions',
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}{update}{delete}',
                'buttons' => [
                    'delete' => function ($url) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                                    'title' => Yii::t('app', 'Delete'),
                                    'data-confirm' => Yii::t('yii', 'Are you sure you want to delete?'),
                                    'data-method' => 'post', 'data-pjax' => '0',
                        ]);
                    },
                    'update' => function ($url) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                                    'title' => Yii::t('app', 'Update')
                        ]);
                    },
                    'view' => function ($url) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, [
                                    'title' => Yii::t('app', 'View')
                        ]);
                    }
                ],
                'urlCreator' => function ($action, $data) {
                    if ($action === 'delete') {
                        $url = Url::to(['delivery-time/delete', 'id' => $data['delivery_time_id']]);
                        return $url;
                    }
                    if ($action === 'update') {
                        $url = Url::to(['delivery-time/update', 'id' => $data['delivery_time_id']]);
                        return $url;
                    }
                    if ($action === 'view') {
                        $url = Url::to(['delivery-time/view', 'id' => $data['delivery_time_id']]);
                        return $url;
                    }
                }
            ],
//             ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
