<?php

$user = [];

try {
  // Connect to DB
  $dsn = 'mysql:host=db;port=3306;dbname=sample';
  $username = 'root';
  $password = 'secret';
  $pdo = new PDO($dsn, $username, $password);

  // Get users table
  $statement = $pdo->query('select * from users');
  $statement->execute();
  while ($row = $statement->fetch()) {
    $user[] = $row;
  }

  // Disconnect
  $pdo = null;
} catch (PDOException $e) {
  echo 'Database connection failed'
}
