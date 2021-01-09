<?php


class Club
{
    private $title;
    private $description;
    private $image;

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


}