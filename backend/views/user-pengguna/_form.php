<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use kartik\widgets\FileInput;
use backend\models\Kota;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model common\models\UserPengguna */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-pengguna-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
        $Object = Kota::find()->all();
        $ObjectArray = ArrayHelper::map($Object, 'kota_id', 'kota_name');
    ?>

    <?= $form->field($model, 'user_full_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_image')->widget(FileInput::classname(), [
            // 'type' => FileInput::TYPE_INPUT,
            'options' => ['accept' => 'image/*'],
            'pluginOptions'=>[
                'allowedFileExtensions'=>['jpg','gif','png'],
                'showUpload' => false,
                'showRemove' => false,
            ],
        ]);
    ?>

    <?= $form->field($model, 'user_phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_password')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_kota_id')->dropDownList($ObjectArray, ['prompt'=>'Pilih Nama Kota']); ?>

    <?= $form->field($model, 'user_address')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
