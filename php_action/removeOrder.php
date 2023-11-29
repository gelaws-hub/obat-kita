<?php

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

$orderId = isset($_POST['orderId']) ? $_POST['orderId'] : (isset($_GET['id']) ? $_GET['id'] : null);

if ($orderId) {
	// Update the orders table using the correct column name 'delete_status'
	$sql = "UPDATE orders SET delete_status = 2 WHERE id = {$orderId}";

	// Update the order_item table based on the relationship with 'id' in orders table
	$orderItem = "UPDATE order_item SET delete_status = 2 WHERE lastid = {$orderId}";

	if ($connect->query($sql) === TRUE && $connect->query($orderItem) === TRUE) {
		$valid['success'] = true;
		$valid['messages'] = "Successfully Removed";
		header('location:../Order.php');
	} else {
		$valid['success'] = false;
		$valid['messages'] = "Error while removing the brand";
	}

	$connect->close();

	echo json_encode($valid);
}
