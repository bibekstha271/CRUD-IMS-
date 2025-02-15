<?php
include 'db.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('location:display2.php');
    exit();
}

$id = intval($_GET['id']);

$sql = "SELECT * FROM `inventory2` WHERE id=$id";
$result = mysqli_query($conn, $sql);

if (!$result || mysqli_num_rows($result) == 0) {
    die("Item not found.");
}

$row = mysqli_fetch_assoc($result);
$item = htmlspecialchars($row['name']);
$status = htmlspecialchars($row['Status']);
$qnt = (int)$row['quantity'];
$price = (float)$row['price'];

if (isset($_POST['submit'])) {
    $itm_name = mysqli_real_escape_string($conn, $_POST['item']);
    $status = mysqli_real_escape_string($conn, $_POST['status']); 
    $qnt = (int)$_POST['qnt']; 
    $price = (float)$_POST['price'];

    $sql = "UPDATE `inventory2` SET 
            name='$itm_name', 
            Status='$status', 
            quantity='$qnt', 
            price='$price'
            WHERE id='$id'";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        header('location:display2.php');
        exit();
    } else {
        die(mysqli_error($conn));
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inventory Management System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }
        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            transition: border-color 0.3s;
        }
        .form-control:focus {
            border-color: #007bff;
            outline: none;
        }
        .btn {
            display: inline-block;
            padding: 10px 15px;
            font-size: 16px;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            transition: background-color 0.3s;
        }
        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Update Item</h1>
        <form method="post">
            <div class="form-group">
                <label class="form-label">Item Name:</label>
                <input type="text" class="form-control" 
                       placeholder="Enter item name" 
                       name="item" 
                       autocomplete="off" 
                       value="<?php echo $item; ?>" 
                       required>
            </div>
            <div class="form-group">
                <label class="form-label">Status:</label>
                <select name="status" class="form-control" required>
                    <option value="">Select Status</option>
                    <option value="Available" <?php echo ($status == 'Available') ? 'selected' : ''; ?>>Available</option>
                    <option value="Not available" <?php echo ($status == 'Not available') ? 'selected' : ''; ?>>Not Available</option>
                </select>
            </div>
            <div class="form-group">
                <label class="form-label">Quantity:</label>
                <input type="number" class="form-control" 
                       placeholder="Enter quantity of items" 
                       name="qnt" 
                       autocomplete="off" 
                       value="<?php echo $qnt; ?>" 
                       required>
            </div>
            <div class="form-group">
                <label class="form-label">Price:</label>
                <input type="number" class="form-control" 
                       placeholder="Enter price of item" 
                       name="price" 
                       step="0.01" 
                       autocomplete="off" 
                       value="<?php echo $price; ?>" 
                       required>
            </div>
            <button type="submit" class="btn" name="submit">Update</button>
        </form>
    </div>
</body>
</html>
