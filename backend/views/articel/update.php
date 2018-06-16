<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Articel */

$this->title = $model->articel_name;
// $this->params['breadcrumbs'][] = ['label' => 'Articels', 'url' => ['index']];
// $this->params['breadcrumbs'][] = ['label' => $model->articel_id, 'url' => ['view', 'id' => $model->articel_id]];
// $this->params['breadcrumbs'][] = 'Update';
?>
<div class="articel-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
