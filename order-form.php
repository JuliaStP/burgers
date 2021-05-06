<?php

include 'src/config.php';
include 'src/class.db.php';
include 'src/burger.php';
include 'src/dbConnection.php';


ini_set('display_errors', 'on');
ini_set('error_reporting', E_NOTICE | E_ALL);

$burger = new Burger();

$email = $_POST['email'];
$name = $_POST['name'];
$phone = $_POST['phone'];
$street = $_POST['street'];
$house = $_POST['home'];
$corp = $_POST['part'];
$apt = $_POST['appt'];
$floor = $_POST['floor'];

$user = $burger->getUserByEmail($email);

if ($user) {
    $userId = $user['id'];
    $burger->addOrder($user['id']);
    $orderNumber = $user['orders_count'] + 1;
} else {
    $orderNumber = 1;
    $userId = $burger->createUser($email, $name, $phone);
}

$orderId = $burger->createOrder($userId, $street, $house, $corp, $apt, $floor);

echo "Thank you for your order! It will be delievered to: $street street, $house house, $corp corpus, $apt apartment on $floor floor<br>
Your order number: #$orderId <br>
This is your $orderNumber order! <br>
We will call you to confirm your order to this number: $phone";
