<?php

class SearchCustomer {
    private $conn;
    private $table_name = "customers";

    public $id;
    public $name;
    public $address;
    public $telephone;
    public $email;

    public function __construct($db) {
        $this->conn = $db;
    }

    function search($keywords) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE name LIKE ? OR address LIKE ? OR telephone LIKE ? OR email LIKE ?";
        $stmt = $this->conn->prepare($query);

        $keywords = "%{$keywords}%";
        $stmt->bindParam(1, $keywords);
        $stmt->bindParam(2, $keywords);
        $stmt->bindParam(3, $keywords);
        $stmt->bindParam(4, $keywords);

        $stmt->execute();
        return $stmt;
    }
}

// database connection details
require_once('db_config.php');

// connect to the database
$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

// instantiate SearchCustomer class and search for customers based on keywords
$search = new SearchCustomer($conn);
$keywords = $_GET['keywords']; // assume the user enters the search keywords in a HTML form
$stmt = $search->search($keywords);

// display search results
if($stmt->rowCount() > 0){
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        echo "ID: " . $id . "<br>";
        echo "Name: " . $name . "<br>";
        echo "Address: " . $address . "<br>";
        echo "Telephone: " . $telephone . "<br>";
        echo "Email: " . $email . "<br>";
        echo "<hr>";
    }
} else{
    echo "No records found.";
}
