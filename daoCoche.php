<?php

require_once("Coche.php");
require_once("classConexion.php");

class daoCoche extends Conexion { //Esta clase hereda de Conexión.
	
              
               public $Coches=array();    //Array de objetos Coches
               

	
	           public function Listar() //Función para listar los coches
	           {
				   
				  $this->Coches=array(); //Hay que vaciar el array de objetos coches 
				   
				  $consulta="select * from coches";

                  $param=array(); //Creo un array para pasarle parámetros

                  $this->Consulta($consulta,$param); //Ejecuto la consulta
            			
				  foreach ($this->datos as $fila)  //Recorro el array de la consulta
				  {
					   
					  $coche = new Coche();  //Creo un nuevo objeto
                                             //Le seteo las variables, y así me ahorro el constructor   
                      $coche->Id = $fila["Id"]; //Accedo a la propiedad directamente
					  $coche->__SET("Marca",$fila["Marca"]);
					  $coche->__SET("Modelo",$fila["Modelo"]);
					  $coche->__SET("Precio",$fila["Precio"]);
                      
                      $this->Coches[]=$coche; //Meto el coche en el array Coches

				  }
			   }
			   
			   public function ObtCoche($Id) //Función para la búsqueda de un coche según su ID
	           {
				   
				  $consulta="select * from coches where Id=:Id"; //Construyo la consulta SQL

                  $param=array(":Id"=>$Id); //Esta consulta sí lleva un parámetro, el ID 

                  $this->Consulta($consulta,$param); //Ejecuto la consulta
				  
				  $coche = new Coche();  //Construyo un objeto coche
            	
				  if (count($this->datos) > 0 )         //Si el coche está en la BBDD según su ID
				  {
				     $fila=$this->datos[0];  //La columna solo revolveria una fila
				 
                    $coche->__SET("Id",$fila["Id"]);
                    $coche->__SET("Marca",$fila["Marca"]);
                    $coche->__SET("Modelo",$fila["Modelo"]);
                    $coche->__SET("Precio",$fila["Precio"]);
					 
				  }  	               
				   
				  return $coche; //Retorno el objeto coche
			   }
















            }