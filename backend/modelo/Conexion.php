<?php

class Conexion {
    private $conexion;
    private $dbhost;
    private $dbuser;
    private $dbpasswd;
    private $dbname;

    public function __construct($dbhost = 'localhost', $dbuser = 'root', $dbpasswd = '', $dbname = 'comparador') {
        $this->dbhost = $dbhost;
        $this->dbuser = $dbuser;
        $this->dbpasswd = $dbpasswd;
        $this->dbname = $dbname;
    }

    public function conectarBD() {
        $this->conexion = mysqli_connect($this->dbhost, $this->dbuser, $this->dbpasswd, $this->dbname);
        if (!$this->conexion) {
            die("Error de conexión: " . mysqli_connect_error());
        } else {
            //echo "Conectado";
        }
    }

    public function getConexion() {
        return $this->conexion;
    }

    public function cerrarConexion() {
        mysqli_close($this->conexion);
    }
}

?>
