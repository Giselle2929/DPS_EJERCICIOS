<?php
include_once("db-mysqli.php");

$limite = 5;

if(isset($_GET['limite'])){
    $limite = $_GET['limite'];
}

$sql = "SELECT * FROM libros";

if($limite != "todos"){
$sql .= " LIMIT $limite";
}

$result = $db->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Mostrar libros</title>
</head>

<body>

<h2>Lista de libros</h2>

<form method="GET">

Mostrar

<select name="limite">

<option value="3">3</option>
<option value="5" selected>5</option>
<option value="10">10</option>
<option value="todos">Todos</option>

</select>

<input type="submit" value="Mostrar">

</form>

<br>

<table border="1">

<tr>
<th>ISBN</th>
<th>Autor</th>
<th>Titulo</th>
<th>Precio</th>
<th>Modificar</th>
<th>Eliminar</th>
</tr>

<?php

while($row = $result->fetch_assoc()){

echo "<tr>";

echo "<td>".$row['isbn']."</td>";
echo "<td>".$row['autor']."</td>";
echo "<td>".$row['titulo']."</td>";
echo "<td>".$row['precio']."</td>";

echo "<td><a href='modificar.php?id=".$row['isbn']."'>Modificar</a></td>";

echo "<td><a href='eliminar.php?id=".$row['isbn']."'>Eliminar</a></td>";

echo "</tr>";

}

?>

</table>

</body>
</html>

