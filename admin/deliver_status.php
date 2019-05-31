<?php
ob_start();
require('../connection.php');
require('../date.php');
require('session.php');

$ordersid = $_GET['ordersid'];

$orders_total = $conn->query("SELECT * FROM orders_total WHERE OrdersID='$ordersid'");
$row = $orders_total->fetch_assoc();



$billing_detail = $conn->query("SELECT * FROM billing_detail WHERE OrdersID='$ordersid'");
$row2 = $billing_detail->fetch_assoc();



if($row['DeliveryStatus'] == 'Delivered') {
	$orderstatus = 'For Delivery';
}

if($row['DeliveryStatus'] == 'Partially Delivered') {
	$orderstatus = 'Partially For Delivery';
}

$update = $conn->query("UPDATE orders_total SET OrderStatus='$orderstatus'
		WHERE OrdersID='$ordersid'");


$customername = $row2['CustomerName'];
$contactnumber = $row2['Mobile'];
$address = $row2['CompleteAddress'];
$email = $row2['Email'];

//SMS		
$msg = "Hi, this is LGPVILLE.
	We would like to inform you that your orders is confirmed and prepared. See below the details:

	Order Status: $orderstatus
	Delivery Date: $da
	Name : $customername
	Contact #: +$contactnumber
	Address : $address
	Email : $email
    ";
	

	
	$randomString = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 25);
	$arr_post_body = array(
        "message_type" => "SEND",
        "mobile_number" => $row2['Mobile'],
        "shortcode" => "292901530",
        "message_id" => $randomString,
        "message" => $msg,
        "client_id" => "35b12e9975e78a03cd6690b986a9c41d8c1a85fe9a432b6d8f530af9d09de51d",
        "secret_key" => "47e05e68d069e47d37570583be1a83a61044b55ab123b558103856cd668dbf52"
    );

    $query_string = "";
    foreach($arr_post_body as $key => $frow)
    {
        $query_string .= '&'.$key.'='.$frow;
    }

    $URL = "https://post.chikka.com/smsapi/request";

    $curl_handler = curl_init();
    curl_setopt($curl_handler, CURLOPT_URL, $URL);
    curl_setopt($curl_handler, CURLOPT_POST, count($arr_post_body));
    curl_setopt($curl_handler, CURLOPT_POSTFIELDS, $query_string);
    curl_setopt($curl_handler, CURLOPT_RETURNTRANSFER, TRUE);
    $response = curl_exec($curl_handler);
    curl_close($curl_handler);

  
	




echo '<script>
        window.alert("Successfully send.");
        window.location.href="deliverorder.php?ordersid=' .$ordersid. '";
        </script>';

ob_end_flush();
?>