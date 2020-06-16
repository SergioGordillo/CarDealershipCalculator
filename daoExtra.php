<?php

require_once("Extra.php");
require_once("classConexion.php");

class daoExtra extends Conexion { //Esta clase hereda de Conexión.
	
              
               public $Extras=array();    //Array de objetos Extras
               

	
	           public function Listar() //Función para listar los extras
	           {
				   
				  $this->Extras=array(); //Hay que vaciar el array de objetos extras
				   
				  $consulta="select * from extra";

                  $param=array(); //Creo un array para pasarle parámetros

                  $this->Consulta($consulta,$param); //Ejecuto la consulta
            			
				  foreach ($this->datos as $fila)  //Recorro el array de la consulta
				  {
					   
					  $extra = new Extra();  //Creo un nuevo objeto
                                             //Le seteo las variables, y así me ahorro el constructor   
                      $extra->Id = $fila["Id"]; //Accedo a la propiedad directamente
					  $extra->__SET("Nombre",$fila["Nombre"]);
					  $extra->__SET("Precio",$fila["Precio"]);
                      
                      $this->Extras[]=$extra; //Meto el extra en el array Extras

				  }
			   }
			   
			   public function ObtExtra($Id) //Función para la búsqueda de un extra según su ID
	           {
				   
				  $consulta="select * from extra where Id=:Id"; //Construyo la consulta SQL

                  $param=array(":Id"=>$Id); //Esta consulta sí lleva un parámetro, el ID 

                  $this->Consulta($consulta,$param); //Ejecuto la consulta
				  
				  $extra = new Extra ();  //Construyo un objeto extra
            	
				  if (count($this->datos) > 0 )         //Si el extra está en la BBDD según su ID
				  {
				     $fila=$this->datos[0];  //La columna solo revolveria una fila
				  
                    $extra->__SET("Id",$fila["Id"]);
                    $extra->__SET("Nombre",$fila["Nombre"]);
                    $extra->__SET("Precio",$fila["Precio"]);
					 
				  }  	               
				   
				  return $extra; //Retorno el objeto extra
				
			   }
            }