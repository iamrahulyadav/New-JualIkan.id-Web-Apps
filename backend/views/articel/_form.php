<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use backend\models\UserLevel;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\Articel */
/* @var $form yii\widgets\ActiveForm */
?>

<?php
    $Object = UserLevel::find()->all();
    $objectArray = ArrayHelper::map($Object, 'user_level_id', 'user_level_name');
?>

<div class="articel-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'articel_name')->textInput(['maxlength' => true]) ?>

    <!-- <?= $form->field($model, 'articel_user_level_id')->textInput() ?> -->
    <?= $form->field($model, 'articel_user_level_id')->dropDownList($objectArray, ['prompt'=>'Pilih User Level']); ?>

    <?= $form->field($model, 'articel_url')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
