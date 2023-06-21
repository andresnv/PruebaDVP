<?php
include "libs/db.class.php";
include "libs/api.class.php";

$mAPI = new Api;

$vPOST= filter_input_array(INPUT_POST);
$vGET = filter_input_array(INPUT_GET);

$miServicio='';
if(isset($vGET) && count($vGET)==1){  
    foreach($vGET as $Llave => $dta){
        $miServicio=$Llave;
        break;     
    }
}

if(isset($miServicio) && $miServicio!=''){
    switch($miServicio){
        case 'crearTicket':
        case 'editarTicket': 
            if($miServicio=='editarTicket'){
                if(isset($vPOST["id_ticket"]) && $vPOST["id_ticket"]!=''){                    
                    $mAPI->setId($vPOST["id_ticket"]);
                    $mAPI->setNumRegistros(1);                
                    $mAPI->setNumPagina(1);
                    $mAPI->listarTickets();
                }
                else{
                    $mAPI->error(2);
                    break;
                }
            }                    
            if(isset($vPOST["asunto"])){
                $mAPI->setAsunto($vPOST["asunto"]);                        
            }
            if(isset($vPOST["descripcion"])){
                $mAPI->setDescripcion($vPOST["descripcion"]);
            }
            if(isset($vPOST["prioridad"])){
                $mAPI->setPrioridad($vPOST["prioridad"]);                        
            }
            if(isset($vPOST["usuario"])){
                $mAPI->setUsuario($vPOST["usuario"]);
            }
            if(isset($vPOST["estatus"])){
                $mAPI->setEstatus($vPOST["estatus"]);
            }
            if($miServicio=='crearTicket'){
                $mAPI->nuevoTicket();
            }
            elseif($miServicio=='editarTicket'){
                $mAPI->editarTicket();
            }
            break;
        case 'eliminarTicket':
            if(isset($vPOST["id_ticket"]) && $vPOST["id_ticket"]!=''){
                $mAPI->setId($vPOST["id_ticket"]);
                $mAPI->setNumRegistros(1);                
                $mAPI->setNumPagina(1);
                $mAPI->listarTickets();  
                $mAPI->eliminarTicket();
            }
            else{
                $mAPI->error(2);
            }            
            
            break;
        case 'listarTickets':                                   
            if(isset($vPOST["id_ticket"]) && $vPOST["id_ticket"]!=''){
                $mAPI->setId($vPOST["id_ticket"]);
                $mAPI->setNumRegistros(1);                
                $mAPI->setNumPagina(1);
            }            
             else{                
                if(!isset($vPOST["num_pagina"])){
                    $mAPI->setNumPagina("1");   
                }
                else{                    
                    $mAPI->setNumPagina($vPOST["num_pagina"]);   
                }
                if(!isset($vPOST["num_registros"])){
                    $mAPI->setNumRegistros("1");   
                }
                else{
                    $mAPI->setNumRegistros($vPOST["num_registros"]);
                }
            }
            
            $mAPI->listarTickets();
            break;
        
        default:
            $mAPI->error(5);
            break;
    }
}
else{
    //servicio no recibido
    $mAPI->error(4);
}
$mAPI->respuesta();

