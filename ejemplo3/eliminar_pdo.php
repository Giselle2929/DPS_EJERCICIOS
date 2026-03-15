<?php

$pdo = new PDO("mysql:host=localhost;dbname=libreria","root","");

$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM libros WHERE isbn=?");
$stmt->execute([$id]);

$libro = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Eliminar libro</title>
</head>

<body>

<h2>Confirmar eliminación</h2>

<form method="POST">

ISBN<br>
<input type="text" value="<?php echo $libro['isbn']; ?>" readonly>

<br><br>

Autor<br>
<input type="text" value="<?php echo $libro['autor']; ?>" readonly>

<br><br>

Titulo<br>
<input type="text" value="<?php echo $libro['titulo']; ?>" readonly>

<br><br>

Precio<br>
<input type="text" value="<?php echo $libro['precio']; ?>" readonly>

<input type="hidden" name="isbn" value="<?php echo $libro['isbn']; ?>">

<br><br>

<input type="submit" name="eliminar" value="Eliminar">

<a href="mostrarlibros.php">Cancelar</a>

</form>

</body>
</html>

<?php

if(isset($_POST['eliminar'])){

$stmt = $pdo->prepare("DELETE FROM libros WHERE isbn=?");
$stmt->execute([$_POST['isbn']]);

header("Location: mostrarlibros.php");

}

?>
