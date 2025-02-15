<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Data</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f0f2f5;
            font-family: 'Arial', sans-serif;
        }

        .container {
            margin-top: 50px;
            margin-bottom: 50px;
        }

        /* Header styling */
        h1 {
            color: #2c3e50;
            margin-bottom: 30px;
            font-weight: 600;
            text-align: center;
        }

        /* User info styling */
        .user-info {
            background-color: #fff;
            padding: 15px 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.04);
            margin-bottom: 20px;
            color: #2c3e50;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .user-info i {
            margin-right: 8px;
            color: #3498db;
        }

        /* Search form styling */
        .search-form {
            background-color: #fff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            margin-bottom: 25px;
            display: flex;
            gap: 10px;
        }

        .search-form input[type="text"] {
            width: 70%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            transition: all 0.3s ease;
            font-size: 0.95rem;
        }

        .search-form input[type="text"]:focus {
            border-color: #3498db;
            box-shadow: 0 0 0 2px rgba(52, 152, 219, 0.1);
            outline: none;
        }

        .search-form button {
            background-color: #3498db;
            border-color: #3498db;
            padding: 10px 20px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
        }

        .search-form button:hover {
            background-color: #2980b9;
            border-color: #2980b9;
            transform: translateY(-1px);
        }

        /* Table styling */
        .table-container {
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            padding: 20px;
            overflow-x: auto;
        }

        .table {
            margin-bottom: 0;
        }

        .table thead {
            background-color: #34495e;
            color: #fff;
        }

        .table thead th {
            border-bottom: none;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.9rem;
            padding: 15px;
        }

        .table tbody tr:hover {
            background-color: #f8fafc;
        }

        .table td {
            padding: 15px;
            vertical-align: middle;
            color: #2c3e50;
        }

        /* Status Badge Styling */
        .status-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 6px;
            font-weight: 500;
            font-size: 12px;
            text-align: center;
            width: 110px;
            text-transform: uppercase;
            white-space: nowrap;
        }

        .status-available {
            background-color: #2ecc71;
            color: white;
        }

        .status-not-available {
            background-color: #e74c3c;
            color: white;
        }

        /* Action buttons */
        .btn-warning {
            background-color: #f1c40f;
            border-color: #f1c40f;
            color: #fff;
            margin-right: 5px;
            transition: all 0.3s ease;
        }

        .btn-warning:hover {
            background-color: #f39c12;
            border-color: #f39c12;
            color: #fff;
        }

        .btn-danger {
            background-color: #e74c3c;
            border-color: #e74c3c;
            transition: all 0.3s ease;
        }

        .btn-danger:hover {
            background-color: #c0392b;
            border-color: #c0392b;
        }

        .btn-sm {
            padding: 0.4rem 0.8rem;
            font-size: 0.875rem;
            border-radius: 6px;
        }

        /* Alert styling */
        .alert-message {
            background-color: #fff;
            border-radius: 8px;
            padding: 15px 20px;
            margin-top: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Search Inventory</h1>

        <div class="user-info">
            <div>
                <i class="fas fa-user"></i> <?php echo htmlspecialchars('Admin'); ?>
            </div>
            <div>
                <i class="far fa-clock"></i> <?php echo '2025-02-03 15:15:28'; ?>
            </div>
        </div>

        <form method="post" class="search-form">
            <input type="text" placeholder="Search by ID or Item name" autocomplete="off" name="search">
            <button class="btn btn-primary" name="submit" type="submit">
                <i class="fas fa-search"></i> Search
            </button>
        </form>

        <div class="table-container">
            <table class="table">
                <?php
               
                if (isset($_POST['submit'])) {
                    $search = mysqli_real_escape_string($conn, $_POST['search']); // Prevent SQL injection
                    $sql = "SELECT * FROM inventory3 WHERE id = '$search' OR name LIKE '%$search%'";
                    $result = mysqli_query($conn, $sql);

                    if ($result) {
                        if (mysqli_num_rows($result) > 0) {
                            echo '
                                <thead>
                                    <tr>
                                        <th scope="col">Id</th>
                                        <th scope="col">Item Name</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                            ';
                            while ($row = mysqli_fetch_assoc($result)) {
                                $id = $row['id'];
                                $item = $row['name'];
                                $status = $row['Status'];
                                $qnt = $row['quantity'];
                                $price = $row['price'];

                                // Determine status badge
                                $statusBadge = ($status == 'Available') 
                                    ? '<span class="status-badge status-available">Available</span>' 
                                    : '<span class="status-badge status-not-available">Not Available</span>';

                                echo '<tr>
                                    <th scope="row">' . $id . '</th>
                                    <td>' . $item . '</td>
                                    <td>' . $statusBadge . '</td>
                                    <td>' . $qnt . '</td>
                                    <td>' . $price . '</td>
                                    <td>
                                        <a href="edit3.php?id=' . $id . '" class="btn btn-warning btn-sm">Edit</a>
                                        <a href="delete3.php?id=' . $id . '" class="btn btn-danger btn-sm" onclick="return confirmDelete();">Delete</a>
                                    </td>
                                </tr>';
                            }
                            echo '</tbody>';
                        } else {
                            echo '<div class="alert alert-warning alert-message" role="alert">Data not found.</div>';
                        }
                    }
                }
                ?>
               
                
            </table>
        </div>
    </div>
    <script>
    function confirmDelete() {
        return confirm("Are you sure you want to delete this item?");
    }
</script>
</body>
</html>