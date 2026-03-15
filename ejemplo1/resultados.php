<!DOCTYPE html>
<html lang="es">
<head>
 <meta charset="utf-8" />
 <title>Resultados de la búsqueda</title>
 <link rel="stylesheet" href="css/vertical-nav.css" />
 <link rel="stylesheet" href="css/table-column-options.css" />
 <link rel="stylesheet" href="css/links.css" />
 <!-- <link rel="stylesheet" href="css/libros.css" /> -->
 <script src="js/modernizr.custom.lis.js"></script>
</head>
<body>
<header>
 <h1 class="3d-text">Resultados de la búsqueda</h1>
</header>
<section>
<article>
<?php
 //Asignando los datos ingresados en el formulario
 //a variables locales con nombres cortos
 $tema = trim($_POST['tema']);
 $termino = (isset($_POST['termino']) && is_string($_POST['termino']) &&
strlen($_POST['termino']) > 0) ? $_POST['termino'] : "";
 $termino = trim($termino);
 $tipobusqueda = isset($_POST['tipobusqueda']) ? $_POST['tipobusqueda'] : "";
 if(empty($tema) || empty($termino)){
 $msg = "No se ha ingresado detalle de la búsqueda. ";
 $msg .= "Regrese al formulario e ingrese los datos en el formulario.<br>";
 $msg .= "[<a href=\"busquedalibro.php\">Volver</a>]";
 echo $msg;
 exit(0);
 }
 $tema = addslashes($tema);
 $termino = addslashes($termino);
 //Incluir librería de conexión a la base de datos
 include_once("db-mysqli.php");
 if($tipobusqueda == 'exacta'){
 $consulta = "SELECT * FROM libros WHERE " . $tema;
 $consulta .= " = '" . $termino . "'";
 }
 else{
 $consulta = "SELECT * FROM libros WHERE " . $tema;
 $consulta .= " LIKE '%" . $termino . "%'";
 }
 echo "<div class=\"query\">\n\t<p>" . $consulta . "</p>\n\t";
 $resultc = $db->query($consulta);
 $num_results = $resultc->num_rows;
 echo "<p>Número de libros encontrados: . $num_results</p>\n</div>\n";
 echo "<table class=\"column-options\">\n";
 for($i=0; $i<$num_results; $i++){
 $row = $resultc->fetch_assoc();
 echo "<colgroup>\n";
 echo "<col>\n";
 echo "</colgroup>\n";
 echo "<colgroup>\n";
 echo "<col>\n";
 echo "</colgroup>\n";
 echo "<thead>\n";
 echo "<tr class=\"odd\" onmouseover=\"this.className='selected'\"
onmouseout=\"this.className='odd'\">\n";
 echo "<th colspan=\"2\">Libro " . ($i + 1) . "</th>\n</tr>\n";
 echo "</thead>\n<tbody>\n";
 echo "<tr onmouseover=\"this.className='selected'\"
onmouseout=\"this.className=''\">\n<th>\n";
 echo "Título " . ($i + 1) . ": \n";
 echo "</th>\n<td>\n";
 echo stripslashes($row['titulo']);
 echo "\n</td>\n</tr>\n";
 echo "<tr class=\"odd\" onmouseover=\"this.className='selected'\"
onmouseout=\"this.className='odd'\">\n<th>\n";
 echo "Autor :\n";
 echo "</th>\n<td>\n";
 echo stripslashes($row['autor']);
 echo "\n</td>\n</tr>\n";
 echo "<tr onmouseover=\"this.className='selected'\"
onmouseout=\"this.className=''\">\n<th>\n";
 echo "ISBN: \n";
 echo "</th>\n<td>\n";
 echo stripslashes($row['isbn']);
 echo "\n</td>\n</tr>\n";
 echo "<tr class=\"odd\" onmouseover=\"this.className='selected'\"
onmouseout=\"this.className='odd'\">\n<th>\n";
 echo "Precio: \n";
 echo "</th>\n<td>\n";
 echo stripslashes($row['precio']);
 echo "\n</td>\n</tr>\n";
 echo "</tbody>";
 }
 echo "</table>";
 /* $msg = "<p>[<a href=\"busquedalibro.html\">realizar otra búsqueda</a>]&nbsp&nbsp";
 $msg .= "[<a href=\"menuopciones.html\">volver al menú</a>]</p>";
 echo $msg; */
 $resultc->free();
 $db->close();
?>
<a href="busquedalibro.html" class="a-btn">
 <span class="a-btn-symbol">i</span>
 <span class="a-btn-text">Realizar</span>
 <span class="a-btn-slide-text">otra búsqueda</span>
 <span class="a-btn-slide-icon"></span>
</a>
<a href="menuopciones.html" class="a-btn">
 <span class="a-btn-symbol">i</span>
 <span class="a-btn-text">Regresar</span>
 <span class="a-btn-slide-text">al menú</span>
 <span class="a-btn-slide-icon"></span>
</a>
</article>
</section>
</body>
</html>