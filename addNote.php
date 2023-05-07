<?php

class AddNote {
    private $conn;
    private $table_name = "customers_note";

    public $user_id;
    public $note;

    public function __construct($db) {
        $this->conn = $db;
    }

    function create() {
        $query = "INSERT INTO " . $this->table_name . " SET user_id=:user_id, note=:note, date=:date";
        $stmt = $this->conn->prepare($query);

        $this->user_id=htmlspecialchars(strip_tags($this->user_id));
        $this->note=htmlspecialchars(strip_tags($this->note));
        $this->date=time();

        $stmt->bindParam(":user_id", $this->user_id);
        $stmt->bindParam(":note", $this->note);
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
$addNote = new AddNote($conn);
$addNote->user_id = $_POST['id'];
$addNote->note = $_POST['note'];

// add new customer record to the database
if($addNote->create()){
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