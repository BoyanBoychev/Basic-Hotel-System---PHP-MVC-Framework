<?php

class RoomController extends Controller
{
    public function dashboard1()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Ensure user is logged in
        if (!isset($_SESSION['user_id'])) {
            header("Location: /hotel-reservation/public/index.php/login");
            exit();
        }


        // Fetch available rooms
        $roomModel = new RoomModel();
        $rooms = $roomModel->getAvailableRooms();

        // Fetch user reservations
        $user_id = $_SESSION['user_id'];
        $userReservations = $roomModel->getUserReservations($user_id);

        // Handle search/filter input
        $searchTerm = $_GET['search'] ?? '';
        $priceRange = isset($_GET['minPrice']) && isset($_GET['maxPrice']) ? [$_GET['minPrice'], $_GET['maxPrice']] : null;
        $roomType = $_GET['roomType'] ?? null;

        // Fetch available rooms based on search/filter
        $rooms = $roomModel->searchRooms($searchTerm, $priceRange, $roomType);

        // Render the dashboard1 view with room data and user reservations
        View::render('dashboard1', ['rooms' => $rooms, 'reservations' => $userReservations]);
    }
    // Method to display room details
    public function details($id)
    {
        // Get the room details from the database
        $roomModel = new RoomModel();
        $room = $roomModel->getRoomDetails($id);

        // Render the 'room_details' view with the room data
        View::render('room_details', ['room' => $room]);
    }

    // Method to reserve a room
    public function reserve()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $room_id = $_POST['room_id'] ?? null;
        $user_id = $_SESSION['user_id'] ?? null;

        if (!$room_id || !$user_id) {
            echo "Error: Invalid room or user.";
            return;
        }

        // Reserve the room
        $roomModel = new RoomModel();
        $success = $roomModel->reserveRoom($room_id, $user_id);

        if ($success) {
            header("Location: /hotel-reservation/public/index.php/dashboard1");
            exit();
        } else {
            echo "Error: Room could not be reserved, it might already be reserved.";
        }
    }

    //Method to delete reservation
    public function deleteReservation()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $room_id = $_POST['room_id'] ?? null;
        $user_id = $_SESSION['user_id'] ?? null;

        if (!$room_id || !$user_id) {
            echo "Error: Invalid room or user.";
            return;
        }

        // Call the model to delete the reservation
        $roomModel = new RoomModel();
        $success = $roomModel->deleteReservation($room_id, $user_id);

        if ($success) {
            header("Location: /hotel-reservation/public/index.php/dashboard1");
            exit();
        } else {
            echo "Error: Could not delete reservation.";
        }
    }
}
