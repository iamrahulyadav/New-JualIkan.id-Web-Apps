<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\UserKoperasi */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-koperasi-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'koperasi_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kopreasi_image')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'koperasi_level_id')->textInput() ?>

    <?= $form->field($model, 'koperasi_holder_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'koperasi_holder_phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'koperasi_email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'koperasi_password')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'koperasi_kota_id')->textInput() ?>

    <?= $form->field($model, 'koperasi_address')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'koperasi_lat')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'koperasi_lng')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'koperasi_status')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
