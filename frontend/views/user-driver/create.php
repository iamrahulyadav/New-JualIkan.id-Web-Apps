<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\UserDriver */

$this->title = 'Create User Driver';
$this->params['breadcrumbs'][] = ['label' => 'User Drivers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-driver-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
