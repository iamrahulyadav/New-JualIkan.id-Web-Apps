<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\UserPenggunaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-pengguna-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'user_full_name') ?>

    <?= $form->field($model, 'user_image') ?>

    <?= $form->field($model, 'user_phone') ?>

    <?= $form->field($model, 'user_email') ?>

    <?php // echo $form->field($model, 'user_password') ?>

    <?php // echo $form->field($model, 'user_device_id') ?>

    <?php // echo $form->field($model, 'user_kota_id') ?>

    <?php // echo $form->field($model, 'user_address') ?>

    <?php // echo $form->field($model, 'user_saldo') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
