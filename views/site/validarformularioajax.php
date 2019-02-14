<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<h1>Validar formulario ajax</h1>
<h3><?=$msg ?></h3>
<?php $form= ActiveForm::begin([
    "method" => "post",
    "id" => "formulario",
    "enableClientValidation" => false,
    "enableAjaxValidation" => true,

]);
?>
<div class="formgroup">
    <?= $form->field($model, "nombre")->input("text")?>
</div>
<div class="formgroup">
    <?= $form->field($model, "email")->input("text")?>
</div>
<?= Html::submitInput("Enviar", ["class" => "btn btn-primary"])?>

<?php $form->end() ?>