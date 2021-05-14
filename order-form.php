<?php

include_once 'src/config.php';
include_once 'src/class.db.php';
include_once 'src/class.burger.php';

ini_set('display_errors', 'on');
ini_set('error_reporting', E_NOTICE | E_ALL);

$burgers = new Burger();
$burgers->run();

$email = (string) $_POST['email'];
$name = (string) $_POST['name'];
$phone = (string) $_POST['phone'];
$street = (string) $_POST['street'];
$house = (int) $_POST['home'];
$corp = (int) $_POST['part'];
$apt = (int) $_POST['appt'];
$floor = (int) $_POST['floor'];

$user = $burgers->getUserByEmail($email);

if ($user) {
    $userId = $user['id'];
    $burgers->addOrder($user['id']);
    $orderNumber = $user['orders_count'] + 1;
} else {
    $orderNumber = 1;
    $userId = $burgers->createUser($email, $name, $phone);
}

$orderId = $burgers->createOrder($userId, $street, $house, $corp, $apt, $floor);

echo "Thank you for your order! It will be delievered to: $street street, $house house, $corp corpus, $apt apartment on $floor floor<br>
Your order number: #$orderId <br>
This is your $orderNumber order! <br>
We will call you to confirm your order to this number: $phone";
