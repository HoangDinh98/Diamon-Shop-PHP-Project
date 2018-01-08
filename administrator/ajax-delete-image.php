<?php
include './include.php';

$image_id = $_POST['image_id'];
$status = mysqli_query($connect, "UPDATE images SET is_active = 0 WHERE id = $image_id");

header('Content-Type: application/json');
echo json_encode(array(
    'success' => $status,
));
?>
