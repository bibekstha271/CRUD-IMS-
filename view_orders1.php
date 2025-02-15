<?php
include 'db.php';

// Deletion logic
if (isset($_GET['id']) && isset($_GET['action']) && $_GET['action'] == 'delete') {
    $id = intval($_GET['id']); // Ensure the ID is an integer for security

    // Prepare and execute delete query
    $sql = "DELETE FROM `orders` WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);  // Bind the ID as an integer parameter
    $result = $stmt->execute();

    if ($result) {
        header('Location: view_orders1.php');
        exit();
    } else {
        die("Error deleting order: " . mysqli_error($conn));
    }
}

// Fetch orders from the database
$sql = "SELECT * FROM orders";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Orders</title>
    <head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    </head>

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
            width: 80%;
            max-width: 1200px;
            margin: 20px auto;
            text-align: center;
        }
        h2 {
            color: #333;
        }
        .add-order-btn {
            display: inline-block;
            margin-bottom: 20px;
            padding: 10px 15px;
            font-size: 16px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .add-order-btn:hover {
            background-color: #0056b3;
        }
        .card-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }
        .card {
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: left;
            transition: transform 0.2s ease;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            background-color: #fff;
            width: 300px; 
            padding: 20px; 
            border-radius: 10px;
            height: 400px; 
        }
        .card:hover {
            transform: scale(1.07);
        }
        .card h3 {
            color: #333;
            font-size: 20px;
            margin: 15px 0;
        
        }
        .card p {
            font-size: 16px;
            margin: 5px 0;
            color: #555;
        }
        .card .description {
            color: #888;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            margin-bottom: 10px;
            font-size: 14px;
            max-height: 100px;
        }
        .card .order-date {
            font-size: 12px;
            color: #888;
            text-align: right;
        }
        .card button {
            margin-top: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            padding: 10px 14px; 
            font-size: 16px; 
        }
        .card button:hover {
            background-color: #45a049;
        }
        .card .delete-btn {
            background-color: #f44336;
        }
        .card .delete-btn:hover {
            background-color: #e53935;
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
            max-width: 1100px;
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
<h1><i class="fas fa-boxes"></i>    Inventory Management System </h1>
</header>

<nav>
    <a href="home.php" style="text-decoration:none;"><i class="fa fa-home"></i> Home</a>
    <a href="category.php" style="text-decoration:none;"><i class="fa fa-list"></i> Category</a>
        <div class="dropdown">
            <button class="dropbtn "><i class="fa fa-box"></i> Products
                <i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-content">
                <a href="display1.php" style="text-decoration:none;">Inventory 1</a>
                <a href="display2.php" style="text-decoration:none;">Inventory 2</a>
                <a href="display3.php" style="text-decoration:none;">Inventory 3</a>
                <a href="display4.php" style="text-decoration:none;">Inventory 4</a>
            </div>
        </div> 
        <a href="display(clients).php" style="text-decoration:none;"><i class="fa fa-users"></i> Clients</a>
        <a href="display5.php" style="text-decoration:none;"><i class="fa fa-truck"></i> Suppliers</a>
        <a href="view_orders1.php" style="text-decoration:none;"><i class="fa fa-shopping-cart"></i> Orders</a>
        <a href="logout.php" class="nav-link logout-btn" name="logout" onclick="return confirmLogout();">
            <i class="fa fa-sign-out-alt"></i> Logout
        </a>
</nav>

<div class="container">

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

    <h2 style="margin:30px;">Order List</h2>


    <div class="card-container">
        <?php
        // Check if there are any orders
        if ($result->num_rows > 0) {
            // Loop through each order and display it in a card
            while($row = $result->fetch_assoc()) {
                echo "<div class='card'>";
                echo "<h3>" . htmlspecialchars($row['product_name']) . "</h3>";
                echo "<p><strong>Client Name:</strong> " . htmlspecialchars($row['client_name']) . "</p>";
                echo "<p><strong>Contact:</strong> " . htmlspecialchars($row['client_contact']) . "</p>";
                echo "<p><strong>Stock Quantity:</strong> " . $row['product_stock'] . "</p>";
                echo "<p class='description'><strong>Description:</strong> " . htmlspecialchars($row['order_description']) . "</p>";
                echo "<p class='order-date'><strong>Order Date:</strong> " . $row['order_date'] . "</p>";
       
                echo "<a href='view_orders1.php?id=" . $row['id'] . "&action=delete' onclick='return confirm(\"Are you sure you want to delete this order?\");'><button class='delete-btn'>Delete Order</button></a>";
                echo "</div>";
            }
        } else {
            echo "<p>No orders found.</p>";
        }
        ?>
    </div>
</div>
<script>
    function confirmLogout() {
        return confirm("Are you sure you want to logout?");
    }
</script>
</body>
</html>
<?php
// Close the connection after the query is done
$conn->close();
?>
