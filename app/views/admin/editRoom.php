<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Room Prices</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(to right, #343a40, #495057);
            color: white;
            padding: 20px;
        }

        .edit-price-card {
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
        <div class="edit-price-card">
            <h1 class="text-center">Edit Room Prices</h1>
            <form method="post" action="/hotel-reservation/public/index.php/admin/editRoom">
                <div class="form-group">
                    <label for="room_id">Select Room</label>
                    <select name="room_id" class="form-control" required>
                        <?php foreach ($rooms as $room): ?>
                            <option value="<?php echo $room['id']; ?>">
                                <?php echo $room['room_type']; ?> - Current Price: <?php echo $room['price']; ?> BGN
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="price">New Price</label>
                    <input type="number" name="price" class="form-control" placeholder="Enter new price" required>
                </div>
                <button type="submit" class="btn btn-warning btn-custom">Update Price</button>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>