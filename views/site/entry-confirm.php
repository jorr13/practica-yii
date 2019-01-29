<?php
use yii\helpers\Html;
?>
<p>Esta es tu informacion:</p>


<ul>
    <li><label>Tu nombre</label>: <?= Html::encode($model->name) ?></li>
    <li><label>Tu correo</label>: <?= Html::encode($model->email) ?></li>
</ul>