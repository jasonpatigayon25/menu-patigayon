<?php
	$menu_name = $_POST['menu_name'];
	$menu_desc = $_POST['menu_desc'];
	$price = $_POST['price'];


	$conn = new mysqli('localhost','root','','pointofsale');
	if($conn->connect_error){
		echo "$conn->connect_error";
		die("Connection Failed : ". $conn->connect_error);
	} else {
		$stmt = $conn->prepare("insert into ref_menu(menu_name, menu_desc, price) values(?, ?, ?)");
		$stmt->bind_param("sss", $menu_name, $menu_desc, $price);
		$execval = $stmt->execute();
		echo $execval;
		echo "Registration successfully...";
		$stmt->close();
		$conn->close();
	}
?>