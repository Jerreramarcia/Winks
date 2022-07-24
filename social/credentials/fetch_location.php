<?php
{

 $db = mysqli_connect("localhost", "root","","winks");
if($db->connect_error){
	echo "error con la base de datos";
}
	
	$state = $_POST['get_option'];
	$query_1 = "select id from pais where nombre='".$state."'";

	$salida = mysqli_query($db,$query_1);
	
	$id = $salida->fetch_assoc();
	$query = "select * from provincia where id_pais='".$id['id']."'";
 	$find=mysqli_query($db,$query);
 	echo "<option>Selecciona provincia</option>";
 	while($row=mysqli_fetch_array($find))
 	{
 		echo "<option id='".$row['id']."'>".$row['nombre']."</option>";
 	}
	exit;
}
?>


