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
// Display users information
foreach ($users as $user) {
  echo '<p>id: ' . $user['id'] . ', name: ' . $user['name'] . '</p>';
}

// Send mail
$subject = 'Test Mail';
$message = 'Here is Docker Hub => https://hub.docker.com/';
foreach ($users as $user) {
  $success = mb_send_mail($user['email'], $subject, $message);
  if ($success) {
    echo '<p>Mail sent to' . $user['name'] . '</p>';
  } else {
    echo '<p>Mail sending failed</p>';
  }
}