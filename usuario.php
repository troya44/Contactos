<?php

class usuario
{
    private $id;
    private $telefono;
    private $password;
    private $avatar;

    /**
     * @param $id
     * @param $password
     * @param $telefono
     * @param $avatar
     */
    public function __construct($id, $password, $telefono, $avatar)
    {
        $this->id = $id;
        $this->password = $password;
        $this->telefono = $telefono;
        $this->avatar = $avatar;
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
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return mixed
     */
    public function getAvatar()
    {
        return $this->avatar;
    }




}