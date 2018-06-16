<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\UserPengguna */

$this->title = 'Top-Up Saldo : '. $model->driver_full_name;
// $this->params['breadcrumbs'][] = ['label' => 'User Top-up', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-pengguna-create">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <div class="user-pengguna-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($topUpModel, 'saldo_value')->textInput() ?>

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
