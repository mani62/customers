<?php
require_once('db_config.php');
$customer_id = $_POST['id'];

try {
    $db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $delete = $db->prepare('DELETE FROM customers WHERE id = :id');
    $delete->bindParam(':id', $customer_id);
    $delete->execute();
    $db = null;
} catch (PDOException $e) {
    // Handle errors
    echo 'Failed to delete customer: ' . $e->getMessage();
}