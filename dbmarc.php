<?php
$host = 'srv2.astenmail.com';
$user = 'ufficio_fotocop';
$password = 'fotocop';
$db = 'ufficio_fotocop';


$conn = mysqli_connect($host, $user, $password, $db);
if (!$conn) die('Cannot connect: ' . mysqli_error());


?>