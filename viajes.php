<?php
class Viajes{
  
        //Atributos (El atributo vuelta es un valor que sera verdadero en caso de ser un viaje de ida y vuelta
        //ya que se considera que todo viaje es como minimo de ida)
        private $codigo;
        private $destino;
        private $cantMax;
        private $objPasajeros;
        private $responsable;
        private $importe;
        private $vuelta;
        
        
        //Metodos
        public function __construct($codigo,$destino,$cantMax,$pasajero,$responsable,$importe,$vuelta){
          $this->codigo = $codigo;
          $this->destino = $destino;
          $this->cantMax = $cantMax;
          $this->objPasajeros =$pasajero; 
          $this->Responsable = $responsable;
          $this->importe=$importe;
          $this->vuelta=$vuelta;
        }
        public function getCodigo(){
          return $this->codigo;
        }
        public function getDestino(){
          return $this->destino;
        }
        public function getObjPasajeros(){
          return $this->objPasajeros;
        }
        public function getCantMax(){
          return $this->cantMax;
        }
        public function getImporte(){
          return $this->importe;
        }
        public function getVuelta(){
          return $this->vuelta;
        }
        public function getResponsable(){
          return $this->Responsable;
        }
        public function setCodigo($codigo){
          $this->codigo = $codigo;
        }
        public function setDestino($destino){
          $this->destino = $destino;
        }
        public function setObjPasajeros($objPasajeros){
          $this->objPasajeros = $objPasajeros;
        }
        public function setResponsable($Responsable){
          $this->Responsable=$Responsable;
        }
        public function setCantMax($canMax){
          return $this->cantMax = $canMax;
        }
        public function setImporte($imp){
          $this->importe=$imp;
        }
        public function setVuelta($vuelta){
          $this->vuelta=$vuelta;
        }

        public function __toString(){
          $objResponsable=$this->getResponsable();
          $datosResponsable=$objResponsable->__toString();
          return ("Codigo: ".$this->getCodigo()."\n".
                  "Destino: ".$this->getDestino()."\n".
                  " Cantidad Maxima de Pasajeros: ".$this->getCantMax()."\n".
                  "Importe : ".$this->getImporte()."\n".
                  "Es un viaje de: ".$this->esVuelta()."\n".
                  "Pasajeros: \n".$this->mostrarPasajeros()."\n".
                  "DATOS DEL RESPONSABLE: ".$datosResponsable."\n");
        }


        public function esVuelta(){
          if($this->getVuelta()){
          return "Ida y vuelta";
        }else{
          return "Solo ida";
        }
      }



      public function mostrarPasajeros(){
        $coleccion=$this->getObjPasajeros();
        $pasajeros="";

        for ($i=0;$i<count($coleccion);$i++){
            $personas=$coleccion[$i];
            $pasajeros=$pasajeros.$personas->__toString()."\n";
        }
        return $pasajeros;
      }


      public function importeTemporario(){
        
      }

   
      public function cantidadPasajeros(){
         //Este modulo nos devuelve el numero con la cantidad de pasajeros
        $cantidad = count($this->getObjPasajeros());
        return $cantidad;
    }
          
          
            public function existeViaje($ingresoCodigo){
              return ($this->getCodigo()==$ingresoCodigo);
          }

          public function existeLugar(){
            return ($this->getCantMax()>count($this->getObjPasajeros()));
        }


       

        public function existePasajero($dni){
           //Este modulo verifica si el dni de un pasajero se encuentra ya en el viaje.
        //Sera un recorrido parcial por el arreglo de pasajeros, buscando la existencia del dni.
          $arrayPasajeros = $this->getObjPasajeros();
          $i = 0;
          $existe = false;
           while(!$existe && ($i < count($arrayPasajeros))){
                if($arrayPasajeros[$i]->getDni() == $dni){
                      $existe = true;
                 }else{
                  $i++;
                  }
                }
          return $existe;
              }

      public function venderPasaje($pasajero){
        $importeActual=$this->getImporte();
        if($this->hayPasajesDisponible()){
          if($this->getVuelta()){
          $importeActual= $importeActual+($importeActual/2);
          }

        }else{
          echo "No hay pasajes disponibles";
        }
        return $importeActual;

      }

        
       public function hayPasajesDisponible(){  
         //verifica si existe lugares disponibles para el viaje
         return ((count($this->getObjPasajeros()))<$this->getCantMax());
       }
     

   

     public function agregarPasajero($newPasajero){    
         //Agrega un pasajero a la coleccion de pasajeros
          $arrayPasajeros = $this->getObjPasajeros();
          array_push($arrayPasajeros, $newPasajero);
          $this->setObjPasajeros($arrayPasajeros);
      }
  }
?>