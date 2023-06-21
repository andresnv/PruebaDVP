<?php

class Api {
    
    private $asunto;
    private $descripcion;
    private $usuario;
    private $prioridad;
    private $estatus;
    private $numRegistros;    
    private $numPagina;    
    private $HayError=false;
    private $db;
    private $id = "";
    private $nombreTbl = "tickets";
    private $camposTbl = array("asunto" =>"", "descripcion" =>"", "prioridad" =>"", "usuario" =>"", "estatus" => "Abierto");
    public $respuesta;
    
    /**************************** SETS ****************************************/
    
    function setAsunto($dato){
        if($dato!=''){
            $this->asunto = $dato;
        }
        else{
            $this->error(1, ["asunto, Campo vacío"]);
            return false;
        }
    }
    function setId($dato){
        if($dato!='' && is_int($dato*1)){
            $this->id = $dato;
        }
        else{
            $this->error(1, ["id, Campo vacío"]);
            return false;
        }
    }
    function setDescripcion($dato){
        if($dato!=''){
            $this->descripcion = $dato;
        }
        else{
            $this->error(1, ["descripcion, Campo vacío"]);
            return false;
        }
    }
    function setUsuario($dato){
        if($dato!=''){
            $this->usuario = $dato;
        }
        else{
            $this->error(1, ["usuario, Campo vacío"]);
            return false;
        }
    }
    function setNumRegistros($dato){        
        if($dato!='' && is_int($dato*1)){
            $this->numRegistros = $dato;
        }
        else{
            $this->error(1, ["num_registros, Campo vacío o no es número"]);
            return false;
        }
    }
    function setNumPagina($dato){
        if($dato!='' && is_int($dato*1)){
            $this->numPagina = $dato;
        }
        else{
            $this->error(1, ["num_pagina, Campo vacío o no es número"]);
            return false;
        }
    }
    function setPrioridad($dato){        
        $arr2=['Alto', 'Medio', 'Bajo'];
        if(in_array($dato ,$arr2)) {
            $this->prioridad = $dato;
        }     
        else{
            $this->error(1, ["prioridad, Valores Aceptados: ". implode(",", $arr2)]);
            return false;
        }        
    }
    function setEstatus($dato){        
        $arr2=['Abierto', 'Cerrado'];
        if(in_array($dato ,$arr2)) {
            $this->estatus = $dato;
        }     
        else{
            $this->error(1, ["estatus, Valores Aceptados: ". implode(",", $arr2)]);
            return false;
        }        
    }
    /**************************************************************************/
    
    function __construct() {
        $this->db = new DB;
    }

    function listarTickets(){   
        if($this->HayError){
            return false;
        }
        $query = "SELECT * FROM ".$this->nombreTbl." ";
        if($this->id!=''){
            $query.= "WHERE id ='".$this->id."' ";
        }
        $query.="ORDER BY id DESC ";
        $offset = ($this->numPagina-1) * $this->numRegistros;
        $query.="LIMIT ".$this->numRegistros." OFFSET ".$offset;
                
        $this->db->consulta($query);     
        
        $rpta=array();
        $cont = 0;
        if($this->db->numRegistros()>0){
            $dts = $this->db->bdFetchAssoc();            
            foreach ($dts as $dto){
                $rpta["Id"][$cont]=$dto->id;
                $rpta["Asunto"][$cont]=$dto->asunto;
                $rpta["Usuario"][$cont]=$dto->usuario;
                $rpta["Prioridad"][$cont]=$dto->prioridad;
                $rpta["Estatus"][$cont]=$dto->estatus;
                $rpta["Descripcion"][$cont]=$dto->descripcion;
                $rpta["FchCreado"][$cont]=$dto->fch_creacion;
                $rpta["FchEditado"][$cont]=$dto->fch_edicion;
                $cont++;
            }
        }
        if($this->id!="" && $cont == 0){
            $this->error(3);
        }
        else{
            $this->error(0, $rpta);
        }
        return true;        
    }
    function nuevoTicket(){
        if($this->HayError){
            return false;
        }
        $this->camposTbl["asunto"]      = $this->asunto;
        $this->camposTbl["descripcion"] = $this->descripcion;
        $this->camposTbl["prioridad"]   = $this->prioridad;
        $this->camposTbl["usuario"]     = $this->usuario;        
        $this->db->insertTb($this->nombreTbl, $this->camposTbl);
        
        $this->error(0, ["Ticket Creado"]);
        return true;
    }
    
    function editarTicket(){
        if($this->HayError){
            return false;
        }
        $this->camposTbl["asunto"]      = $this->asunto;
        $this->camposTbl["descripcion"] = $this->descripcion;
        $this->camposTbl["prioridad"]   = $this->prioridad;
        $this->camposTbl["usuario"]     = $this->usuario;        
        $this->camposTbl["estatus"]     = $this->estatus;
        $this->db->updateTb($this->nombreTbl, $this->camposTbl, $this->id);
        
        $this->error(0, ["Ticket Actualziado"]);
        return true;
    }
    
    function eliminarTicket(){
        if($this->HayError){
            return false;
        }
        $this->db->deleteTb($this->nombreTbl, $this->id);
        
        $this->error(0, ["Ticket Eliminado"]);
        return true;
    }
    
    
    function error($Code, $Complemento=array()){
        $this->respuesta["CodError"]=$Code;
        switch($Code){
            case 0:
                $this->respuesta["MsjError"]='';
                break;            
            case 1:
                $this->respuesta["MsjError"]='Dato no aceptado';
                break;
            case 2:
                $this->respuesta["MsjError"]='id_ticket no recibido';
                break;
            case 3:
                $this->respuesta["MsjError"]='id_ticket no encontrado';
                break;
            case 4:
                $this->respuesta["MsjError"]='Servicio no recibido';
                break;
            case 5:
                $this->respuesta["MsjError"]='Servicio no identificado';
                break;
        }
        if($Code!=0){
            $this->HayError=true;
        }
        if(count($Complemento)>0){
            $this->respuesta["Data"]=$Complemento;
        }
    }    
    
    function respuesta(){
        header('Content-type: application/json');
        echo json_encode($this->respuesta);
    }

}