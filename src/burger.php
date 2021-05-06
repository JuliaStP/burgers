<?php

include 'dbConnection.php';

class Burger
{
    public function getUserByEmail(string $email)
    {
        $query = "SELECT * FROM `users` WHERE email = :email";
        $res = getConnection()->query($query);
        return $res->fetchOne($query, __METHOD__, [':email' => $email]);
    }

    public function createUser(string $email, string $name, string $phone)
    {
//        $db = Db::getInstance();
        $query = "INSERT INTO `users` (email, `name`, phone) VALUES (:email, :name, :phone)";
        $result = getConnection()->exec($query, __METHOD__, [
            ':email' => $email,
            ':name' => $name,
            ':phone' => $phone
        ]);
        if (!$result) {
            return false;
        }

        return $result;
    }

    public function createOrder(int $userId, string $street, int $house, int $corp, int $apt, int $floor)
    {
//        $db = Db::getInstance();
        $query = "INSERT INTO `order-form` (user_id, street, house, corp, apt, floor, created_at) VALUES (:user_id, :street, :house, :corp, :apt, :floor, :created_at)";
        $result = getConnection()->exec(
            $query,
            __METHOD__,
            [
                ':user_id' => $userId,
                ':street' => $street,
                ':house' => $house,
                ':corp' => $corp,
                ':apt' => $apt,
                ':floor' => $floor,
                ':created_at' => date('Y-m-d H:i:s'),

            ]
        );
        if (!$result) {
            return false;
        }
        return $result;
    }

    public function addOrder(int $userId)
    {
//        $db = Db::getInstance();
        $query = "UPDATE `users` SET orders_count = orders_count +1 WHERE id = $userId";
        return getConnection()->exec($query, __METHOD__);
    }
}