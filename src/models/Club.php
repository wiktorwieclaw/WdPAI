<?php


class Club
{
    private string $title;
    private string $description;
    private string $image;
    private ?int $id;

    public function __construct(string $title, string $description, string $image, int $id = null)
    {
        $this->title = $title;
        $this->description = $description;
        $this->image = $image;
        $this->id = $id;
    }

    public function getTitle() : string {
        return $this->title;
    }

    public function setTitle(string $title): void {
        $this->title = $title;
    }

    public function getDescription() : string {
        return $this->description;
    }

    public function setDescription(string $description): void {
        $this->description = $description;
    }

    public function getImage() : string {
        return $this->image;
    }

    public function setImage(string $image): void {
        $this->image = $image;
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function setId($id): void {
        $this->id = $id;
    }


}