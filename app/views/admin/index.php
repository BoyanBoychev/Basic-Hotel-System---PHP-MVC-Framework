<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(to right, #343a40, #495057);
            color: white;
            padding: 20px;
        }

        .admin-card {
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
            background-color: #212529;
        }

        .btn-custom {
            margin-right: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="admin-card">
            <h1 class="text-center">Admin Dashboard</h1>
            <p class="text-center">Welcome to the admin panel!</p>
            <div class="text-center">
                <a href="/hotel-reservation/public/index.php/admin/createRoom" class="btn btn-success btn-custom">Create New Room</a>
                <a href="/hotel-reservation/public/index.php/admin/editRoom" class="btn btn-warning btn-custom">Edit Room Prices</a>
                <a href="/hotel-reservation/public/index.php/admin/viewReservations" class="btn btn-info btn-custom">View Reservations</a>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>