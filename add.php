<?php

class AddCustomer {
    private $conn;
    private $table_name = "customers";

    public $name;
    public $address;
    public $telephone;
    public $email;

    public function __construct($db) {
        $this->conn = $db;
    }

    function create() {
        $query = "INSERT INTO " . $this->table_name . " SET name=:name, address=:address, telephone=:telephone, email=:email, date=:date";
        $stmt = $this->conn->prepare($query);

        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->address=htmlspecialchars(strip_tags($this->address));
        $this->telephone=htmlspecialchars(strip_tags($this->telephone));
        $this->email=htmlspecialchars(strip_tags($this->email));
        $this->date=time();

        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":address", $this->address);
        $stmt->bindParam(":telephone", $this->telephone);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":date", $this->date);

        if($stmt->execute()){
            return true;
        }

        return false;
    }
}

// database connection details
require_once('db_config.php');

// connect to the database
$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

// instantiate Customer class and set values for customer details
$customer = new AddCustomer($conn);
$customer->name = $_POST['name'];
$customer->address = $_POST['address'];
$customer->telephone = $_POST['telephone'];
$customer->email = $_POST['email'];

// add new customer record to the database
if($customer->create()){
    $message = array(
        'status' => 'success',
        'code' => 200,
        'message' => 'New customer record added successfully!'
    );

    echo json_encode($message);
} else{
    $message = array(
        'status' => 'success',
        'code' => 500,
        'message' => 'Unable to add customer record.'
    );

    echo json_encode($message);
}
