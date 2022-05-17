<?php


include "viajes.php";
include "viajeTerrestre.php";
include "viajeAereo.php";
include "pasajeros.php";
include "responsableV.php";


function aniadirViaje($cant)
{
    $arrayViajes = [];
    $arrayPasajeros = [];
    for($i = 0; $i < $cant;$i++){
        $responsable = AniadirResponsable();
        echo "Ingrese el codigo del viaje  : \n";
        $codigo = trim(fgets(STDIN));
        echo "Ingrese el destino del viaje  : \n";
        $destino= trim(fgets(STDIN));
        echo "Ingrese la cantidad de pasajeros maximos : \n";
        $cantMax = trim(fgets(STDIN));
        echo "Ingrese la cantidad de personas que realizaran el viaje :\n ";
        $cantPersonas = trim(fgets(STDIN));
        echo "Importe del viaje: ";
        $importe=trim(fgets(STDIN));
        echo "Es viaje de ida y vuelta?(si/no)";
        $seleccion=trim(fgets(STDIN));
        if($seleccion=="si"){
            $vuelta=true;
        }else{$vuelta=false;}
        if($cantPersonas <= $cantMax){
            for($i = 0;$i < $cantPersonas;$i++){
            $objPasajero = crearPasajero();
            array_push($arrayPasajeros, $objPasajero);
            }
            $arrayViajes[$i] = new Viajes($codigo,$destino,$cantMax,$objPasajero,$responsable,$importe,$vuelta);
        }else{
            echo "La cantidad de personas no puede ser mayor que la cantidad maxima de pasajeros"."\n";
        }
    }
    return $arrayViajes;  
}
//Verifica que el viaje en cuestion sea valido
function viajeExistente($viajes, $codigo){
    
  $i = 0;
  $cantidad = count($viajes);
  $existe = false;
  while ($i < $cantidad && !$existe) {
      $objViaje = $viajes[$i];
      if ($objViaje->existeViaje($codigo)) {
          $existe = true;
      }
      $i++;
  }
  return $existe;
}

function encontrarViaje($viajes, $codigo){
  $i = 0;
  $cantidad = count($viajes);
  $encontrado = false;
  while ($i < $cantidad && !$encontrado) {
      $objViaje = $viajes[$i];
      if ($objViaje->getCodigo() == $codigo) {
          $encontrado = true;
      }else{
      $i++;}
  }
  return $i;
}




function mostrarDatos($viajes){

  echo "ver datos \n";
  echo "################# \n";
  echo "Ingresar un codigo: ";
  $codigo = trim(fgets(STDIN));
  if (viajeExistente($viajes, $codigo)) {
      $objViaje = encontrarViaje($viajes, $codigo);
      echo $objViaje;
  } else {
      echo "no existe ese: " . $codigo . "\n";
  }
}


//Modulo que crea el objeto pasajero
function crearPasajero()
{
    echo "ingrese el nombre del pasajero: ";
    $nombre =  trim(fgets(STDIN));
    echo "ingrese el apellido del pasajero: ";
    $apellido =  trim(fgets(STDIN));
    echo "ingrese el DNI del pasajero: ";
    $dni =  trim(fgets(STDIN));
    echo "ingrese el telefono del pasajero: ";
    $telefono =  trim(fgets(STDIN));
    echo "\n";
    $nuevoPasajero = new Pasajero($nombre,$apellido,$dni,$telefono);
    return $nuevoPasajero;
}


