<?php
include 'db.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capture form data and sanitize it
    $client_name = htmlspecialchars($_POST['client_name']);
    $client_contact = htmlspecialchars($_POST['client_contact']);
    $product_name = htmlspecialchars($_POST['product_name']);
    $product_stock = (int)$_POST['product_stock'];  // Ensure it's an integer
    $order_description = htmlspecialchars($_POST['order_description']);

    // Prepare an SQL statement to insert the data into the database
    $sql = "INSERT INTO orders (client_name, client_contact, product_name, product_stock, order_description)
            VALUES (?, ?, ?, ?, ?)";

    // Prepare the statement
    $stmt = $conn->prepare($sql);

    // Bind parameters to the SQL query
    $stmt->bind_param("sssis", $client_name, $client_contact, $product_name, $product_stock, $order_description);

    // Execute the statement
    if ($stmt->execute()) {
        // echo "<h3>Order successfully placed!</h3>";
        // echo "<p>Thank you, $client_name. Your order for $product_name has been received.</p>";
        header('location:view_orders.php');
    } else {
        echo "<h3>Error placing the order. Please try again.</h3>";
    }

    // Close the statement
    $stmt->close();
} 

// Close the database connection
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            max-width: 800px;
            margin: 80px auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            font-weight: bold;
            color: #333;
        }
        input, select, textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        textarea {
            height: 100px;
            resize: vertical;
        }
        button {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
        .note {
            color: #888;
            font-size: 14px;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Client Order Form</h1>

    <form  method="POST">
        <!-- Client Name -->
        <div class="form-group">
            <label for="client_name">Client Name</label>
            <input type="text" id="client_name" name="client_name" required>
        </div>

        <!-- Contact Information -->
        <div class="form-group">
            <label for="client_contact">Contact Number</label>
            <input type="tel" id="client_contact" name="client_contact" required>
        </div>

        <!-- Product Name -->
        <div class="form-group">
            <label for="product_name">Product Name</label>
            <input type="text" id="product_name" name="product_name" required>
        </div>

        <!-- Product Stock -->
        <div class="form-group">
            <label for="product_stock">Product Stock (Quantity)</label>
            <input type="number" id="product_stock" name="product_stock" min="1" required>
        </div>

        <!-- Product Description -->
        <div class="form-group">
            <label for="order_description">Description of Order</label>
            <textarea id="order_description" name="order_description" placeholder="Provide any additional information" required></textarea>
        </div>

        <!-- Submit Button -->
        <button type="submit">Place Order</button>
    </form>

    <div class="note">
        <p>Note: Please make sure all the fields are filled correctly before submitting.</p>
    </div>
</div>

</body>
</html>
