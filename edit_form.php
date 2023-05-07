<?php
try {
    require_once('db_config.php');
    $id = $_GET['id'];
    $db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $stmt = $db->prepare("SELECT * FROM customers WHERE id = :id");
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    $customer = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Failed to connect to database: " . $e->getMessage();
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Customer</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-4">
    <div class="row">
		<div class="col-8">
            <h1>Edit Customer</h1>
		</div>
		<div class="col-4 text-right">
			<a href="/" class="btn btn-info mt-2">Customer List</a>
		</div>
	</div>
    <div id="success-message" class="alert d-none" role="alert"></div>
    <form id="edit-form" action="edit.php" method="post">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" required value="<?php echo $customer['name']; ?>">
        </div>
        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" class="form-control" id="address" name="address" value="<?php echo $customer['address']; ?>" required>
        </div>
        <div class="form-group">
            <label for="telephone">Telephone</label>
            <input type="tel" class="form-control" id="telephone" name="telephone" value="<?php echo $customer['telephone']; ?>">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" required value="<?php echo $customer['email']; ?>">
        </div>
        <input type="hidden" name="id" value="<?php echo $customer['id']; ?>">
        <button type="submit" class="btn btn-primary">Save Changes</button>
    </form>
</div>


<!-- Include jQuery and Bootstrap JS -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="jQuery/validation.js"></script>
<script src="jQuery/form.js"></script>

</body>
</html>