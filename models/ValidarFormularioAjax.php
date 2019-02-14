<?php
 namespace app\models;
 use Yii;
 use yii\base\model; 

class ValidarFormularioAjax extends model{
    public $nombre;
    public $email;

    public function rules()
    {
        return[

            //nombre
            ['nombre', 'required', 'message' => 'Campo requerido'],//para decirle que el campo es requerido
            ['nombre', 'match', 'pattern' => "/^.{3,50}$/", 'message' => 'Minimo 3 y 50 caracteres'],//para decirle que el campo solo acepta en 3 y 50 caracteres
            ['nombre', 'match','pattern' => "/^.[0-9a-z]+$/i", 'message' => 'Solo se aceptan letras y numeros'],//para decirle que el campo solo acepta letras y numeros
           
            //email
            ['email', 'required', 'message' => 'Campo requerido'],//para decirle que el campo es requerido
            ['email', 'match', 'pattern' => "/^.{5,80}$/", 'message' => 'Minimo 5 y 80 caracteres'],//para decirle que el campo solo acepta en 3 y 50 caracteres
            ['email', 'email', 'message' => 'Formato no valido'],// para decirle que el campo tiene que ser de formato email
            ['email', 'email_existe']
        ];
    }
    public function attributeLabels()
    {
        return[
            'nombre' => 'Nombre:',
            'email' => 'Email:',
        ];
    }
    public function email_existe($attribute, $params)
    {
        $email = ["jerinson@gmail.com", "juan@gmail.com"];
        foreach($email as $val){
            if ($this->email == $val) {
                $this->addError($attribute, "el email ingresado existe!!");
                return true;
            }
            else{
                return false;
            }
        }
    }

}