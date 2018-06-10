<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\PromoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="promo-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'promo_id') ?>

    <?= $form->field($model, 'promo_name') ?>

    <?= $form->field($model, 'promo_start') ?>

    <?= $form->field($model, 'promo_end') ?>

    <?= $form->field($model, 'promo_image') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
