<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\FileInput;

/* @var $this yii\web\View */
/* @var $model backend\models\UserDriverSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-driver-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'driver_id') ?>

    <?= $form->field($model, 'driver_full_name') ?>

    <?= $form->field($model, 'driver_phone') ?>

    <?= $form->field($model, 'driver_email') ?>

    <?= $form->field($model, 'driver_password') ?>

    <?php // echo $form->field($model, 'driver_device_id') ?>

    <?php // echo $form->field($model, 'driver_image') ?>

    <?php // echo $form->field($model, 'driver_distribution_id') ?>

    <?php // echo $form->field($model, 'driver_vehicle_weight') ?>

    <?php // echo $form->field($model, 'driver_address') ?>

    <?php // echo $form->field($model, 'driver_saldo') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
