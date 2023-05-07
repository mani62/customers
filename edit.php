<?php

class UpdateCustomer {
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

    function update() {
        $query = "UPDATE " . $this->table_name . " SET name=:name, address=:address, telephone=:telephone, email=:email WHERE id=:id";
        $stmt = $this->conn->prepare($query);

        $this->id=htmlspecialchars(strip_tags($this->id));
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->address=htmlspecialchars(strip_tags($this->address));
        $this->telephone=htmlspecialchars(strip_tags($this->telephone));
        $this->email=htmlspecialchars(strip_tags($this->email));

        $stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":address", $this->address);
        $stmt->bindParam(":telephone", $this->telephone);
        $stmt->bindParam(":email", $this->email);

        if($stmt->execute()){
            $data = array(
                'name' => $this->name,
                'address' => $this->address,
                'telephone' => $this->telephone,
                'email' => $this->email
            );
            return $data;
        }

        return false;
    }
}

// database connection details
require_once('db_config.php');

// connect to the database
$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

// instantiate UpdateCustomer class and set values for customer details
$update = new UpdateCustomer($conn);
$update->id = $_POST['id'];
$update->name = $_POST['name'];
$update->address = $_POST['address'];
$update->telephone = $_POST['telephone'];
$update->email = $_POST['email'];

// modify existing customer record in the database
if($update->update()){
    $data = $update->update();
    $message = array(
        'status' => 'success',
        'code' => 200,
        'message' => 'Customer record updated successfully!',
        'name' => $data['name'],
        'address' => $data['address'],
        'telephone' => $data['telephone'],
        'email' => $data['email']
    );

    echo json_encode($message);
} else{
    $message = array(
        'status' => 'success',
        'code' => 500,
        'message' => 'Unable to update customer record.'
    );

    echo json_encode($message);
}




