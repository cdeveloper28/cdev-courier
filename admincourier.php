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

    // Handle image upload
    if (isset($_FILES['image'])) {
        $image_name = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];
        $upload_dir = "uploads/";
        $image_url = $upload_dir . basename($image_name);

        // Validate file type and size
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif', 'image/jpg'];
        $max_size = 5 * 1024 * 1024; // 5MB

        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        if (in_array($_FILES['image']['type'], $allowed_types) && $_FILES['image']['size'] <= $max_size) {
            if (move_uploaded_file($image_tmp, $image_url)) {
                // Insert into database
                $query = "INSERT INTO parcels (tracking_id, sender_name, sender_address, sender_country, 
                          recipient_name, recipient_address, recipient_country, parcel_name, parcel_details, 
                          current_status, location, image_url) 
                          VALUES ('$tracking_id', '$sender_name', '$sender_address', '$sender_country', 
                          '$recipient_name', '$recipient_address', '$recipient_country', '$parcel_name', 
                          '$parcel_details', '$current_status', '$location', '$image_url')";
                if (mysqli_query($conn, $query)) {
                    echo "Tracking ID created successfully.";
                } else {
                    echo "Error: " . mysqli_error($conn);
                }
            } else {
                echo "Failed to upload image.";
            }
        } else {
            echo "Invalid file type or size. Only JPEG, PNG, and GIF files under 5MB are allowed.";
        }
    } else {
        echo "No image file uploaded.";
    }
}
?>