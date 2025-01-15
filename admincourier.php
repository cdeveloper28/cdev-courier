<?php
include 'db_connect.php';

// Ensure $conn is defined and valid
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tracking_id = $_POST['tracking_id'];
    $sender_name = $_POST['sender_name'];
    $sender_address = $_POST['sender_address'];
    $sender_country = $_POST['sender_country'];
    $recipient_name = $_POST['recipient_name'];
    $recipient_address = $_POST['recipient_address'];
    $recipient_country = $_POST['recipient_country'];
    $parcel_name = $_POST['parcel_name'];
    $parcel_details = $_POST['parcel_details'];
    $current_status = $_POST['current_status'];
    $location = $_POST['location'];

    // Insert into database
    $query = "INSERT INTO parcels (tracking_id, sender_name, sender_address, sender_country, 
              recipient_name, recipient_address, recipient_country, parcel_name, parcel_details, 
              current_status, location) 
              VALUES ('$tracking_id', '$sender_name', '$sender_address', '$sender_country', 
              '$recipient_name', '$recipient_address', '$recipient_country', '$parcel_name', 
              '$parcel_details', '$current_status', '$location')";
    if (mysqli_query($conn, $query)) {
        echo "Tracking ID created successfully.";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>