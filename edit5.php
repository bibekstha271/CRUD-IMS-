<?php
include 'db.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('location:display5.php');
    exit();
}

$id = intval($_GET['id']);

$sql = "SELECT * FROM `suppliers` WHERE id=$id";
$result = mysqli_query($conn, $sql);

if (!$result || mysqli_num_rows($result) == 0) {
    die("Item not found.");
}

$row = mysqli_fetch_assoc($result);
$name = $row['name'];
$contact =  $row['contact'];
$email = $row['email'];
$address = $row['address'];

if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $contact = mysqli_real_escape_string($conn, $_POST['contact']); 
    $email = $_POST['email']; 
    $address = $_POST['address'];

    $sql = "UPDATE `suppliers` SET 
            name='$name', 
            contact='$contact', 
            email='$email', 
            address='$address'
            WHERE id='$id'";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        header('location:display5.php');
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
        <h1>Update Supplier</h1>
        <form method="post">
            <div class="form-group">
                <label class="form-label">Supplier Name:</label>
                <input type="text" class="form-control" placeholder="Enter supplier's name" name="name" value="<?php echo $name; ?>" autocomplete="off" required>
            </div>
            <div class="form-group">
                <label class="form-label">Contact:</label>
                <input type="text" class="form-control" placeholder="Enter contact number" name="contact" value="<?php echo $contact; ?>" autocomplete="off" required>

            </div>
            <div class="form-group">
                <label class="form-label">Email:</label>
                <input type="text" class="form-control" placeholder="Enter email of suppliers" name="email" value="<?php echo $email; ?>" autocomplete="off" required>
            </div>
            <div class="form-group">
                <label class="form-label">Address</label>
                <input type="text" class="form-control" placeholder="Enter address" name="address" value="<?php echo $address; ?>" autocomplete="off" required>
            </div>
            <button type="submit" class="btn" name="submit">Update</button>
        </form>
    </div>
</body>
</html>
