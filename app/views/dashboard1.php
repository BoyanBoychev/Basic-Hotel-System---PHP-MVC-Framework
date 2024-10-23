<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(to right, #4facfe, #00f2fe);
            padding: 20px;
        }

        .dashboard-card {
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
            background-color: white;
        }

        .filter-section {
            margin-bottom: 20px;
        }

        .list-group-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .badge-success {
            background-color: #28a745;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="dashboard-card">
            <h1 class="text-center">Welcome to Your Dashboard</h1>

            <!-- Search and Filter Form -->
            <form method="get" action="/hotel-reservation/public/index.php/dashboard1" class="filter-section">
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="minPrice">Min Price</label>
                        <input type="number" name="minPrice" class="form-control" placeholder="Enter minimum price" value="<?php echo htmlspecialchars($_GET['minPrice'] ?? ''); ?>" />
                    </div>

                    <div class="form-group col-md-4">
                        <label for="maxPrice">Max Price</label>
                        <input type="number" name="maxPrice" class="form-control" placeholder="Enter maximum price" value="<?php echo htmlspecialchars($_GET['maxPrice'] ?? ''); ?>" />
                    </div>

                    <div class="form-group col-md-4">
                        <label for="roomType">Room Type</label>
                        <select name="roomType" class="form-control">
                            <option value="">All</option>
                            <option value="Single Room" <?php echo (isset($_GET['roomType']) && $_GET['roomType'] === 'Single Room') ? 'selected' : ''; ?>>Single Room</option>
                            <option value="Double Room" <?php echo (isset($_GET['roomType']) && $_GET['roomType'] === 'Double Room') ? 'selected' : ''; ?>>Double Room</option>
                            <option value="Family Room" <?php echo (isset($_GET['roomType']) && $_GET['roomType'] === 'Family Room') ? 'selected' : ''; ?>>Family Room</option>
                            <option value="Suite" <?php echo (isset($_GET['roomType']) && $_GET['roomType'] === 'Suite') ? 'selected' : ''; ?>>Suite</option>
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Filter</button>
            </form>

            <h2>Available Rooms</h2>
            <?php if (isset($rooms) && count($rooms) > 0): ?>
                <ul class="list-group">
                    <?php foreach ($rooms as $room): ?>
                        <li class="list-group-item">
                            Room <?php echo $room['id']; ?> - <?php echo $room['room_type']; ?> - <?php echo $room['price']; ?> BGN
                            <form method="post" action="/hotel-reservation/public/index.php/reserve" class="d-inline">
                                <input type="hidden" name="room_id" value="<?php echo $room['id']; ?>">
                                <button type="submit" class="btn btn-success btn-sm">Reserve</button>
                            </form>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>No rooms available at the moment.</p>
            <?php endif; ?>

            <h2>Your Reservations</h2>
            <?php if (isset($reservations) && count($reservations) > 0): ?>
                <ul class="list-group">
                    <?php foreach ($reservations as $reservation): ?>
                        <li class="list-group-item">
                            Room <?php echo $reservation['id']; ?> - <?php echo $reservation['room_type']; ?> - <?php echo $reservation['price']; ?> BGN
                            <span class="badge badge-success">Reserved</span>
                            <form method="post" action="/hotel-reservation/public/index.php/deleteReservation" class="d-inline float-right ml-2">
                                <input type="hidden" name="room_id" value="<?php echo $reservation['id']; ?>">
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>You have no reservations.</p>
            <?php endif; ?>

            <a href="/hotel-reservation/public/index.php/logout" class="btn btn-danger mt-3">Logout</a>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>