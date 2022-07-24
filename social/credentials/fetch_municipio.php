<?php
{

 $db = mysqli_connect("localhost", "root","","winks");
if($db->connect_error){
	echo "error con la base de datos";
}
	
	$state = $_POST['get_municipio'];
	$query_1 = "select id from provincia where nombre='".$state."'";
	echo $query_1;
	$salida = mysqli_query($db,$query_1);
	
	$id = $salida->fetch_assoc();
	$query = "select * from localidad where id_provincia='".$id['id']."'";
 	$find=mysqli_query($db,$query);
  	echo "<option>Selecciona municipio</option>";
 	while($row=mysqli_fetch_array($find))
 	{
 		echo "<option id='".$row['id']."'>".$row['nombre']."</option>";
 	}
	exit;
}
?>


