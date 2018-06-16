<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ArticelSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="articel-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'articel_id') ?>

    <?= $form->field($model, 'articel_name') ?>

    <?= $form->field($model, 'articel_user_level_id') ?>

    <?= $form->field($model, 'articel_url') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
