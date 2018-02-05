<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Fish */

$this->title = 'Update Fish: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Fish', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->fish_id, 'url' => ['view', 'id' => $model->fish_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="fish-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
