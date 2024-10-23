<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Room</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(to right, #343a40, #495057);
            color: white;
            padding: 20px;
        }

        .create-room-card {
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
            background-color: #212529;
        }

        .btn-custom {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="create-room-card">
            <h1 class="text-center">Create New Room</h1>
            <form method="post" action="/hotel-reservation/public/index.php/admin/createRoom">
                <div class="form-group">
                    <label for="room_type">Room Type</label>
                    <select name="room_type" class="form-control" required>
                        <option value="">Select Room Type</option>
                        <?php foreach ($roomTypes as $type): ?>
                            <option value="<?php echo htmlspecialchars($type); ?>"><?php echo htmlspecialchars($type); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="number" name="price" class="form-control" placeholder="Enter room price" required>
                </div>
                <button type="submit" class="btn btn-success btn-custom">Create Room</button>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>