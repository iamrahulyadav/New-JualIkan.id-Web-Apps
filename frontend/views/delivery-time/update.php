<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\DeliveryTime */

$this->title = $model->delivery_time_name;
$this->params['breadcrumbs'][] = ['label' => 'Delivery Times', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->delivery_time_id, 'url' => ['view', 'id' => $model->delivery_time_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="delivery-time-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
