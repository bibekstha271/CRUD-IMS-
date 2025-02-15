<?php include 'db.php'; ?>
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
            margin-top: 60px;
            margin-bottom: 50px;
            background-color: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

     
        h2 {
            color: #2c3e50;
            margin-bottom: 30px;
            font-weight: 600;
            text-align: center;
        }

       
        .table {
            margin-bottom: 0;
        }

        .table thead {
            background-color: #34495e;
        }

        .table thead th {
            border-bottom: none;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.9rem;
            padding: 15px;
            color: #ffffff !important;
        }

        .table tbody tr:hover {
            background-color: #f8fafc;
        }

        .table td, .table th {
            padding: 15px;
            vertical-align: middle;
            color: #2c3e50;
        }

        /* Category count badge */
        .category-count {
            background-color: #3498db;
            color: white;
            padding: 5px 12px;
            border-radius: 15px;
            font-size: 0.9rem;
            font-weight: 500;
        }

        /* Action buttons */
        .btn-view {
            background-color: #f1c40f;
            border-color: #f1c40f;
            color: #fff;
            transition: all 0.3s ease;
            padding: 8px 20px;
            border-radius: 6px;
        }

        .btn-view:hover {
            background-color: #f39c12;
            border-color: #f39c12;
            color: #fff;
            transform: translateY(-1px);
        }

        .category-icon {
            margin-right: 10px;
            color: #34495e;
        }

           
        .user-info {
            background-color: #fff;
            padding: 15px 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.04);
            margin-top:30px;
            margin-bottom: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 30px auto;
            max-width: 1150px;
            padding: 15px;
            background: white;
            box-shadow: 0 4px 8px rgba(59, 58, 58, 0.2);
            border-radius: 8px;
            text-align: center;
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

    <div class="container">
        <h2 style="margin-bottom:55px;">Inventory Categories</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Category Name</th>
                    <th>Items Count</th>
                    <th>Last Updated</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $categories = [
                    ['id' => 1, 'name' => 'Electronics', 'icon' => 'fas fa-laptop', 'table' => 'inventory1', 'file' => 'display1.1.php'],
                    ['id' => 2, 'name' => 'Office Supplies', 'icon' => 'fas fa-pencil-alt', 'table' => 'inventory2', 'file' => 'display2.2.php'],
                    ['id' => 3, 'name' => 'Furniture', 'icon' => 'fas fa-chair', 'table' => 'inventory3', 'file' => 'display3.3.php'],
                    ['id' => 4, 'name' => 'Kitchen Equipment', 'icon' => 'fas fa-utensils', 'table' => 'inventory4', 'file' => 'display4.4.php']
                ];

                foreach ($categories as $category) {
                    $sql = "SELECT COUNT(*) as count FROM `{$category['table']}`";
                    $result = mysqli_query($conn, $sql);
                    $count = $result ? mysqli_fetch_assoc($result)['count'] : 0;

                    echo "<tr>
                        <td>{$category['id']}</td>
                        <td><i class='{$category['icon']}'></i> {$category['name']}</td>
                        <td><span class='category-count'>{$count} items</span></td>
                        <td>" . date('Y-m-d H:i:s') . "</td>
                        <td><a href='{$category['file']}' class='btn btn-view'><i class='fas fa-eye'></i> View Items</a></td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
    function confirmLogout() {
        return confirm("Are you sure you want to logout?");
    }
</script>
</body>
</html>