function aniadirPasajero($viajes){

  echo "aniadir pasajero nuevo \n";
  echo "######################## \n";
  echo "ingresar codigo de viaje: ";
  $codigo = trim(fgets(STDIN));
  if (viajeExistente($viajes, $codigo)) {
      $indice = encontrarViaje($viajes, $codigo);
      $objViaje=$viajes[$indice];

      if ($objViaje->getCantMax()>0){
      echo "Ingresar dni: ";
      $dni = trim(fgets(STDIN));
      if ($objViaje->existePasajero($dni)) {
          echo "pasajero ya existe \n";
      } else {
          echo "Ingrese el nombre: ";
          $nombre = trim(fgets(STDIN));
          echo "Ingrese el apellido: ";
          $apellido = trim(fgets(STDIN));
          echo "Ingrese el telefono: ";
          $telefono = trim(fgets(STDIN));
          $newPasajero=new Pasajero ($nombre,$apellido,$dni,$telefono);
          $objViaje->agregarPasajero($newPasajero);
          return $newPasajero;
      }     
    }
  }
}
    function mostrarPasajeros($viajes){
  
      echo "pasajeros abordo del viaje \n";
      echo "#################################\n";
      echo "Ingrese un codigo de viaje: ";
      $codigo = trim(fgets(STDIN));
      if (viajeExistente($viajes, $codigo)) {
        $indice = encontrarViaje($viajes, $codigo);
        $objViaje=$viajes[$indice];
          echo $objViaje->mostrarPasajeros();
      } else {
          echo "codigo incorrecto:" . $codigo . "\n";
      }
  }


  
  function modificarDatosViaje ($viajes){
      //Esta funcion toma un viaje, analiza su codigo y en caso de ser correcto permite su modificacion
    $cantidad = count($viajes);

    echo "*************************** \n";
    echo "Ingrese un codigo de viaje: ";
    $codigo = trim(fgets(STDIN));
    if (viajeExistente($viajes, $codigo)) {
        $indice = encontrarViaje($viajes, $codigo);
        $objViaje=$viajes[$indice];
        echo "Ingrese destino: ";
        $destino = trim(fgets(STDIN));
        echo "Ingrese cantidad de pasajeros maxima: ";
        $cantidad = trim(fgets(STDIN));
        echo "Ingrese el importe del viaje: ";
        $importe = trim(fgets(STDIN));
        echo "Es un viaje de ida y vuelta? (S/N): ";
        $opcionVuelta = trim(fgets(STDIN));
        if($opcionVuelta=='S'){
            $vuelta=true;
        }else{$vuelta=false;}
        $objViaje->setDestino($destino);
        $objViaje->setCantMax($cantidad);
        $objViaje->setImporte($importe);
        $objViaje->setVuelta($vuelta);
        echo"viaje modificado vuelva pronto \n";
    } else {
        echo "codigo incorrecto: \n";
    }
  }

 
  function mostrarViajes($viajes)

{
     //Muestra todos los viajes
    $i = 1;
    foreach($viajes as $viaje){
        echo "Viaje: ".($i)."\n";
        echo $viaje."\n";
        $i++;
    }
}




    function modificarDatosPasajero($viajes){
          //Modifica los datos de un pasajero
      $cant = count($viajes);
  
      echo "modificar datos \n";
      echo "################################ \n";
      echo "Ingrese el codigo del viaje: ";
      $codigo = trim(fgets(STDIN));
      if (viajeExistente($viajes, $codigo)) {
        $indice = encontrarViaje($viajes, $codigo);
        $objViaje=$viajes[$indice];
          echo $objViaje;
          echo "Ingrese el DNI del pasajero: ";
          $eseDni=trim(fgets(STDIN));
          if ($objViaje->existeDni($eseDni)){
              echo "Ingrese nuevo Nombre: ";
              $nuevoNombre=trim(fgets(STDIN));
              echo "Ingrese nuevo Apellido: ";
              $nuevoApellido=trim(fgets(STDIN));
              echo "Ingrese nuevo DNI: ";
              $nuevoDni=trim(fgets(STDIN));
              echo "Ingrese nuevo Telefono: ";
              $nuevoTelefono=trim(fgets(STDIN));
              
              $objViaje->modificarPasajero($eseDni,$nuevoNombre,$nuevoApellido,$nuevoDni,$nuevoTelefono);
  
          }else{
              echo" No existe ningun pasajero en el viaje con ese dni \n";
          }
      }
  }
  

