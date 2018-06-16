<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\UserPengguna */

$this->title = 'Tambah User Pengguna';
$this->params['breadcrumbs'][] = ['label' => 'User Penggunas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-pengguna-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
