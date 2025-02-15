<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Management System Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
            max-width: 1200px;
            padding: 15px;
            background: white;
            box-shadow: 0 4px 8px rgba(59, 58, 58, 0.2);
            border-radius: 8px;
            text-align: center;
        }

        .container {
            margin: 20px auto;
            max-width: 1200px;
            padding: 50px;
            background: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 8px;
            text-align: center;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
        }

        .card {
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 30px;
            margin-top:30px;
            text-align: center;
            transition: transform 0.2s;
        }

        .card:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
        }

        .card h3 {
            margin-bottom: 10px;
        }

        .card a {
            text-decoration: none;
            color: #4CAF50;
            font-weight: bold;
        }

        .card-icon {
            font-size: 50px;
            margin-bottom: 10px;
            color: #4CAF50;
        }

        footer {
            text-align: center;
            padding: 10px;
            background: #333;
            color: white;
            margin-top: 20px;
        }

    </style>
    <meta http-equiv="refresh" content="10">

</head>
<body>
    
    <header>
        <h1><i class="fas fa-boxes"></i> Inventory Management System</h1>
    </header>

    <nav>
        <a href="home1.php"><i class="fa fa-home"></i> Home</a>
        <a href="category1.php"><i class="fa fa-list"></i> Category</a>
        <a href="view_orders.php"><i class="fa fa-shopping-cart"></i> Orders</a>
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
        <h2>Welcome to the Inventory Management System</h2>
        <p style="margin-top:20px;">Use the options below to view our inventory and place orders.</p>

        <div class="cards">
            <div class="card">
                <i class="fa fa-box card-icon"></i>
                <h3>View Inventory</h3>
                <p style="margin:10px 0px;">View inventory items.</p>
                <a href="category1.php">Go to our Categories</a>
            </div>

            <div class="card">
                <i class="fa fa-shopping-cart card-icon"></i>
                <h3>Client Orders</h3>
                <p style="margin:10px 0px;">Submit your orders to be placed.</p>
                <a href="view_orders.php">Place Orders</a>
            </div>

            <!-- New Card for Order Count -->
            <div class="card">
                <i class="fas fa-list-ol card-icon"></i>
                <h3>Total Orders</h3>
                <p style="margin:10px 0px;"><h4>Total orders placed: 
                    <strong>
                        <?php
                            include 'db.php'; // Ensure this file contains your DB connection ($conn)

                            $query = "SELECT COUNT(*) AS order_count FROM orders"; 
                            $result = mysqli_query($conn, $query);
                            if ($result) {
                                $row = mysqli_fetch_assoc($result);
                                echo $row['order_count']; 
                            } else {
                                echo "0"; 
                            }
                            mysqli_close($conn);
                        ?>
                    </strong>
                        </h4>
                </p>
            </div>
        </div>
    </div>

    <footer>
        <p>&copy; 2025 Inventory Management System</p>
    </footer>
    <script>
    function confirmLogout() {
        return confirm("Are you sure you want to logout?");
    }
</script>


</body>
</html>
