<?php

class Pais{
    private $nombre;
    private $bandera;
    private $poblacion;
    private $superficie;
    private $pib;
    private $esperanzaVida;
    private $tasaNatalidad;
    private $tasaMortalidad;

    public function __construct($nombre="", $poblacion="", $superficie="", $pib="", $esperanzaVida="", $tasaNatalidad="", $tasaMortalidad=""){
        $this->nombre = $nombre;
        $this->pobacion = $poblacion;
        $this->superficie = $superficie;
        $this->pib = $pib;
        $this->esperanzaVida = $esperanzaVida;
        $this->tasaNatalidad = $tasaNatalidad;
        $this->tasaMortalidad = $tasaMortalidad;
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

    public function getBandera() 
    {
        return $this->bandera;
    }
    public function setBandera($bandera) 
    {
        $this->bandera = $bandera;
    }


    public function getPoblacion()
    {
        return $this->poblacion;
    }
    public function setPoblacion($poblacion)
    {
        $this->poblacion = $poblacion;

        return $this;
    }

    public function getSuperficie()
    {
        return $this->superficie;
    }
    public function setSuperficie($superficie)
    {
        $this->superficie = $superficie;

        return $this;
    }

    public function getPib()
    {
        return $this->pib;
    } 
    public function setPib($pib)
    {
        $this->pib = $pib;

        return $this;
    }

    public function getEsperanzaVida()
    {
        return $this->esperanzaVida;
    }
    public function setEsperanzaVida($esperanzaVida)
    {
        $this->esperanzaVida = $esperanzaVida;

        return $this;
    }

    public function getTasaNatalidad()
    {
        return $this->tasaNatalidad;
    }
    public function setTasaNatalidad($tasaNatalidad)
    {
        $this->tasaNatalidad = $tasaNatalidad;

        return $this;
    }

    public function getTasaMortalidad()
    {
        return $this->tasaMortalidad;
    } 
    public function setTasaMortalidad($tasaMortalidad)
    {
        $this->tasaMortalidad = $tasaMortalidad;

        return $this;
    }

    public function insertQuery() {
        return "INSERT INTO paises (nombre, bandera, poblacion, superficie, pib, esperanzaVida, tasaNatalidad, tasaMortalidad) 
                VALUES ('$this->nombre', '$this->bandera', $this->poblacion, $this->superficie, $this->pib, $this->esperanzaVida, 
                $this->tasaNatalidad, $this->tasaMortalidad)";
    }

}
?>