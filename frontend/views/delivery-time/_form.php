<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\DeliveryTime */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="delivery-time-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'delivery_time_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'delivery_time_start')->textInput() ?>

    <?= $form->field($model, 'delivery_time_end')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
