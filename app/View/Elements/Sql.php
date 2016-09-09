<?php
/**
* 
*/
class Menu 
{
    private $_con;
    function __construct()
    {
       $this->_con = new Conexion();
    }

    public function getModulosPadres($rol_id=null)
    {
        try {
            $modulo = $this->_con->prepare("SELECT 
                  permisos.id, 
                  permisos.rol_id, 
                  permisos.modulo_id, 
                  permisos.estado, 
                  modulos.modulos, 
                  rols.descripcion as perfil, 
                  modulos.url, 
                  modulos.id_padre
                FROM general.permisos
                INNER JOIN general.modulos ON modulos.id = permisos.modulo_id
                INNER JOIN general.rols ON rols.id = permisos.rol_id
                WHERE permisos.rol_id = '01' AND modulos.id_padre = '0' AND permisos.estado ='A'");
            $modulo->execute();
            $this->_con->close_con();
            return $modulo->fetchAll();
            
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
          
    }

    public function getModulosHijos($rol_id=null, $modulo_id)
    {
        try {
            $hijos = $this->_con->prepare("SELECT 
                  permisos.id, 
                  permisos.rol_id, 
                  permisos.modulo_id, 
                  permisos.estado, 
                  modulos.modulos, 
                  rols.descripcion as perfil, 
                  modulos.url, 
                  modulos.id_padre
                FROM general.permisos
                INNER JOIN general.modulos ON modulos.id = permisos.modulo_id
                INNER JOIN general.rols ON rols.id = permisos.rol_id
                WHERE permisos.rol_id = '01' AND modulos.id_padre = '{$modulo_id}' AND permisos.estado ='A' ");
            $hijos->execute();
            $this->_con->close_con();
            return $hijos->fetchAll();
            
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
          
    }
}