<?php
require_once('db_config.php');
try {
    $perPage = 3;
    $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
    $search_query = isset($_GET['search']) ? $_GET['search'] : '';
    $offset = ($page - 1) * $perPage;
    $db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $totalCustomers = $db->query('SELECT COUNT(*) FROM customers')->fetchColumn();
    $tableRows = '';

    if ($search_query != '') {
        $sql = "SELECT * FROM customers";
        $params = [];
        if (!empty($search_query)) {
            $stmt = $db->prepare('SELECT * FROM customers WHERE name LIKE :search LIMIT :perPage OFFSET :offset');
            $stmt->bindValue(':search', '%' . $search_query . '%');
        }
        $stmt->bindValue(':perPage', $perPage, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if($search_query == ''){
            $totalCustomers = $db->query('SELECT COUNT(*) FROM customers')->fetchColumn();
        } else {
            $stmt = $db->prepare('SELECT COUNT(*) FROM customers WHERE name LIKE :search');
            $stmt->bindValue(':search', '%' . $search_query . '%');
            $stmt->execute();
            $totalCustomers = $stmt->fetchColumn();
        }
    } else {
        $getCustomer = $db->prepare("SELECT * FROM customers LIMIT :perPage OFFSET :offset");
        $getCustomer->bindValue(':perPage', $perPage, PDO::PARAM_INT);
        $getCustomer->bindValue(':offset', $offset, PDO::PARAM_INT);
        $getCustomer->execute();
        $rows = $getCustomer->fetchAll(PDO::FETCH_ASSOC);
    }

    $totalPages = ceil($totalCustomers / $perPage);


    if (is_array($rows)) {
        foreach ($rows as $row) {
            $tableRows .= "
                    <tr>
                        <td>" . $row['name'] . "</td>
                        <td>" . $row['address'] . "</td>
                        <td>" . $row['telephone'] . "</td>
                        <td>" . $row['email'] . "</td>
                        <td>" . date("Y-m-d", $row['date']) . "</td>
                        <td>
                            <a href='./edit_form.php?id=" . $row['id'] . "' class='btn btn-outline-warning'>Edit</a>
                            <a href='./add_note_form.php?id=" . $row['id'] . "' class='btn btn-outline-info'>Add Note</a>
                            <button class='btn btn-outline-danger delete-btn' data-id='" . $row['id'] . "'>
                              Delete
                            </button>
                        </td>
                    </tr>";
        }
    }
} catch (PDOException $e) {
    echo "Failed to connect to database: " . $e->getMessage();
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Customer List</title>
	<!-- Include Bootstrap CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container">
    <div class="row">
		<div class="col-8">
			<h1>Customer List</h1>
		</div>
		<div class="col-4 text-right">
			<a href="add_form.php" class="btn btn-info mt-2">Add Customer</a>
		</div>
	</div>
    <div class="row">
    	<form method="GET" action="">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Search by name" name="search" value="<?= isset($_GET['search']) ? $_GET['search'] : ''?>">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="submit">Search</button>
                </div>
            </div>
        </form>
    </div>
	<table class="table">
		<thead>
			<tr>
				<th>Name</th>
				<th>Address</th>
				<th>Telephone</th>
				<th>Email</th>
				<th>Date</th>
				<th>action</th>
			</tr>
		</thead>
		<tbody>
			<?php echo $tableRows;?>
		</tbody>
	</table>
    <!-- Display the pagination links using Bootstrap -->
    <nav aria-label="Page navigation">
        <ul class="pagination">
            <?php if ($page > 1): ?>
                <li class="page-item">
                    <?php if(isset($_GET['search']) && $_GET['search'] != ''){ ?>
                        <a class="page-link" href="?page=<?php echo $page - 1; ?>&search=<?php echo $search_query; ?>">Previous</a>
                    <?php }else{ ?>
                        <a class="page-link" href="?page=<?php echo $page - 1; ?>">Previous</a>
                    <?php }?>
                </li>
            <?php endif; ?>
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <li class="page-item <?php echo ($page === $i) ? 'active' : ''; ?>">
                    <?php if(isset($_GET['search']) && $_GET['search'] != ''){ ?>
                        <a class="page-link" href="?page=<?php echo $i; ?>&search=<?php echo $search_query; ?>"><?php echo $i; ?></a>
                    <?php }else{ ?>
                        <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                    <?php }?>
                </li>
            <?php endfor; ?>
            <?php if ($page < $totalPages): ?>
                <li class="page-item">
                    <?php if(isset($_GET['search']) && $_GET['search'] != ''){ ?>
                        <a class="page-link" href="?page=<?php echo $page + 1; ?>&search=<?php echo $search_query; ?>">Next</a>
                    <?php }else{ ?>
                        <a class="page-link" href="?page=<?php echo $page + 1; ?>">Next</a>
                    <?php }?>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
</div>

<!-- Delete confirmation modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete this customer?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-danger" id="confirm-delete-btn">Delete</button>
      </div>
    </div>
  </div>
</div>

<!-- Include jQuery and Bootstrap JS -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="./jQuery/delete.js"></script>

</body>
</html>
