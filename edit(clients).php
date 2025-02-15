<?php
include 'db.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('location:display(clients).php'); // Fixed filename
    exit();
}

$id = intval($_GET['id']);

$sql = "SELECT * FROM `client` WHERE id=$id";
$result = mysqli_query($conn, $sql);

if (!$result || mysqli_num_rows($result) == 0) {
    die("Item not found.");
}

$row = mysqli_fetch_assoc($result);
$name = $row['name'];
$name2 = $row['company_name'];
$email = $row['email'];
$contact = $row['contact'];

if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $name2 = mysqli_real_escape_string($conn, $_POST['name2']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $contact = mysqli_real_escape_string($conn, $_POST['contact']);

    $sql = "UPDATE `client` SET 
            name='$name', 
            company_name='$name2', 
            email='$email', 
            contact='$contact'
            WHERE id='$id'";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        header('location:display(clients).php'); // Fixed filename
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
        <h1>Update Client</h1>
        <form method="post">
            <div class="form-group">
                <label class="form-label">Client Name:</label>
                <input type="text" class="form-control" placeholder="Enter client's name" name="name" value="<?php echo htmlspecialchars($name); ?>" autocomplete="off" required>
            </div>
            <div class="form-group">
                <label class="form-label">Company Name:</label>
                <input type="text" class="form-control" placeholder="Enter company's name" name="name2" value="<?php echo htmlspecialchars($name2); ?>" autocomplete="off" required>
            </div>
            <div class="form-group">
                <label class="form-label">Email:</label>
                <input type="email" class="form-control" placeholder="Enter email of client" name="email" value="<?php echo htmlspecialchars($email); ?>" autocomplete="off" required>
            </div>
            <div class="form-group">
                <label class="form-label">Contact:</label>
                <input type="text" class="form-control" placeholder="Enter contact" name="contact" value="<?php echo htmlspecialchars($contact); ?>" autocomplete="off" required>
            </div>
            <button type="submit" class="btn" name="submit">Update</button>
        </form>
    </div>
</body>
</html>
