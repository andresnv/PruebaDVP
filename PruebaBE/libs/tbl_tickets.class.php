<?php
class TblTickets{
    private $nombreTbl = "tickets";
    private $camposTbl = array("asunto" =>"", "descripcion" =>"", "prioridad" =>"", "usuario" =>"", "estatus" => "Abierto");
    private $db;
            
    function __construct() {
        $this->db = new DB;
    }
    
    function insertar($asunto, $descripcion, $prioridad, $usuario){
        $this->camposTbl["asunto"]      = $asunto;
        $this->camposTbl["descripcion"] = $descripcion;
        $this->camposTbl["prioridad"]   = $prioridad;
        $this->camposTbl["usuario"]     = $usuario;        
        $this->db->insertTb($this->nombreTbl, $this->camposTbl);
    }
    
    function actualizar($asunto, $descripcion, $prioridad, $usuario, $estatus, $id){
        $this->camposTbl["asunto"]      = $asunto;
        $this->camposTbl["descripcion"] = $descripcion;
        $this->camposTbl["prioridad"]   = $prioridad;
        $this->camposTbl["usuario"]     = $usuario;        
        $this->camposTbl["estatus"]     = $estatus;
        $this->db->updateTb($this->nombreTbl, $this->camposTbl, $id);
    }
    
    function eliminar($id){
        $this->db->deleteTb($this->nombreTbl, $id);
    }
    
    function consultar($limit, $pagina, $id = ""){
        $query = "SELECT * FROM ".$this->nombreTbl." ";
        if($id!=''){
            $query.= "WHERE id ='".$id."' ";
        }
        $query.="ORDER BY id DESC ";
        $offset = ($pagina-1) * $limit;
        $query.="LIMIT ".$limit." OFFSET ".$offset;
        
        $this->db->consulta($query);        
        $dts = $this->db->bdFetchAssoc();
        
        return $dts;
        
        /*foreach ($dts as $dto){
            echo $dto->asunto."<br>";
        }*/
    }
}