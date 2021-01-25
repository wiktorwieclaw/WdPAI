<?php


class UserProfile {
    private $id;
    private $name;
    private $surname;
    private $clubs = [];

    public function __construct($id, $name, $surname) {
        $this->id = $id;
        $this->name = $name;
        $this->surname = $surname;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name): void
    {
        $this->name = $name;
    }

    public function addClub($club) {
        array_push($this->clubs, $club);
    }

    public function getClubs() {
        return $this->clubs;
    }



}