<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SaldoHistorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Riwayat Saldo : '.$model->driver_full_name;
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="saldo-history-index">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <!-- <p>
        <?= Html::a('Create Saldo History', ['create'], ['class' => 'btn btn-success']) ?>
    </p> -->

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'saldo_history_id',
            'saldo_history_title',
            // 'saldo_user_id',
            // 'saldo_user_level',
            'saldo_value',

            // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
