<?php

class Coche {
    
    //Atributos de la clase
     private $Id;
     private $Marca;
     private $Modelo;
     private $Precio;

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