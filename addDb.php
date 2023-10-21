<?php
    $menu_name = $_POST['menu_name'];
    $menu_desc = $_POST['menu_desc'];
    $price = $_POST['price'];

    $conn = new mysqli('localhost','root','','pointofsale');

    if($conn->connect_error){
        http_response_code(500);
        echo json_encode(['status' => 'error', 'message' => $conn->connect_error]);
        die();
    } else {
        $stmt = $conn->prepare("insert into ref_menu(menu_name, menu_desc, price) values(?, ?, ?)");
        $stmt->bind_param("sss", $menu_name, $menu_desc, $price);
        $execval = $stmt->execute();
        
        if($execval){
            http_response_code(200); 
            echo json_encode(['status' => 'success', 'message' => 'Registration successfully...']);
        } else {
            http_response_code(500); 
            echo json_encode(['status' => 'error', 'message' => 'Registration failed...']);
        }
        $stmt->close();
        $conn->close();
    }
?>
