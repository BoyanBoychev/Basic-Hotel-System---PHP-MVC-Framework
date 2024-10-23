<?php include 'layout.php'; ?>

<h1>Room <?php echo $room['id']; ?> Details</h1>
<ul class="list-group">
    <li class="list-group-item">Room Type: <?php echo $room['room_type']; ?></li>
    <li class="list-group-item">Price: <?php echo $room['price']; ?> BGN</li>
    <li class="list-group-item">Available: <?php echo $room['is_reserved'] ? 'No' : 'Yes'; ?></li>
</ul>
<a href="/dashboard" class="btn btn-primary mt-3">Back to Rooms</a>