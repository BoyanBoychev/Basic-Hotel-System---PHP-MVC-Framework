<?php

class RoomModel
{
    protected $pdo;

    // Constructor to initialize the PDO connection to the database
    public function __construct()
    {
        // Create a new PDO instance, connecting to the 'hotel' database
        $this->pdo = new PDO('mysql:host=localhost;dbname=hotel', 'root', '');
    }

    // Method to retrieve all available (not reserved) rooms
    public function getAvailableRooms()
    {
        $stmt = $this->pdo->query("SELECT * FROM rooms WHERE is_reserved = 0");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Method to reserve a room for a user
    public function reserveRoom($room_id, $user_id)
    {
        $stmt = $this->pdo->prepare("UPDATE rooms SET is_reserved = 1, reserved_by = :user_id WHERE id = :room_id AND is_reserved = 0");
        return $stmt->execute(['user_id' => $user_id, 'room_id' => $room_id]);
    }

    // Method to retrieve all reservations made by a specific user
    public function getUserReservations($user_id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM rooms WHERE reserved_by = :user_id");
        $stmt->execute(['user_id' => $user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Method to search for rooms based on search criteria
    public function searchRooms($searchTerm, $priceRange = null, $roomType = null)
    {
        $query = "SELECT * FROM rooms WHERE is_reserved = 0";

        $conditions = [];
        $params = [];

        if ($searchTerm) {
            $conditions[] = "room_type LIKE :searchTerm";
            $params['searchTerm'] = "%$searchTerm%";
        }

        if ($priceRange) {
            $conditions[] = "price BETWEEN :minPrice AND :maxPrice";
            $params['minPrice'] = $priceRange[0];
            $params['maxPrice'] = $priceRange[1];
        }

        if ($roomType) {
            $conditions[] = "room_type = :roomType";
            $params['roomType'] = $roomType;
        }

        if (count($conditions) > 0) {
            $query .= " AND " . implode(" AND ", $conditions);
        }

        $stmt = $this->pdo->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Method to get details of a specific room by ID
    public function getRoomDetails($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM rooms WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Method to delete a reservation for a specific room by user
    public function deleteReservation($room_id, $user_id)
    {
        $stmt = $this->pdo->prepare("UPDATE rooms SET is_reserved = 0, reserved_by = NULL WHERE id = :room_id AND reserved_by = :user_id");
        return $stmt->execute(['room_id' => $room_id, 'user_id' => $user_id]);
    }

    // Method to create a new room - for admin
    public function createRoom($roomType, $price)
    {
        $stmt = $this->pdo->prepare("INSERT INTO rooms (room_type, price) VALUES (:room_type, :price)");
        return $stmt->execute(['room_type' => $roomType, 'price' => $price]);
    }

    // Method to update the price of a specific room - for admin
    public function updateRoomPrice($roomId, $newPrice)
    {
        $stmt = $this->pdo->prepare("UPDATE rooms SET price = :price WHERE id = :roomId");
        return $stmt->execute(['price' => $newPrice, 'roomId' => $roomId]);
    }


    // Method to get all reservations in the system - for admin
    public function getAllReservations()
    {
        $stmt = $this->pdo->query("SELECT * FROM rooms WHERE reserved_by IS NOT NULL");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Method to get all rooms in the system    
    public function getAllRooms()
    {
        $stmt = $this->pdo->query("SELECT * FROM rooms");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Method to fetch all room types
    public function getRoomTypes()
    {
        $stmt = $this->pdo->query("SELECT DISTINCT room_type FROM rooms");
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }
}
