<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\Kota;

/* @var $this yii\web\View */
/* @var $model common\models\UserPengguna */

$this->title = $model->user_full_name;
$this->params['breadcrumbs'][] = ['label' => 'User Penggunas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-pengguna-view">

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->user_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->user_id], [
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
          [
              'attribute'=>'user_image',
              'format' => 'html',
              'value' => function ($data){
                  return Html::img(Yii::$app->request->baseUrl . '../'. $data['user_image'], ['width' => '180px','height' => '180px']);
              },
              'headerOptions' => ['style' => 'width:100px;'],
          ],
          'user_full_name',
          'user_phone',
          'user_email:email',
          //'user_password',
          //'user_device_id',
          'user_address',
          [
              'attribute'=>'user_kota_id',
              'value' => function ($data){
                  $object  = Kota::find()->where(['kota_id' => $data['user_kota_id']])->one();
                  return $object->kota_name;
              },
              // 'headerOptions' => ['style' => 'width:20%'],
          ],
          // 'user_kota_id',
          [
              'attribute'=>'user_saldo',
              'format' => 'html',
              'value' => function ($data){
                  return "Rp. " . $data['user_saldo'];
              },
          ],
          [
              'attribute' => 'user_saldo',
              'format' => 'html',
              'label' => 'Top-up',
              'value' => function ($data){
                  // $user  = \backend\models\Users::find()->where(['username' => $data['dari']])->one();
                  return Html::a("Top-up", ['top-up', 'id' => $data['user_id']], [
                      'class'=>'btn btn-success btn-sm'
                  ]);
              },
              'headerOptions' => ['style' => 'width:80px;'],
          ],
          [
              'attribute' => 'user_saldo',
              'format' => 'html',
              'label' => 'Riwayat Saldo',
              'value' => function ($data){
                  // $user  = \backend\models\Users::find()->where(['username' => $data['dari']])->one();
                  return Html::a("Riwayat Saldo", ['saldo', 'id' => $data['user_id']], [
                      'class'=>'btn btn-success btn-sm'
                  ]);
              },
              'headerOptions' => ['style' => 'width:80px;'],
          ],
        ],
    ]) ?>

</div>
