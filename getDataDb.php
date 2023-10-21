<?php
header('Content-Type: application/json');

$server = "localhost";
$username = "root";
$password = "";
$database = "pointofsale";

$conn = new mysqli($server, $username, $password, $database);

if ($conn->connect_error) {
    echo json_encode(['status' => 'error', 'message' => 'Unable to connect to the database.']);
    exit;
}

if(isset($_GET['id']) && $_GET['id'] != '') {
    $id = $_GET['id'];

    $sql = "SELECT * FROM ref_menu WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    $result = $stmt->get_result();
    $menu = $result->fetch_assoc();

    if($menu) {
        echo json_encode($menu);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'No data found for provided ID.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid ID.']);
}

$conn->close();
?>
