<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<h1>Vista crear</h1>
<h3><?= $msg ?></h3>
<?php $form= ActiveForm::begin([
    "method" => "post",
    "enableClientValidation" => true,

]);
?>
<div class="formgroup">
    <?= $form->field($model, "nombre")->input("text")?>
</div>

<div class="formgroup">
    <?= $form->field($model, "apellidos")->input("text")?>
</div>
<div class="formgroup">
    <?= $form->field($model, "clase")->input("text")?>
</div>

<div class="formgroup">
    <?= $form->field($model, "nota_final")->input("text")?>
</div>

<?= Html::submitInput("Crear", ["class" => "btn btn-primary"])?>

<?php $form->end() ?>