<?php

class mensaje
{
    private $id;
    private $texto;
    private $fecha_Envio;

    /**
     * @param $id
     * @param $texto
     * @param $fecha_Envio
     */
    public function __construct($id, $texto, $fecha_Envio)
    {
        $this->id = $id;
        $this->texto = $texto;
        $this->fecha_Envio = $fecha_Envio;
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
    public function getFechaEnvio()
    {
        return $this->fecha_Envio;
    }

    /**
     * @return mixed
     */
    public function getTexto()
    {
        return $this->texto;
    }




}