<?php
require_once 'main.php';
/**
 * Clase personal: interactua con la tabla personal en la base de datos.
 * la clase tiene metodos y propiedades.
 * Se interactuará con ella a traves de AJAX.
 */
class personal extends main
{
  public $id, $rif, $sexo, $cargo;
  public $nombre=[], $apellido=[], $tlf=[], $direccion=[], $email=[];
  private $data=false;

  public function agregar(array $a){
    if(count($a)<=15){
      $this->id=$a['id'];
      $this->rif=$a['rif'];
      $this->sexo=$a['sexo'];
      $this->cargo=$a['cargo'];
      $this->email=$a['emails'];
      $this->tlf=$a['telefonos'];
      $this->nombre=$a['nombres'];
      $this->apellido=$a['apellidos'];
      $this->direccion=$a['direcciones'];
      return $this->data=true;
    }else{ return $this->data=false; }
  }

  public function registrar(){
    if($this->data){
      if(!parent::rif($this->rif)){
        $query=parent::conexion->query("INSERT INTO personas VALUES (NULL,'".$this->rif."','".$this->nombre['primero']."','".$this->nombre['segundo']."','".$this->apellido['primero']."','".$this->apellido['segundo']."','".$this->sexo."','".$this->cargo."')");
        if(($query)&&($query->num_rows===1)){
          $this->id=$query->insert_id();
          $i=0;
          foreach($this->tlf as $tlf){
            $query=parent::conexion->query("INSERT INTO info_personas VALUES (NULL,'".$this->id."','Teléfono','".$tlf."')");//crear función para validar
            if($query){$i++}
          }
          if(count($this->tlf)===$i){
            $o=0;
            foreach ($this->email as $email) {
              $query=parent::conexion->query("INSERT INTO info_personas VALUES (NULL,'".$this->id."','E-mail','".$email."')");
              if($query){$o++}
            }
            if (count($this->email)===$o) {
              #dirección
            }
          }else{
            return print json_encode(array('error'=>1,'info'=>'Ha ocurrido un error al agregar los teléfonos'));
          }
        }else{
          return print json_encode(array('error'=>1,'info'=>'No se ha podido registrar al trabajador'));
        }
      }else{
        return print json_encode(array('error'=>1,'info'=>'El número de rif ya está registrado, por favor intente con otro'));
      }
    }else{
      return print json_encode(array('error'=>1,'info'=>'No se puede proseguir porque no hay datos suficientes con los que trabajar'));
    }
  }
}
$personal=new personal();
$a= array('rif'=>'V-262166950','sexo'=>1,'cargo'=>'programador','emails'=>array('wjmalave@mail.com','wjmalave@gmail.com','wjm@gmail.com'),'telefonos'=>array('0294-3313280','0426-9850374','0294-3319055'),'nombres'=>array('primero'=>'Waldo','segundo'=>'Jesús'),'apellidos'=>array('primero'=>'Malavé','segundo'=>'Santamaría'),'direcciones'=>'waodl');
$personal->agregar($a);
$personal->registrar();
echo "\n\n";
print_r($a);
?>
