<?php


class Club
{
    private $title;
    private $description;
    private $image;
    private $id;

    public function __construct($title, $description, $image, $id = null)
    {
        $this->title = $title;
        $this->description = $description;
        $this->image = $image;
        $this->id = $id;
    }

    public function getTitle() : string {
        return $this->title;
    }

    public function setTitle(string $title) {
        $this->title = $title;
    }

    public function getDescription() : string {
        return $this->description;
    }

    public function setDescription(string $description) {
        $this->description = $description;
    }

    public function getImage() : string {
        return $this->image;
    }

    public function setImage(string $image) {
        $this->image = $image;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id) : void
    {
        $this->id = $id;
    }


}