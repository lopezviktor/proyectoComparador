<?php

class Usuario{

    private $nombreUsuario;
    private $nombre;
    private $apellidos;
    private $correo;
    private $telefono;
    private $contrasena;

    public function __construct($nombreUsuario, $nombre, $apellidos, $correo, $telefono, $contrasena) {
        $this->nombreUsuario = $nombreUsuario;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->correo = $correo;
        $this->telefono = $telefono;
        $this->contrasena = $contrasena;
    }

    public function getNombreUsuario()
    {
        return $this->nombreUsuario;
    }
    public function setNombreUsuario($nombreUsuario)
    {
        $this->nombreUsuario = $nombreUsuario;

        return $this;
    }

    public function getNombre()
    {
        return $this->nombre;
    }
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getApellidos()
    {
        return $this->apellidos;
    }
    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;

        return $this;
    }

    public function getCorreo()
    {
        return $this->correo;
    }
    public function setCorreo($correo)
    {
        $this->correo = $correo;

        return $this;
    }

    public function getTelefono()
    {
        return $this->telefono;
    }
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

    public function getContrasena()
    {
        return $this->contrasena;
    }
    
    public function setContrasena($contrasena)
    {
        $this->contrasena = $contrasena;

        return $this;
    }

    public function guardarUsuario(){
        require_once 'Conexion.php';
        $conexion = new Conexion();
        $conexion->conectarBD();
        $sql = "INSERT INTO usuarios (nombreUsuario, nombre, apellidos, correo, telefono, contrasena) VALUES ('" . 
        $this->nombreUsuario . "', '" . 
        $this->nombre . "', '" . 
        $this->apellidos . "', '" . 
        $this->correo . "', '" . 
        $this->telefono . "', '" . 
        $this->contrasena . "')";

        $result = $conexion->getConexion()->query($sql);

        return $result;
    }

}
?>