function AniadirResponsable(){
    //Aniade un responsable al viaje
    echo "RESPONSABLE DEL VIAJE \n";
    echo "################################ \n";
        echo "Ingrese Nombre: ";
        $nombre=trim(fgets(STDIN));
        echo "Ingrese Apellido: ";
        $apellido=trim(fgets(STDIN));
        echo "Ingrese numero Legajo: ";
        $numLegajo=trim(fgets(STDIN));
        echo "Ingrese numero Licencia: ";
        $numLicencia=trim(fgets(STDIN));

        return new ResponsableV($nombre,$apellido,$numLegajo,$numLicencia);
    }

    function ventaDePasaje(){


    }






    function menu(){
      /** @var int $opcion 
       *@var boolean $esValido */
      $esValido = false;
    
      echo "--------------------------------------------------------------";
      echo "\n ( 1 ) Agregar viajes nuevos";
      echo "\n ( 2 ) Modificar datos del viaje";
      echo "\n ( 3 ) Modificar datos de un pasajero";
      echo "\n ( 4 ) Ver los datos del viaje";
      echo "\n ( 5 ) Ver todos los viajes";
      echo "\n ( 6 ) Agregar pasajeros al viaje";
      echo "\n ( 7 ) Vender un pasaje";
      echo "\n ( 8 ) Salir del programa"; 
      echo "\n--------------------------------------------------------------\n";
      echo "\n"." Ingrese una opcion: " . "\n";
    
      do {
          $opcion = trim(fgets(STDIN));
    
          if ($opcion >= 1 && $opcion <= 8) {
              $esValido = true;
          } else {
              echo "Ingrese una opcion valida." . "\n";
          }
      } while (!$esValido);
    
      return $opcion;
    }






        //menu principal
#######################################################################################       





//**********coleccion de viajes*****************/
$pasajerosViaje1 = [new Pasajero("Bob","Marley",12354487,2994512478),
                new Pasajero("Lionel","Messi",28541245,2994635988),
                new Pasajero("Rosa","Rosada",23564842,299330278)];
$pasajerosViaje2 = [new Pasajero("Pepe","Mujica",4535234,2994512345),
                new Pasajero("Lola","Perez",743534,2994641238),
                new Pasajero("Elsin","Nombre",43242311,299343456)];
$pasajerosViaje3 = [new Pasajero("Courtney","Love",65473473,299441235),
                new Pasajero("Lita","Ford",897643,2994235654),
                new Pasajero("Joan","Jett",673463,2993213178)];                
$pasajerosViaje4 = [new Pasajero("Bart","Simpson",321312312,2994432528),
                new Pasajero(" Bar","Sinso",938493,2994984892),
                new Pasajero("Bort","Sampson",23564842,299330278)];                                             
