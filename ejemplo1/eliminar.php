<?php
include_once("db-mysqli.php");

$isbn = $_GET['id'];

$sql = "SELECT * FROM libros WHERE isbn='$isbn'";
$result = $db->query($sql);
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Confirmar eliminación</title>
</head>

<body>

<h2>Eliminar libro</h2>

<form method="POST">

<p>
ISBN<br>
<input type="text" value="<?php echo $row['isbn']; ?>" readonly>
</p>

<p>
Autor<br>
<input type="text" value="<?php echo $row['autor']; ?>" readonly>
</p>

<p>
Titulo<br>
<input type="text" value="<?php echo $row['titulo']; ?>" readonly>
</p>

<p>
Precio<br>
<input type="text" value="<?php echo $row['precio']; ?>" readonly>
</p>

<input type="hidden" name="isbn" value="<?php echo $row['isbn']; ?>">

<br>

<input type="submit" name="confirmar" value="Eliminar">
<a href="mostrarlibros.php">Cancelar</a>

</form>

</body>
</html>

<?php

if(isset($_POST['confirmar'])){

$isbn = $_POST['isbn'];

$sql = "DELETE FROM libros WHERE isbn='$isbn'";
$db->query($sql);

header("Location: mostrarlibros.php");

}

?>


