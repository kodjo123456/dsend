<?php

require_once ('../config/database.php');

$email = isset($_POST['email']) ? $_POST['email'] : "";
$password = isset($_POST['password']) ? $_POST['password'] : "";
$confirm_password = isset($_POST['confirm_password']) ? $_POST['confirm_password'] : "";
$hashed_password = md5($password);
$source = isset($_POST['source']) ? $_POST['source'] : "";

$color = ["blue", "cyan", "red", "green", "dark", "pink", "purple", "orange"];

switch ($source) {
    case 'login':

        $userStatement = $conn->prepare('SELECT * FROM users WHERE email = :email AND password = :password');
        $userStatement->execute([
            'email' => $email,
            'password' => $hashed_password
        ]);
        $users = $userStatement->fetchAll();

        if (count($users) == 0) {
            header('Location:../?auth=error');
        } else {
            foreach ($users as $user) {
                setcookie(
                    'id',
                    $user['id'],
                    time() + (86400 * 30),
                    "/"
                );
            }

            header('Location: ../pages/discussions.php');
            exit();
        }
        break;

    case 'register':
        $userStatement = $conn->prepare('SELECT * FROM users WHERE email = :email');
        $userStatement->execute([
            'email' => $email
        ]);
        $users = $userStatement->fetchAll();

        if (count($users) != 0) {
            header('Location: ../pages/register.php?email=error');
            exit();
        } else if ($password != $confirm_password) {
            header('Location: ../pages/register.php?password=error');
            exit();
        } else {

            $userCreateStatement = $conn->prepare('INSERT INTO users(email, color, password) VALUES (:email, :color, :password)');
            $userCreateStatement->execute([
                'email' => $email,
                'color' => $color[rand(0, 7)],
                'password' => $hashed_password
            ]);

            $userStatement = $conn->prepare('SELECT * FROM users WHERE email = :email AND password = :password');
            $userStatement->execute([
                'email' => $email,
                'password' => $hashed_password
            ]);
            $users = $userStatement->fetchAll();

            foreach ($users as $user) {
                setcookie(
                    'id',
                    $user['id'],
                    time() + (86400 * 30),
                    "/"
                );
            }

            header('Location: ../pages/discussions.php');
            
        }
        break;

    default:
        # code...
        break;
}