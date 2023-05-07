<?php
require_once('db_config.php');
$id = $_GET['id'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Note</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <div class="row">
        <div class="col-8">
            <h1>Add Note</h1>
        </div>
        <div class="col-4 text-right">
            <a href="/" class="btn btn-info mt-2">Customer List</a>
        </div>
    </div>
    <div id="success-message" class="alert d-none" role="alert"></div>
    <form id="add-note-form">
        <div class="form-group">
            <label for="note">Note:</label>
            <textarea class="form-control" id="note" name="note" required></textarea>
            <input type="hidden" name="id" value="<?php echo $id; ?>">
        </div>
        <button type="submit" class="btn btn-primary">Add Note</button>
    </form>
</div>

<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="jQuery/note.js"></script>