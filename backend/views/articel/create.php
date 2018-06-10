<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Articel */

$this->title = 'Tambah Daftar Artikel';
$this->params['breadcrumbs'][] = ['label' => 'Articels', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="articel-create">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
