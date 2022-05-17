<?php
class viajeTerrestre extends viajes{
   

    private $tipoAsiento;


    public function __construct($codigo,$destino,$cantMax,$pasajero,$responsable,$importe,$vuelta,$tipoAsiento){
        parent::__construct($codigo,$destino,$cantMax,$pasajero,$responsable,$importe,$vuelta);
        $this->tipoAsiento=$tipoAsiento;


    }

    //Tipo asiento sera una variable que tendra 'C' en caso de ser cama o 'S' en caso de ser semicama
    public function getTipoAsiento(){
        return $this->tipoAsiento;
    }
    public function setTipoAsiento($tAsiento){
        $this->tipoAsiento=$tAsiento;
    }
    public function __toString()
    {
        return parent::__toString()."Tipo de asiento: ".$this->getTipoAsiento();
    }
    public function venderPasaje($pasajero)
    {
        $importeActual=$this->getImporte();
        if($this->getTipoAsiento()=='C'){
            $importeActual=$this->getImporte()+($this->getImporte()/75);
        }
        if ($this->getVuelta()){
            $importeActual=$importeActual+($importeActual/2);
        }
        return $importeActual;
    }
}