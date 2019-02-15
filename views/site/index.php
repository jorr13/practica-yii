<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
$this->title = 'Crear';
?>

<a class="btn btn-default" style="margin-bottom:40px;" href="<?= Url::toRoute("site/create")?>">Listar alumnos</a>
<h1>Vista listar</h1>

<table class="table table-striped text-center">
    <tr >
        <td>Id</td>
        <td>Nombre</td>
        <td>Apellido</td>
        <td>Clase</td>
        <td>Nota</td>
        <td>Acciones</td>


    </tr>
    <?php foreach ($model as $row ): ?>
    <tr scope="row">
        <td><?= $row->id_alumno ?></td>
        <td><?= $row->nombre?></td>
        <td><?= $row->apellidos?></td>
        <td><?= $row->clase?></td>
        <td><?= $row->nota_final ?></td>
        <td><a class="btn btn-danger" href="#">eliminar</a> <a class="btn btn-info" href="#">editar</a></td>

    </tr>
    <?php endforeach ?>
</table>