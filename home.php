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

        nav a, .dropdown .dropbtn {
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            margin: 0 10px;
            transition: background-color 0.3s, color 0.3s;
            cursor: pointer;
            border: none;
            background: none;
            font-size: 16px;
        }

        nav a:hover, .dropdown:hover .dropbtn {
            background-color: #00a8ff;
            border-radius: 6px;
            color: white;
        }

        /* Dropdown */
        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: white;
            min-width: 160px;
            box-shadow: 0px 8px 16px rgba(0,0,0,0.2);
            border-radius: 5px;
            overflow: hidden;
            top: 100%;
            left: 0;
            z-index: 10;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            display: block;
            transition: background 0.3s;
            text-align: left;
            white-space: nowrap;
        }

        .dropdown-content a:hover {
            background: #ddd;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .logout-btn {
            color: white !important;
            background-color: #e74c3c;
            border-radius: 6px;
            margin-left: auto;
            padding: 8px 16px !important;
            transition: background-color 0.3s, color 0.3s;
        }

        .logout-btn:hover {
            background-color: #ff4d4d;
            color: white;
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
            gap: 5px;
            display: grid;
            grid-template-columns: repeat(3, 1fr); 
            justify-items: center;
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

        .last-row {
            grid-column: 2 / 3; /* Centers the two last cards on the next line */
            display: flex;
            justify-content: center;
            float:center;
            gap: 20px;
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

        footer {
            text-align: center;
            padding: 10px;
            background: #333;
            color: white;
            margin-top: 20px;
        }



    </style>
</head>
<body>
    
    <header>

        <h1><i class="fas fa-boxes"></i>    Inventory Management System </h1>
    </header>

    <nav>
        <a href="home.php"><i class="fa fa-home"></i> Home</a>
        <a href="category.php"><i class="fa fa-list"></i> Category</a>
        <div class="dropdown">
            <button class="dropbtn "><i class="fa fa-box"></i> Products
                <i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-content">
                <a href="display1.php">Inventory 1</a>
                <a href="display2.php">Inventory 2</a>
                <a href="display3.php">Inventory 3</a>
                <a href="display4.php">Inventory 4</a>
            </div>
        </div> 
        <a href="display(clients).php"><i class="fa fa-users"></i> Clients</a>
        <a href="display5.php"><i class="fa fa-truck"></i> Suppliers</a>
        <a href="view_orders1.php" style="text-decoration:none;"><i class="fa fa-shopping-cart"></i> Orders</a>
        <a href="logout.php" class="nav-link logout-btn" name="logout" onclick="return confirmLogout();">
            <i class="fa fa-sign-out-alt"></i> Logout
        </a>

    </nav>

   <div class="user-info">
    <div>
        <i class="fas fa-user" style="margin-right: 8px; color: #3498db;"></i>     <?php echo htmlspecialchars('Admin'); ?>
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
        
        <h2 >Welcome to the Inventory Management System</h2>
        <p style="margin-top:20px;">Use the options below to manage your inventory and view reports.</p>

        <div class="cards">
            <div class="card">
                <i class="fa fa-box card-icon"></i>
                <h3>Manage Inventory</h3>
                <p style="margin:10px 0px;">Add, update, and delete inventory items.</p>
                <a href="category.php">Go to Inventory</a>
            </div>

            <div class="card">
                <i class="fa fa-user-tie card-icon"></i>
                <h3>View Clients</h3>
                <p  style="margin:10px 0px;">Analyze Clients data and reports.</p>
                <a href="display(clients).php">View Reports</a>
            </div>

            <div class="card">
                <i class="fa fa-warehouse card-icon"></i>
                <h3>Suppliers</h3>
                <p style="margin:10px 0px;">Configure data on our suppliers.</p>
                <a href="display5.php">View Supplier's Info</a>
            </div>

                      <div class="card">
                <i class="fa fa-shopping-cart card-icon"></i>
                <h3>Client Orders</h3>
                <p style="margin:10px 0px;">View orders submitted by our clients.</p>
                <a href="view_orders1.php">View Orders</a>
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
    <script>
    function confirmLogout() {
        return confirm("Are you sure you want to logout?");
    }
</script>

</body>
</html>