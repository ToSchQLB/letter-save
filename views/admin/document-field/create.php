<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\DocumentField */

$this->title = 'Create Document Field';
$this->params['breadcrumbs'][] = ['label' => 'Document Fields', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="document-field-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
