<?php
/**
 * Clase encargada de controlar las rutas (Hacer Routing)
 */
class ruta {
  /*Propiedades*/
  /**$_controladores [Array|Private] Almacena todos los nombres de los controladores en el sistema*/
  private $_controladores = [];

  /*Metodos*/
  /*__toString() en caso tal de que esta clase sea tratada como texto en su instancia mostrará una breve descrición de si misma
  */
  public function __toString(){return "Clase encargada de controlar las rutas para hacer el routing";}

  /*__construct()
  * Recibe a los controladores en forma de arreglo para almacenarlos en la clase
  * @access public
  * @param $a [Array] los controladores llegan en un arreglo
  * @return nothing
  **/
  public function __construct(array $a){
    $this->_controladores = $a;
  }

  /*enviar()
  * Valida y devuelve el controlador solicitado
  * @acess public
  * @return nothing
  */
  public function enviar(){
    $uri = isset($_GET['uri']) ? $_GET['uri'] : '/';
    $split = explode('/',$uri);

    if($uri == '/'){
      $a = array_key_exists('/',$this->_controladores);
    }

    $a=false;
    foreach ($this->_controladores as $k => $v) {
      // code...
    }
  }
}
