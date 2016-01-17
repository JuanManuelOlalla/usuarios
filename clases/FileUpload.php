<?php

class FileUpload {

    private $input;
    private $files;
    private $destino;
    private $nombre;
    private $maximo;
    private $tipo;
    private $error_php;
    private $arrayDeTipos = array(
        "jpg" => 1
    );

    function __construct($param) {
        $this->input = $param;
        $this->nombre = "";
        $this->tipo = array();
        $this->error_php = UPLOAD_ERR_OK;
        $this->files = $_FILES[$param];
    }

    public function getErrorPHP() {
        return $this->errorPHP;
    }

    function setDestino($destino) {
        $this->destino = $destino;
    }

    public function getDestino() {
        return $this->destino;
    }

    public function setNombre($param) {
        $this->nombre = $param;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function setMaximo($maximo) {
        $this->maximo = $maximo;
    }

    public function isTipo($tipo) {
        return isset($this->arrayDeTipos[$tipo]);
    }

    public function removeTipo($tipo) {
        if ($this->isTipo($tipo)) {
            unset($this->arrayDeTipos[$tipo]);
            return true;
        }
        return false;
    }

    public function getMensajeError() {
        return $this->error_php;
    }

    private function isInput() {
        if (!isset($_FILES[$this->input])) {
            $this->error_php = "NO existe el campo";
            return false;
        }
        return true;
    }

    private function isError() {
        if ($this->files["error"] != UPLOAD_ERR_OK) {
            return true;
        }
        return false;
    }

    private function isTamano() {
        if ($this->files["size"] > $this->maximo) {
            $this->error_php = "demasiado grande";
            return false;
        }
        return true;
    }

    public function subida() {
                
        if ($_FILES[$this->input]["error"] == UPLOAD_ERR_OK) {

            $this->files = $_FILES[$this->input];
            $this->errorPHP = $this->files["error"];

            $partes = pathinfo($this->files["name"]);
            $extension = $partes['extension'];
            $nombre = $partes['filename'];

            if(!$this->isTipo($extension)){
                return "Tiene que ser jpg";
            }

            move_uploaded_file($_FILES[$this->input]["tmp_name"], $this->destino ."." . $extension);

        }
    }

}
