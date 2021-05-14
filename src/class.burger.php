<?php
include_once 'config.php';
include_once 'class.db.php';

class Burger
{
    private $pdo;

    public function run() {

        $host = DB_HOST;
        $dbName = DB_NAME;
        $dbUser = DB_USERNAME;
        $dbPassword = DB_PASSWORD;

        $this->pdo = new PDO("mysql:host=$host;dbname=$dbName", $dbUser, $dbPassword);
    }


    public function getUserByEmail(string $email)
    {
        $query = "SELECT * FROM `users` WHERE email = :email";
        $result = $this->pdo->prepare($query);
        $result->execute([
            'email' => $email
        ]);

        $result->fetch(PDO::FETCH_ASSOC);
    }

    public function createUser(string $email, string $name, string $phone)
    {
        $query = "INSERT INTO `users` (email, `name`, phone) VALUES (:email, :name, :phone)";
        $result = $this->pdo->prepare($query);
        $result->execute([
            ':email' => $email,
            ':name' => $name,
            ':phone' => $phone
        ]);

        return $this->pdo->lastInsertId();
    }

    public function createOrder(int $userId, string $street, int $house, int $corp, int $apt, int $floor)
    {
        $query = "INSERT INTO `order-form` (user_id, street, house, corp, apt, floor, created_at) VALUES (:user_id, :street, :house, :corp, :apt, :floor, :created_at)";
        $result = $this->pdo->prepare($query);
        $result->execute([
                ':user_id' => $userId,
                ':street' => $street,
                ':house' => $house,
                ':corp' => $corp,
                ':apt' => $apt,
                ':floor' => $floor,
                ':created_at' => date('Y-m-d H:i:s'),
        ]);
        return $this->pdo->lastInsertId();
    }

    public function addOrder(int $userId)
    {
        $query = "UPDATE `users` SET orders_count = orders_count +1 WHERE id = $userId";
        $result = $this->pdo->prepare($query);
        $result->execute([
            $query
        ]);
    }
}