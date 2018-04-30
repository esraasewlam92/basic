<?php

use yii\helpers\Html;
?>

<p>You have entered the following information:</p>
<ul>
    <li><label>Name</label>: <?= Html::encode($model->name) ?></li>
    <li><label>Email</label>: <?= Html::encode($model->email) ?></li>
    <li><label>Category</label>: <?= Html::encode($model->category) ?></li>
    <li><label>Subject</label>: <?= Html::encode($model->subject) ?></li>
</ul>
