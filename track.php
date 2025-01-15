<?php
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tracking_id = $_POST['tracking_id'];

    $query = "SELECT * FROM parcels WHERE tracking_id = '$tracking_id'";
    $result = mysqli_query($conn, $query);

    if ($row = mysqli_fetch_assoc($result)) {
        echo "<h2>Tracking Details</h2>";
        echo "Sender: " . $row['sender_name'] . "<br>";
        echo "Sender Address: " . $row['sender_address'] . "<br>";
        echo "Sender Country: " . $row['sender_country'] . "<br>";
        echo "Recipient: " . $row['recipient_name'] . "<br>";
        echo "Recipient Address: " . $row['recipient_address'] . "<br>";
        echo "Recipient Country: " . $row['recipient_country'] . "<br>";
        echo "Parcel Name: " . $row['parcel_name'] . "<br>";
        echo "Parcel Details: " . $row['parcel_details'] . "<br>";
        echo "Status: " . $row['current_status'] . "<br>";
        echo "Location: " . $row['location'] . "<br>";

        if (!empty($row['image_url'])) {
            echo "<img src='" . $row['image_url'] . "' alt='Parcel Image' class='parcel-image'><br>";
        }
    } else {
        echo "<h2>Tracking Details</h2>";
        echo "<p style='color: red;'>Sorry, we could not find any parcel with the provided tracking ID. Please check the ID and try again.</p>";
    }
}
?>
