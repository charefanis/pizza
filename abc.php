<?php
$password = 'wxcvbn1290'; // change this to your desired password
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
echo $hashedPassword;
?>
