<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\finance\Collectiontype */

$this->title = 'Create Collectiontype';
$this->params['breadcrumbs'][] = ['label' => 'Collectiontypes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="collectiontype-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
