<?php

require_once "Repository.php";
require_once __DIR__ . '/../models/Club.php';

class ClubRepository extends Repository {

    public function getClub(int $id): ?Club {
        $statement = $this->database->connect()->prepare('
            SELECT * FROM public.clubs WHERE id_clubs = :id
        ');
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();

        $club = $statement->fetch(PDO::FETCH_ASSOC);

        if ($club == false) {
            return null; // TODO exception
        }

        return new Club(
            $club['name'],
            $club['description'],
            $club['image'],
            $club['id_clubs']
        );
    }

    public function getClubs(): array {
        $result = [];

        $statement = $this->database->connect()->prepare('
            SELECT * FROM clubs
        ');
        $statement->execute();
        $clubs = $statement->fetchAll(PDO::FETCH_ASSOC);

        foreach ($clubs as $club) {
            $result[] = new Club(
                $club['name'],
                $club['description'],
                $club['image'],
                $club['id_clubs']
            );
        }

        return $result;
    }

    public function addClub(Club $club): void {
        $date = new DateTime(); // TODO add creation time to table
        $statement = $this->database->connect()->prepare('
            INSERT INTO clubs(name, description, image)
            VALUES(?, ?, ?)
       ');

        $statement->execute([
            $club->getTitle(),
            $club->getDescription(),
            $club->getImage()
        ]);
    }

    public function getClubByTitle(string $searchString) {
        $searchString = '%' . strtolower($searchString) . '%';

        $statememt = $this->database->connect()->prepare('
            SELECT * FROM clubs WHERE LOWER(name) LIKE :search OR LOWER(description) LIKE :search
        ');
        $statememt->bindParam(':search', $searchString, PDO::PARAM_STR);
        $statememt->execute();

        return $statememt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getClubMembers($club) {
        $statement = $this->database->connect()->prepare('
            SELECT * FROM club_members
            WHERE club_members.id_club = ?
        ');

        $statement->execute([
            $club
        ]);

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addMemberToClub($club, $userId) {
        $statement = $this->database->connect()->prepare('
            INSERT INTO users_clubs(id_user, id_club)
            VALUES(?, ?)
            ON CONFLICT ON CONSTRAINT users_clubs_pk DO NOTHING
        ');

        $statement->execute([
            $userId,
            $club
        ]);

        return $this->getClubMembers($club);
    }
}