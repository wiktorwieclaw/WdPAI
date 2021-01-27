<?php

require_once "Repository.php";
require_once __DIR__.'/../models/User.php';

class UserRepository extends Repository
{
    public function getUserByEmail(string $email) : ?User {
        $statement = $this->database->connect()->prepare('
            SELECT * FROM users u LEFT JOIN users_details ud 
            ON u.id_user_details = ud.id WHERE email = :email
        ');
        $statement->bindParam(':email', $email, PDO::PARAM_STR);
        $statement->execute();

        $user = $statement->fetch(PDO::FETCH_ASSOC);

        if($user == false) {
            return null; // TODO Exception
        }

        return new User(
            $user['email'], $user['password'], $user['name'], $user['surname'], $user['id_users']
        );
    }

    public function getUserDetailsById(int $id) : ?User {
        $statement = $this->database->connect()->prepare('
            SELECT * FROM users u JOIN users_details ON u.id_user_details = users_details.id WHERE u.id_users = :id
        ');
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();

        $user = $statement->fetch(PDO::FETCH_ASSOC);

        if($user == false) {
            return null; // TODO Exception
        }

        return new User(
            $user['email'], $user['password'], $user['name'], $user['surname'], $user['id_users']
        );
    }

    public function getUserDetailsId(User $user): int {
        $statement = $this->database->connect()->prepare('
            SELECT * FROM public.users_details WHERE name = :name AND surname = :surname
        ');

        $statement->bindParam(':name', $user->getName(), PDO::PARAM_STR);
        $statement->bindParam(':surname', $user->getSurname(), PDO::PARAM_STR);
        $statement->execute();

        $data = $statement->fetch(PDO::FETCH_ASSOC);
        return $data['id'];
    }

    public function addUser(User $user) {
        $statement  = $this->database->connect()->prepare('
            INSERT INTO users_details(name, surname)
            VALUES (?, ?)
        ');

        $statement->execute([
            $user->getName(),
            $user->getSurname()
        ]);

        $stmt = $this->database->connect()->prepare('
            INSERT INTO users (email, password, id_user_details)
            VALUES (?, ?, ?)
        ');

        $stmt->execute([
            $user->getEmail(),
            $user->getPassword(),
            $this->getUserDetailsId($user)
        ]);
    }
}