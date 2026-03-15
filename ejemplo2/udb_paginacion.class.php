<?php
//Definición de la clase
class paginacion {
 //Propiedades de la clase paginacion
 private $numpage;
 private $totalpages;
 private $links;
 private $offset;
 //Métodos de la clase paginacion
 //El constructor recibe tres argumentos que son:
 //1. $page: El número de la página de resultados que se va a cargar
 //(valores desde 1 hasta el número de páginas totales de resultados)
 //2. $limit: El número máximo de resultados por página.
 //3. $total: El número total de registros obtenidos después de hacer la consulta.
 public function __construct(){
 $this->numpage = 1;
 $this->totalpages = 1;
 $this->links = array();
 $this->offset = 0;
 }
 public function getnumpages($page){
 $this->numpage = (int)$page;
if($this->numpage < 1){
 $this->numpage = 1;
}
 return $this->numpage;
 }

 public function getoffset($limit){
 $this->offset = (($this->numpage)-1) * $limit;
 return $this->offset;
 }
 public function gettotalpages($total, $limit){
 $this->totalpages = ceil($total / $limit);
 return $this->totalpages;
 }
 public function showlinkspages($total, $limit){
 $totpages = $this->gettotalpages($total, $limit);
for($i=1; $i<=$totpages; $i++){
 $this->links[] = ($i == $this->numpage) ? $i : "<a href=\"?npag=$i\">$i</a>";
 }
 return implode(" - ", $this->links);
 }
}
?>