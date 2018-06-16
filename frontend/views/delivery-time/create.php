<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\DeliveryTime */

$this->title = 'Tambah Waktu Pengriman';
$this->params['breadcrumbs'][] = ['label' => 'Delivery Times', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="delivery-time-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
