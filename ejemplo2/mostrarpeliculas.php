<?php
 spl_autoload_register(function ($classname){
 require_once("udb_" . $classname . ".class.php");
 });
 //Definiendo el número total de registros que se van a mostrar
 define("LIMIT", 5);
 //Creando objeto de la clase paginacion
 $paginacion = new paginacion();
 //Obteniendo el número de página de resultados solicitada
 $npage = isset($_GET['npag']) ? $_GET['npag'] : 1;
 $npage = $paginacion->getnumpages($npage);
 //Creando una instancia de la clase database
 $db = DataBase::getInstance();
 $sql = "SELECT SQL_CALC_FOUND_ROWS titulopelicula, descripcion, ";
 $sql .= "nombre, imgpelicula, generopelicula FROM pelicula ";
 $sql .= "JOIN genero ON pelicula.idgenero = genero.idgenero ";
 $sql .= "JOIN director ON pelicula.iddirector = director.iddirector ";
 $sql .= "LIMIT " . $paginacion->getoffset(LIMIT) . ", " . LIMIT;

 $sqlTotal = "SELECT FOUND_ROWS() AS total";
 //Guardando el set de resultados de la consulta a la base de datos en $pelis
 $db->setQuery($sql);
 $pelis = $db->loadObjectList();

 //Obteniendo el total de registros que se van a paginar de la consulta $sql
 //$db->setQuery($sqlTotal);
 $regstotal = $db->getNumRows($sqlTotal);
 //echo $regstotal . "<br />\n";
?>
<!DOCTYPE html>
<html>
<head>
 <meta charset="utf-8" />
 <title>Consultas de varias tablas</title>
 <link rel="stylesheet" href="css/tablas.css" />
 <script src="js/modernizr.custom.lis.js"></script>
</head>
<body>
<section>
<article>
<?php
<form method="GET">

Mostrar 
<select name="limite">

<option value="3">3</option>
<option value="5">5</option>
<option value="10">10</option>
<option value="0">Todos</option>

</select>

<input type="submit" value="Mostrar">

</form>

 //Creando la tabla a mostrar
 $tabla = "<table class=\"tablaps\">\n";
 $tabla .= "<caption>Información de las películas en existencia</caption>\n";
 $tabla .=
"<thead>\n\t<tr>\n\t\t<th>\nTÍTULO\n</th>\n\t\t<th>PORTADA</th>\n<th>\nSINOPSIS\n</th>";
 $tabla .= "\n<th>\nDIRECTOR\n</th>\n<th>\nGÉNERO\n</th>\n</tr>\n</thead>\n<tbody>\n";
 $contador = 1;
 foreach($pelis as $pelicula){
 if($contador%2 == 1) $clase = "impar";
 else $clase = "par";
 $tabla .= "<tr class=\"" . $clase . "\">\n<td>\n" . $pelicula['titulopelicula'] .
"</td>\n";
 $tabla .= "<td>\n<img src=\"" . $pelicula['imgpelicula'] . "\" alt=\"" .
$pelicula['nombre'] . "\" /></td>\n";
 $tabla .= "<td>\n" . $pelicula['descripcion'] . "</td>\n";
 $tabla .= "<td>\n" . $pelicula['nombre'] . "</td>\n";
 $tabla .= "<td>\n" . $pelicula['generopelicula'] . "</td>\n</tr>\n";
 $contador++;
 }
 $tabla .= "</tbody>\n<tfoot>\n<tr>\n<th colspan=\"5\">\n" . $paginacion-
>showlinkspages($regstotal, LIMIT) . "</th>\n</tr>\n</tfoot>\n";
 $tabla .= "</table>\n";
 echo $tabla;
?>
</article>
</section>
</body>
</html>