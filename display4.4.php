<?php
include 'db.php';
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inventory Management System</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
* {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #f0f2f5;
            font-family: 'Arial', sans-serif;
        }

        header {
            background-color: #4CAF50;
            color: white;
            padding: 40px;
            text-align: center;
        }

        nav {
            background-color: #333;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 10px;
            position: relative;
        }

        nav a {
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            margin: 0 10px;
            transition: background-color 0.3s, color 0.3s;
            font-size: 16px;
        }

        nav a:hover {
            background-color: #00a8ff;
            border-radius: 6px;
            color: white;
        }

        /* Red Logout Button */
        .logout-btn {
            background-color: #ff4d4d;
            padding: 10px 15px;
            border-radius: 6px;
        }

        .logout-btn:hover {
            background-color: darkred;
        }

        .container {
            margin-top: 50px;
            margin-bottom: 50px;
        }

        /* Header styling */
        h2 {
            color: #2c3e50;
            margin-bottom: 30px;
            font-weight: 600;
            text-align: center;  /* Added */
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

        /* Button styling */
        .button-container {
            margin-bottom: 25px;
            display: flex;
            gap: 10px;  /* Added */
        }

        .btn-add {
            background-color: #2ecc71;
            border-color: #2ecc71;
            padding: 10px 20px;
            border-radius: 8px;
            transition: all 0.3s ease;
            display: flex;  /* Added */
            align-items: center;  /* Added */
            gap: 8px;  /* Added */
        }

        .btn-add:hover {
            background-color: #27ae60;
            border-color: #27ae60;
            transform: translateY(-1px);
        }

        .btn-search {
            background-color: #3498db;
            border-color: #3498db;
            padding: 10px 20px;
            border-radius: 8px;
            transition: all 0.3s ease;
            display: flex;  /* Added */
            align-items: center;  /* Added */
            gap: 8px;  /* Added */
        }

        .btn-search:hover {
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
            overflow-x: auto;  /* Added */
        }

        .table {
            margin-bottom: 0;
            width: 100%;  /* Added */
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

        .table thead th:nth-child(5) {  /* Price header */
            text-align: right;
            padding-right: 25px;
        }

        .table thead th {
            white-space: nowrap;  /* Prevent header text from wrapping */
        }

        .table thead th:last-child {  /* Actions header */
            text-align: left;
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
            width: 110px;  /* Updated from 100px to 110px */
            text-transform: uppercase;
            white-space: nowrap;  /* Added */
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

        /* Add price formatting */
        .table td:nth-child(5) {
            text-align: right;
            padding-right: 25px;
        }
</style>
</head>
<body>


<header>
        <h1><i class="fas fa-boxes"></i> Inventory Management System</h1>
    </header>

    <nav>
        <a href="home1.php" style="text-decoration:none;"><i class="fa fa-home"></i> Home</a>
        <a href="category1.php" style="text-decoration:none;"><i class="fa fa-list"></i> Category</a>
        <a href="view_orders.php" style="text-decoration:none;"><i class="fa fa-shopping-cart"></i> Orders</a>
        <a href="logout.php" class="nav-link logout-btn" name="logout" onclick="return confirmLogout();">
            <i class="fa fa-sign-out-alt"></i> Logout
        </a>
    </nav>

<div class="container">
    <h2 class="text-center">Inventory 4</h2> 
    
    <div class="user-info">
    <div>
        <i class="fas fa-user" style="margin-right: 8px; color: #3498db;"></i>     <?php echo htmlspecialchars('Client'); ?>
    </div>
    <div>
        <i class="far fa-clock" style="margin-right: 8px; color: #3498db;"></i> <span id="current-time"><?php echo date('Y-m-d H:i:s'); ?></span>
    </div>
</div>

<script>
    // Function to update the clock
    function updateClock() {
        const currentTime = new Date();
        const hours = String(currentTime.getHours()).padStart(2, '0');
        const minutes = String(currentTime.getMinutes()).padStart(2, '0');
        const seconds = String(currentTime.getSeconds()).padStart(2, '0');
        const date = currentTime.toISOString().split('T')[0]; // YYYY-MM-DD
        const timeString = `${date} ${hours}:${minutes}:${seconds}`;

        // Update the time in the DOM
        document.getElementById('current-time').textContent = timeString;
    }

    // Update the clock every second
    setInterval(updateClock, 1000);

    // Set initial time
    updateClock();
</script>

    <div class="d-flex justify-content-between button-container">

        <button class="btn btn-search text-white">
            <a href="search4.4.php" class="text-light" style="text-decoration: none;">
                <i class="fas fa-search"></i> Search Items
            </a>
        </button>
    </div>
    
    <div class="table-container">
        <table class="table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Item Name</th>
                    <th>Status</th>
                    <th>Quantity</th>
                    <th style="float:right;">Price</th>
                   
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM inventory4";
                $result = mysqli_query($conn, $sql);
                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $id = $row['id'];
                        $item = $row['name'];
                        $status = $row['Status'];
                        $qnt = $row['quantity'];
                        $price = $row['price'];

                        $statusClass = ($status == 'Available') ? 'status-available' : 'status-not-available';

                        echo '<tr>
                            <td>' . $id . '</td>
                            <td>' . $item . '</td>
                            <td><span class="status-badge ' . $statusClass . '">' . $status . '</span></td>
                            <td>' . $qnt . '</td>
                            <td>$' . number_format($price, 2) . '</td>
                   
                        </tr>';
                    }
                } else {
                    echo '<tr><td colspan="6" class="text-danger">Error fetching data: ' . mysqli_error($conn) . '</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    function confirmLogout() {
        return confirm("Are you sure you want to logout?");
    }
</script>
</body>
</html>
