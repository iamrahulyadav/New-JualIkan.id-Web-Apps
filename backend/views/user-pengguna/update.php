<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\UserPengguna */

$this->title = 'Update User Pengguna: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'User Penggunas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->user_id, 'url' => ['view', 'id' => $model->user_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-pengguna-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
