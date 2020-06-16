<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tu concesionario de confianza</title>
</head>
<!-- Sobre la base de datos “Concesionario” que se le facilita, deberá realizar los Script php que permitan realizar pedidos de los coches disponibles con las siguientes especificaciones:

-La página mostrará un desplegable con los datos de los Clientes y otro que muestre la Marca y el Modelo de cada coche como su descripción (dado que no me dan descripción del coche, entiendo que se refiere a precio).

-Al seleccionar un coche mostrará todos los extras disponibles (se presupone por simplificar que todos lo extras están disponibles para todos los coches con idéntico precio), cada extra deberá ser mostrado por pantalla mediante un Checkbox junto con el nombre de ese extra como su descripción (precio).

-Deberá mostrar también un campo de texto llamado Total y un botón llamado Calcular.

-Al pulsar en el botón Calcular mostrará en el campo Total el valor del  precio del coche junto con los extras que se hubiera seleccionado.

-Al final habrá otro Botón llamado Pedir que enviará los datos a otra página que deberá realizar el pedido de ese Coche con los extras seleccionados (esto no lo hago porque no tenemos información suficiente para hacerlo) -->
<body>

    <?php

        require_once "ClassConexion.php"; 
        require_once "Cliente.php";
        require_once "daoCliente.php"; 
        require_once "Coche.php";
        require_once "daoCoche.php";
        require_once "Extra.php";
        require_once "daoExtra.php";
    ?>



<form method="POST" name="formulario" action="<?php $_SERVER['PHP_SELF']?>">

<label for="Cliente"> Seleccione un cliente </label>
        <select name="Cliente" id="Cliente">
            <option value="-1">Seleccione un cliente</option>
        <?php 
            $daoCliente=new DaoCliente("concesionario"); //Creo un objeto daoCliente y le paso la BBDD como parámetro, así conecta
            $daoCliente->Listar(); //llamo al método listar
            foreach ($daoCliente->Clientes as $key => $value) { //Dado que con listar lo que hago es rellenar el array de Clientes, accedo a él y lo recorro ya con normalidad. Recorro el array que he rellenado con el DAO y lo muestro
                echo "<option value='" . $value->NIF . "'>" . $value->Apellido1 ." ". $value->Apellido2 .", ". $value->Nombre."</option>";
                }
        ?>    
        </select>

<br><br>

<label for="Coche"> Seleccione un coche </label>
        <select name="Coche" id="Coche">
            <option value="-1">Seleccione un coche</option>
        <?php 
            $daoCoche=new DaoCoche("concesionario"); //Creo un objeto daoCoche y le paso la BBDD como parámetro, así conecta
            $daoCoche->Listar(); //llamo al método listar
            foreach ($daoCoche->Coches as $key => $value) { //Dado que con listar lo que hago es rellenar el array de Coches, accedo a él y lo recorro ya con normalidad. Recorro el array que he rellenado con el DAO y lo muestro
                if(isset($_POST['Coche']) && $_POST['Coche'] === $value->Id){ //Si está seteado el coche (value, por ejemplo 1) y como estoy recorriendo si el valor seleccionado es igual al id del value, que en este caso es un objeto coche. Con el selected se queda fijado
                    echo "<option selected value='" . $value->Id . "'>" . $value->Marca ." ". $value->Modelo .", Precio: ". $value->Precio."</option>";
                }else{ //En caso contrario me muestras el option normal
                    echo "<option value='" . $value->Id . "'>" . $value->Marca ." ". $value->Modelo .", Precio: ". $value->Precio."</option>";
                }
                
                }
        ?>    
        </select>
<br><br>
<input type="submit" name="VerExtras" value="Ver Extras para el coche seleccionado"/>
<br> <br> <br> <br>

<?php






if( (isset($_POST['VerExtras'])  ) && $_POST['Coche']!=-1) {

?>

<table>
    <tr>
        <th></th>
        <th>ID</th>
        <th>Nombre</th>
        <th>Precio</th>
    <tr>

<?php

    $daoExtra=new DaoExtra("concesionario"); //Hago la conexión con la BBDD
    $daoExtra->Listar(); 
    foreach ($daoExtra->Extras as $key => $extra) { //Como ya hice el listar arriba, simplemente recorro el array que he rellenado con dicho método y voy poniendo los names y values que me permitan mostrarlo en formato tabla
        echo "<tr>";

        echo "<td>";
        echo "<input type='checkbox' name='Extrascheckbox[]' value='".$extra->Id."'>";
        echo "</td>";

        echo "<td>";
        echo "<input type='text' name='".$extra->Id."_Id' value='".$extra->Id."'>"; 
        echo "</td>";

        echo "<td>";
        echo "<input type='text' name='".$extra->Id."_Nombre' value='".$extra->Nombre."'>"; 
        echo "</td>";

        echo "<td>";
        echo "<input type='text' name='".$extra->Id."_Precio' value='".$extra->Precio."'>"; 
        echo "</td>";

        

        echo "</tr>"; 

      
    }

    echo "</table>";
    echo "<br><br>";

    echo "<input type='submit' name='calcularPrecio' value='Calcular precio total'/>";

    echo "<br><br>";


    

}



if(isset ($_POST['calcularPrecio']) ){

    $IdCoche=$_POST['Coche'];
    $daoCoche=new daoCoche("concesionario");
    $cocheBuscado=$daoCoche->ObtCoche($IdCoche); //Así ya tendría el objeto coche

    $precioCoche=$cocheBuscado->Precio; //Accedo al precio del coche y lo meto en una variable
        
    if(isset ($_POST['Extrascheckbox']) ){

        $extrasCheckbox=$_POST['Extrascheckbox']; //Cojo el array de extras checkbox, que es un array asociativo
        $daoExtra=new daoExtra("concesionario"); //Conecto con la BBDD
        $extrasObjetos=array(); //Creo un array para guardar los objetos extras completos y así poder acceder al precio

        foreach ($extrasCheckbox as $key => $value) {
          $Id=$value;
          $extraBuscado=$daoExtra->ObtExtra($Id); //Así tengo ya el extra que estaba buscando
          array_push($extrasObjetos, $extraBuscado); //Meto en el array de objetos extras el objeto extra buscado
        }

        $precioTotalExtras=0; //Declaro e inicializo una variable para guardar el total del precio de los extras

        foreach ($extrasObjetos as $key => $extra) {
            $precioCoche+=$extra->Precio; 
        }

    }

    //Cuando estoy en calcular precio, muestro el precio total en el input que exije el ejercicio    
    echo "<label for='total'>Precio total</label>"; 
    echo "<input type='text' name='total' id='total' value=' " . $precioCoche . " '/>"; 
  

}


?>

</form>
</body>
</html>