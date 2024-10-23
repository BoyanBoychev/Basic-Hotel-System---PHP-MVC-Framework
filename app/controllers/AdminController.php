<?php

class AdminController extends Controller
{
    public function index()
    {
        View::render('admin/index');
    }

    public function createRoom()
    {
        $roomModel = new RoomModel();
        $roomTypes = $roomModel->getRoomTypes(); // Fetch room types

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Handle form submission to create a new room
            $roomType = $_POST['room_type'];
            $price = $_POST['price'];

            // Insert the new room into the database
            $roomModel->createRoom($roomType, $price);

            // Redirect back to the admin dashboard
            header("Location: /hotel-reservation/public/index.php/admin");
            exit();
        }

        // Load the view for creating a room and pass room types
        View::render('admin/createRoom', ['roomTypes' => $roomTypes]);
    }


    public function editRoom()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Handle form submission to update room prices
            $roomModel = new RoomModel();
            $roomId = $_POST['room_id'];
            $newPrice = $_POST['price'];

            // Update the room price in the database
            $roomModel->updateRoomPrice($roomId, $newPrice);

            header("Location: /hotel-reservation/public/index.php/admin");
            exit();
        }

        $roomModel = new RoomModel();
        $rooms = $roomModel->getAllRooms();
        View::render('admin/editRoom', ['rooms' => $rooms]);
    }

    public function viewReservations()
    {
        $roomModel = new RoomModel();
        $reservations = $roomModel->getAllReservations(); // Method to fetch all reservations
        View::render('admin/viewReservations', ['reservations' => $reservations]);
    }
}
