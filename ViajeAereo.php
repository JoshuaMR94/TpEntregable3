<?php
class viajeAereo extends viajes{
    
    private $numeroViaje;
    private $primeraClase;
    private $nombreAerolinea;
    private $cantEscalas;

    public function __construct($codigo,$destino,$cantMax,$pasajero,$responsable,$importe,$vuelta,$numViaje,$primeraClase,$nomAerolinea,$cantEscalas)
    {
        parent::__construct($codigo,$destino,$cantMax,$pasajero,$responsable,$importe,$vuelta);
        $this->numeroViaje=$numViaje;
        $this->primeraClase=$primeraClase;
        $this->nombreAerolinea=$nomAerolinea;
        $this->cantEscalas=$cantEscalas;
    }
    public function getNumeroViaje(){
        return $this->numeroViaje;
    }
    public function getPrimeraClase(){
        return $this->primeraClase;
    }
    public function getNombreAerolinea(){
        return $this->nombreAerolinea;
    }
    public function getCantEscalas(){
        return $this->cantEscalas;
    }
    public function setNumeroViaje($numViaje){
        $this->numeroViaje=$numViaje;
    }
    public function setPrimeraClase($clase){
        $this->primeraClase=$clase;
    }
    public function setNombreAerolinea($nomAero){
        $this->nombreAerolinea=$nomAero;
    }
    public function setCantEscalas($cantEscalas){
        $this->cantEscalas=$cantEscalas;
    }

    public function esFirstClass(){
        if($this->getPrimeraClase()){
        return "Primera clase";
      }else{
        return "No es primera clase";
      }
    }

    public function __toString()
    {
      return   parent::__toString()." Nombre aerolinea : ".$this->getNombreAerolinea()." Numero viaje: ".$this->getNumeroViaje()." Tipo de viaje: ".$this->esFirstClass()." Cantidad de escalas ".$this->getCantEscalas()."\n"; 
    }

    public function venderPasaje($pasajero)
    {
        $importeNuevo=$this->getImporte();
        if($this->getPrimeraClase()==true){
            if($this->getCantEscalas()==0){
            $importeNuevo= $this->getImporte()+($this->getImporte()/60);
            }else if ($this->getCantEscalas()>0){
                $importeNuevo= $this->getImporte()+($this->getImporte()/40);
            }
        }
        if($this->getVuelta()){
            $importeNuevo=$importeNuevo+($importeNuevo/2);
        }
        return $importeNuevo;
    }
}