$viajes[0] = new Viajes("1","neuquen",3,$pasajerosViaje1,(new ResponsableV(516464,787554,"Pedro","Perez")),20000,true);
$viajes[1]=new Viajes ("2","cipolleti",4,$pasajerosViaje2,(new ResponsableV(5342532,23443643,"Juana","Juanita")),10000,false);
$viajeTerrestre[1]=new ViajeTerrestre ("3","cinco saltos",7,$pasajerosViaje4,(new ResponsableV(516464,787554,"Pedro","Perez")),4000,true,'C');
$viajeTerrestre[0]=new ViajeTerrestre ("4","centenario",6,$pasajerosViaje3,(new ResponsableV(54353,23413487,"Don","Omar")),8000,false,'S');
$viajeAereo[0]=new viajeAereo("5","Buenos Aires",10,$pasajerosViaje1,new ResponsableV(123125,35325623,"Tito","Puente"),50000,false,500,true,"pepito",3);
$viajeAereo[1]=new viajeAereo("6","Cordoba",8,$pasajerosViaje2,new ResponsableV(994358,38725783,"Marcelo","Gallardo"),80000,true,800,true,"Flymorfi",0);

    //Switch creado para elejir entre las opciones del menu
    do {
        $opcion = menu();
      
        switch ($opcion) { 
            case 1: 
              echo "Ingrese la cantidad de viajes que desea agregar: ";
        $cant = trim(fgets(STDIN));
        $nuevosViajes = aniadirViaje($cant);
        //Aqui "fusionamos" ambos arreglos(diferente de añadirlo al final)
        $viajes = array_merge($viajes, $nuevosViajes);
            break;
            
            case 2:

              modificarDatosViaje($viajes);
                break;
            case 3:
              modificarDatosPasajero($viajes);
                break;
          
            case 4:
              echo "Ingrese el codigo del viaje a ver";
              $codigo=trim(fgets(STDIN));
              $indice=encontrarViaje($viajes,$codigo);
              echo "datos del viaje son: "."\n";
              echo $viajes[$indice];
              break;

            case 5:
              mostrarViajes($viajes);
              break;
          
            case 6: 
              echo "Ingrese el codigo del viaje al que se aniadiran los pasajeros";
              $codigo=trim(fgets(STDIN));
              $indice=encontrarViaje($viajes,$codigo);
              echo "Cuantos pasajeros ingresaran al viaje?";
               $cant = trim(fgets(STDIN));
              $cantPasajeros = $viajes[$indice]->cantidadPasajeros() + $cant;
              if($cantPasajeros <= $viajes[$indice]->getCantMax()){
                    for($i = 0;$i < $cantPasajerosNuevos;$i++){
                          $objPasajero = aniadirPasajero($viajes);
                          $viajes[$indice]->agregarPasajero($objPasajero);
                      }                
                      echo "Los pasajeros han sido agregados al viaje \n";
                  }else{
                      echo "La cantidad de pasajeros no puede ser superior a la cantidad maxima permitida \n";
                  }
              
              break;
            case 7:

                echo "El pasaje sera aereo o terrestre? (a/t)";
                $valor=trim(fgets(STDIN));
                echo "Codigo del viaje: ";
                $codigo=trim(fgets(STDIN));
                if($valor=="a"){
                 if(viajeExistente($viajeAereo,$codigo)){
                    $indice=encontrarViaje($viajeAereo,$codigo);
                    $newPasajero=aniadirPasajero($viajeAereo);
                    if($viajeAereo[$indice]->existePasajero($newPasajero->getDni())){
                        $importe=$viajeAereo[$indice]->venderPasaje($newPasajero);
                        echo "Pasajero aniadido con exito, el importe total es: ".$importe."\n";
                        echo $viajeAereo[$indice];

                    }else{
                        echo "Error, ya existe el pasajero en el viaje";
                    }
                 }else{echo "Error, no existe ningun viaje con ese codigo";}
                }else if($valor=='t'){
                        if(viajeExistente($viajeTerrestre,$codigo)){
                            $indice=encontrarViaje($viajeTerrestre,$codigo);
                            $newPasajero=aniadirPasajero($viajeTerrestre);
                            if($viajeTerrestre[$indice]->existePasajero($newPasajero->getDni())){
                                $importe=$viajeTerrestre[$indice]->venderPasaje($newPasajero);
                                echo "Pasajero aniadido con exito, el importe total es: ".$importe."\n";
                                echo $viajeTerrestre[$indice];
        
                            }else{
                                echo "Error, ya existe el pasajero en el viaje";
                            }
                        }else{echo "Error, no existe ningun viaje con ese codigo";}
                         

                     }
                   else{echo "Error, al seleccionar el tipo de viaje";}

              break;
            case 8: 
            echo "usted a salido del programa \n";
                 
            break;
            }
          
          
              
      
    
          }while ($opcion !=8);
          