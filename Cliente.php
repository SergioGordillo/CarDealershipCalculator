<?php

class Cliente {
    
    //Atributos de la clase
     private $NIF;
     private $Nombre;
     private $Apellido1;
     private $Apellido2;

    //Creo los getters y setters. Por cómo voy a hacer el programa, no necesito constructor.
	 public function __GET($propiedad)
	 {
		 return $this->$propiedad;
	 }
	 public function __SET($propiedad,$valor)
	 {
		 $this->$propiedad=$valor;
	 }
		
}

?>