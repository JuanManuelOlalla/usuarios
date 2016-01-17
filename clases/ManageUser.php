<?php

class ManageUser {
    
    private $bd = null;
    private $tabla = "user";
    
    function __construct(DataBase $bd) {
        $this->bd = $bd;
    }

    function get($email){
        $parametros = array();
        $parametros["email"] = $email;
        $this->bd->select($this->tabla, "*", "email = :email", $parametros);
        $fila = $this->bd->getRow();
        $user = new User();
        $user->set($fila);
        return $user;
    }
    
    function delete($email){
        //devolver filas borradas
        $parametros = array();
        $parametros["email"] = $email;
        return $this->bd->delete($this->tabla, $parametros);
    }
    
    function erase(User $user){
        return $this->delete($user->getEmail());
    }
    
    function set(User $user, $pkEmail){
        $parametros = $user->getArray();
        $parametros['clave'] = sha1($parametros['clave']);
        $parametrosWhere = array();
        $parametrosWhere["email"]=$pkEmail;
        return $this->bd->update2($this->tabla, $parametros, $parametrosWhere);
    }
    
    function setSin(User $user, $pkEmail){
        $parametros["email"] = $user->getEmail();
        $parametros["alias"] = $user->getAlias();
        $parametros["activo"] = $user->getActivo();
        $parametros["administrador"] = $user->getAdministrador();
        $parametros["personal"] = $user->getPersonal();
        $parametrosWhere = array();
        $parametrosWhere["email"]=$pkEmail;
        return $this->bd->update2($this->tabla, $parametros, $parametrosWhere);
    }
    
    function activar($email){
        $parametros = array();
        $parametros["activo"]=1;
        $parametrosWhere = array();
        $parametrosWhere["email"]=$email;
        $parametrosWhere["activo"]=0;
        return $this->bd->update2($this->tabla, $parametros, $parametrosWhere);
    }
    
    function desactivar($email) {
        $parametros = array();
        $parametros["activo"] = 0;
        $parametrosWhere = array();
        $parametrosWhere["email"]=$email;
        return $this->bd->update2($this->tabla, $parametros, $parametrosWhere);
    }
    
    function insert(User $user){
        $parametros = $user->getArray();
        $parametros['clave'] = sha1($parametros['clave']);
        return $this->bd->insert($this->tabla, $parametros, false);
    }
    
    function login($email, $clave) {
        $sql = "select clave from user where email=:email and activo=1;";
        $parametros["email"] = $email;
        $this->bd->send($sql, $parametros);
        $claveEncontrada = $this->bd->getRow()[0];
        if ($claveEncontrada == sha1($clave)) {
            return $this->get($email);
        }
        return false;
    }
    
    function getAvatar(User $user){
        $ruta= "avatar/".$user->getEmail().".jpg";
        if(file_exists($ruta)){
            return "<img src='$ruta' class='avatar'>";
        }
        return "<img src='avatar/default-avatar.jpg' class='default'>";
    }
    
    function getList() {
        $this->bd->select($this->tabla, "*", "1=1", array(), "email, alias");
        $r = array();
        while($fila = $this->bd->getRow()){
            $user = new User();
            $user->set($fila);
            $r[] = $user;
        }
        return $r;
    }
    
}
