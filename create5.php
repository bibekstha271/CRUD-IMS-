<?php
include 'db.php';
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $contact = $_POST['contact'];
    $email = $_POST['email'];
    $address = $_POST['address']; 

    $sql = "insert into `suppliers` (name,contact,email,address)
    values('$name','$contact','$email','$address')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        header('location:display5.php');
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
    <title>Inventory Management System </title>
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 20px;
    }

    .container {
        max-width: 600px;
        margin: 30px auto;
        padding: 30px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    h1 {
        text-align: center;
        color: #333;
        margin-bottom: 30px;
    }

    .form-group {
        margin-bottom: 25px;
        position: relative;
    }

    .form-label {
        display: block;
        margin-bottom: 8px;
        font-weight: bold;
        color: #555;
    }

    .form-control {
        width: 100%;
        padding: 12px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        transition: all 0.3s ease;
        font-size: 16px;
    }

    .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 0 2px rgba(0,123,255,0.25);
        outline: none;
    }

    select.form-control {
        width: 100%;
        padding: 12px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        transition: all 0.3s ease;
        font-size: 16px;
        appearance: none;
        background: #fff url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e") no-repeat right 1rem center;
        background-size: 1em;
    }

    select.form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 0 2px rgba(0,123,255,0.25);
    }

    input[type="number"].form-control {
        -moz-appearance: textfield;
    }

    input[type="number"].form-control::-webkit-outer-spin-button,
    input[type="number"].form-control::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    .btn {
        display: block;
        width: 100%;
        padding: 12px;
        font-size: 16px;
        font-weight: bold;
        color: #fff;
        background-color: #007bff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .btn:hover {
        background-color: #0056b3;
    }

    .btn:active {
        transform: translateY(1px);
    }
    </style>
</head>
<body>
    <div class="container">
        <h1>Add new suppliers</h1>
        <form method="post">
            <div class="form-group">
                <label class="form-label">Supplier Name:</label>
                <input type="text" class="form-control" placeholder="Enter supplier's name" name="name" autocomplete="off" required>
            </div>
            <div class="form-group">
                <label class="form-label">Contact:</label>
                <input type="text" class="form-control" placeholder="Enter contact numbers " name="contact" autocomplete="off" required>

            </div>
            <div class="form-group">
                <label class="form-label">Email:</label>
                <input type="text" class="form-control" placeholder="Enter email of suppliers" name="email" autocomplete="off" required>
            </div>
            <div class="form-group">
                <label class="form-label">Address</label>
                <input type="text" class="form-control" placeholder="Enter address" name="address"  autocomplete="off" required>
            </div>
            <button type="submit" class="btn" name="submit">Submit</button>
        </form>
    </div>
</body>
</html>