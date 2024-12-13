<?php

class contacto
{
    private $id;
    private $nombre;
    private $apellidos;
    private $telefono;
    private $foto;

    /**
     * @param $id
     * @param $nombre
     * @param $apellidos
     * @param $telefono
     * @param $foto
     */
    public function __construct($id, $nombre, $apellidos, $telefono, $foto)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->telefono = $telefono;
        $this->foto = $foto;
    }

    /**
     * @return mixed
     */
    public function getApellidos()
    {
        return $this->apellidos;
    }

    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getFoto()
    {
        return $this->foto;
    }

    /**
     * @return mixed
     */
    public function getTelefono()
    {
        return $this->telefono;
    }



}