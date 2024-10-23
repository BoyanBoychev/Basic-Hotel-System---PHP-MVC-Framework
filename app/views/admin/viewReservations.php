<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Reservations</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(to right, #343a40, #495057);
            color: white;
            padding: 20px;
        }

        .reservations-card {
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
            background-color: #212529;
        }

        .no-reservations {
            text-align: center;
            margin-top: 20px;
        }

        .list-group-item {
            color: black;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="reservations-card">
            <h1 class="text-center">All Reservations</h1>
            <?php if (count($reservations) > 0): ?>
                <ul class="list-group mt-4">
                    <?php foreach ($reservations as $reservation): ?>
                        <li class="list-group-item">
                            Room <?php echo $reservation['id']; ?> - Reserved by User ID: <?php echo $reservation['reserved_by']; ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p class="no-reservations">No reservations found.</p>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>