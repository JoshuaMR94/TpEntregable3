<?php
class Pasajero{
    private $nombre;
    private $apellido;
    private $dni;
    private $telefono;


    public function __construct($nom,$ape,$dni,$tel)
    {
        $this->nombre=$nom;
        $this->apellido=$ape;
        $this->dni=$dni;
        $this->telefono=$tel;        
    }
    public function getNombre(){
        return $this->nombre;
    }
    public function getApellido(){
        return $this->apellido;
    }
    public function getDni(){
        return $this->dni;
    }
    public function getTelefono(){
        return $this->telefono;
    }
    public function setNombre($nom){
        $this->nombre=$nom;
    }
    public function setApellido($ape){
        $this->apellido=$ape;
    }
    public function setDni($dni){
        $this->dni=$dni;
    }
    public function setTelefono($tel){
        $this->telefono=$tel;
    }
    public function __toString()
    {
        return "Nombre :".$this->getNombre()." Apellido: ".$this->getApellido()." Dni: ".$this->getDni()." Telefono: ".$this->getTelefono();
    }
}