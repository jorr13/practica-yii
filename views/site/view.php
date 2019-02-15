<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
?>

<a class="btn btn-default" style="margin-bottom:40px;" href="<?= Url::toRoute("site/create")?>">Listar alumnos</a>
<h1>Vista listar</h1>

<table class="table table-bordered">
    <tr>
        <td>id</td>
        <td>nombre</td>
        <td>apellido</td>
        <td>clase</td>
        <td>nota</td>

    </tr>
    <?php foreach ($model as $row ): ?>
    <tr>
        <td><?= $row->id_alumno ?></td>
        <td><?= $row->nombre?></td>
        <td><?= $row->apellidos?></td>
        <td><?= $row->clase?></td>
        <td><?= $row->nota_final ?></td>
        <td><a class="btn btn-danger" href="#">eliminar</a></td>
        <td><a class="btn btn-info" href="#">editar</a></td>
    </tr>
    <?php endforeach ?>
</table>