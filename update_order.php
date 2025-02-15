<?php
include 'db.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('location:view_orders.php');
    exit();
}

$id = intval($_GET['id']);  // Ensure ID is an integer

// Fetch the existing order details
$sql = "SELECT * FROM `orders` WHERE id=$id";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 0) {
    die("Order not found.");
}

$row = mysqli_fetch_assoc($result);
$name = htmlspecialchars($row['client_name']);
$contact = htmlspecialchars($row['client_contact']);
$name2 = htmlspecialchars($row['product_name']);
$qnt = (int)$row['product_stock'];
$description = htmlspecialchars($row['order_description']);

// Update the order when the form is submitted
if (isset($_POST['submit'])) {
    $client_name = mysqli_real_escape_string($conn, $_POST['client_name']);
    $client_contact = mysqli_real_escape_string($conn, $_POST['client_contact']);
    $product_name = mysqli_real_escape_string($conn, $_POST['product_name']);
    $product_stock = (int)$_POST['product_stock'];
    $order_description = mysqli_real_escape_string($conn, $_POST['order_description']);

    // Update query without bind_param()
    $sql = "UPDATE `orders` SET 
            client_name = '$client_name', 
            client_contact = '$client_contact', 
            product_name = '$product_name', 
            product_stock = $product_stock, 
            order_description = '$order_description' 
            WHERE id = $id";

    if (mysqli_query($conn, $sql)) {
        header('location:view_orders.php');
        exit();
    } else {
        die("Error updating order: " . mysqli_error($conn));
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Order</title>
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
            margin: 20px auto;
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
    <h1>Update Client Order</h1>

    <form method="POST">
        <div class="form-group">
            <label for="client_name">Client Name</label>
            <input type="text" id="client_name" name="client_name" value="<?php echo htmlspecialchars($row['client_name']); ?>" required>
        </div>

        <div class="form-group">
            <label for="client_contact">Contact Number</label>
            <input type="tel" id="client_contact" name="client_contact" value="<?php echo htmlspecialchars($row['client_contact']); ?>" required>
        </div>

        <div class="form-group">
            <label for="product_name">Product Name</label>
            <input type="text" id="product_name" name="product_name" value="<?php echo htmlspecialchars($row['product_name']); ?>" required>
        </div>

        <div class="form-group">
            <label for="product_stock">Product Stock (Quantity)</label>
            <input type="number" id="product_stock" name="product_stock" value="<?php echo $row['product_stock']; ?>" min="1" required>
        </div>

        <div class="form-group">
            <label for="order_description">Description of Order</label>
            <textarea id="order_description" name="order_description" required><?php echo htmlspecialchars($row['order_description']); ?></textarea>
        </div>

        <button type="submit" name="submit">Update Order</button>
    </form>

    <div class="note">
        <p>Note: Please ensure all fields are filled correctly before submitting.</p>
    </div>
</div>

</body>
</html>
