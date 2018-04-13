<?php
/**
 * Clase principal de PHP y del sistema, cuenta con los metodos para conectarse a la base de datos
 * y para guardar con el historial.
 */
class main
{
  //PROPIEDADES
  public $meses = array("Enero"=>1,"Febrero"=>2,"Marzo"=>3,"Abril"=>4,"Mayo"=>5,"Junio"=>6,"Julio"=>7,"Agosto"=>8,"Septiembre"=>9,"Octubre"=>10,"Noviembre"=>11,"Diciembre"=>12);
  public $conexion;
  //METODOS
  public function __construct(){
    $var=new mysqli('localhost', 'root', '', 'tipografia', 3306);
    if ($var->connect_errno) {
      return print "Hay un fallo en la conexión: ".$con->connect_error;
      die();
    }else{
      $var->query("SET NAMES 'utf8'");
      $var->set_charset("utf8");
      return $this->conexion=$var;
    }
  }

  public function historial(string $a): bool{
    if($query=$this->conexion()->query("INSERT INTO historial VALUES ('".$a."',NOW(),NOW(),'".$_SESSION[user]."')")){
      return true;
    }else{
      return false;
    }
  }

  public function consola($a){
    return print "<script>console.log(\"$a\")</script>";
  }

  /*
  * Metodo para validar si un rif ya está en el sistema:
  * Sí ese es el caso, se retornará verdadero.
  * Sí la persona no está registrada, retornará falso.
  */
  public function rif($rif): bool{
    if(($query=$this->conexion->query("SELECT id FROM personas WHERE rif = '".$rif."'"))&&($query->num_rows===1)){
      return true;
    }else{ return false; }
  }
}
?>
