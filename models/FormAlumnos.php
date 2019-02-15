<?php
 namespace app\models;
 use Yii;
 use yii\base\model; 

class FormAlumnos extends model{
    public $id_alumno;
    public $nombre;
    public $apellidos;
    public $clase;
    public $nota_final;

    public function rules()
    {
        return[
            ['nombre', 'required', 'message' => 'Campo requerido'],//para decirle que el campo es requerido
            ['nombre', 'match', 'pattern' => "/^.{3,50}$/", 'message' => 'Minimo 3 y 50 caracteres'],//para decirle que el campo solo acepta en 3 y 50 caracteres
            ['nombre', 'match','pattern' => "/^.[a-z]+$/i", 'message' => 'Solo se aceptan letras'],//para decirle que el campo solo acepta letras y numeros
            ['apellidos', 'required', 'message' => 'Campo requerido'],//para decirle que el campo es requerido
            ['apellidos', 'match', 'pattern' => "/^.{3,50}$/", 'message' => 'Minimo 3 y 50 caracteres'],//para decirle que el campo solo acepta en 3 y 50 caracteres
            ['apellidos', 'match','pattern' => "/^.[a-z]+$/i", 'message' => 'Solo se aceptan letras'],//para decirle que el campo solo acepta letras y numeros
            ['clase', 'required', 'message' => 'Campo requerido'],//para decirle que el campo es requerido
            ['clase', 'integer', 'message' => 'solo numeros enteros'],//para decirle que el campo solo acepta en 3 y 50 caracteres
            ['nota_final', 'required', 'message' => 'Campo requerido'],//para decirle que el campo es requerido
            ['nota_final', 'number', 'message' => 'solo numeros'],//para decirle que el campo solo acepta en 3 y 50 caracteres
        ];
    }
}
