<?php
class ResponsableV{
    private $nroEmpleado;
    private $nroLicencia;
    private $nombre;
    private $apellido;

    public function __construct($nroEmp,$nroLic,$nom,$ape){
        $this->nroEmpleado=$nroEmp;
        $this->nroLicencia=$nroLic;
        $this->nombre=$nom;
        $this->apellido=$ape;
        
    }
    public function getNroEmpleado(){
    return $this->nroEmpleado;
    }
    public function getNroLicencia(){
        return $this->nroLicencia;
    }
    public function getNombre(){
        return $this->nombre;
    }
    public function getApellido(){
        return $this->apellido;
    }
    public function setNroEmpleado($nroEmp){
        $this->nroEmpleado=$nroEmp;
    }
    public function setNroLicencia($nroLic){
        $this->nroLicencia=$nroLic;
    }
    public function setNombre($nom){
        $this->nombre=$nom;
    }
    public function setApellido($ape){
        $this->apellido=$ape;
    }
    public function __toString()
    {
        return "Nombre ".$this->getNombre()." Apellido: ".$this->getApellido()." NroEmpleado: ".$this->getNroEmpleado()."NroLicencia: ".$this->getNroLicencia();
    }
}