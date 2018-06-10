<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Promo */

$this->title = $model->promo_name;
$this->params['breadcrumbs'][] = ['label' => 'Promos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->promo_id, 'url' => ['view', 'id' => $model->promo_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="promo-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
