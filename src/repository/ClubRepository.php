<?php

require_once "Repository.php";
require_once __DIR__.'/../models/Club.php';

class ClubRepository extends Repository
{
    public function getClub(int $id) : ?Club {
        $statement = $this->database->connect()->prepare('
            SELECT * FROM public.clubs WHERE id = :id
        ');
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();

        $club = $statement->fetch(PDO::FETCH_ASSOC);

        if($club == false) {
            return null;
        }

        return new Club(
            $club['title'],
            $club['description'],
            $club['image']
        );
    }

    public function addClub(Club $club) : void {
        $date = new DateTime(); // TODO add creation time to table
        $statement = $this->database->connect()->prepare('
            INSERT INTO clubs(name, description, image)
            VALUES(?, ?, ?)
       ');

        //$assignedById = 1;
        $statement->execute([
            $club->getTitle(),
            $club->getDescription(),
            //$date->format('Y-m-d'),
            //$assignedById,
            $club->getImage()
        ]);
    }
}