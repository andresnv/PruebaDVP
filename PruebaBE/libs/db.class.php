<?php

class DB{    
    
    private $servBD    = "localhost";
    private $nombreBD  = "prueba_dvp";
    private $usuarioBD = "root";
    private $passBD    = "";    
    private $mysqli;
    private $consultaId;
    
    function conexionBD(){        
        $this->mysqli = new mysqli($this->servBD, $this->usuarioBD, $this->passBD, $this->nombreBD);        
        if ($this->mysqli->connect_errno){
            $this->Error = "Falló la conexión: ". $this->mysqli->connect_error;
            echo $this->Error;
            return false;
        }
    }
    
    function consulta($sql){
        $this->conexionBD();
        $this->consultaId = $this->mysqli->query($sql);
        if (!$this->consultaId){            
            print_r($this->mysqli->error);
            return false;
        }
        return $this->consultaId;
    }    
    
    function componerConsulta($datos, $update = false)
    {
        $values=$campos="";
        foreach($datos as $nomCampo => $valCampo){
            if(!$update){
                $campos.=$nomCampo.",";
                $values.="'".$valCampo."',";                
            }
            else{
                $campos.=$nomCampo." = '".$valCampo."' ,";
            }
        }
        $Return[0]=substr($campos,0,-1);        
        if(!$update){
            $Return[1]=substr($values,0,-1);
        }
        return $Return;
    }

    function insertTb($tabla, $datos){        
        $dtsQuery = $this->componerConsulta($datos);
        $query = "INSERT INTO ".$tabla."(".$dtsQuery[0].") VALUES(".$dtsQuery[1].") ";        
        $this->consulta($query);        
    }
    
    function updateTb($tabla, $datos, $id){        
        $dtsQuery = $this->componerConsulta($datos, true);
        $query = "UPDATE ".$tabla." SET ".$dtsQuery[0]." WHERE id = ".$id." ";
        $this->consulta($query);
    }
    
    function deleteTb($tabla, $id){
        $query = "DELETE FROM ".$tabla." WHERE id = ".$id." ";
        $this->consulta($query);
    }
    
    function bdFetchAssoc(){
        $array = array();        
        while ($row = $this->consultaId->fetch_object()){
            $array[] = $row;
        }
        return $array;        
    }
    
    function numRegistros(){
        return $this->consultaId->num_rows;
    }
}