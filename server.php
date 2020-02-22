<?php 
include 'class/db.php'; 
if (isset($_POST['done'])) {
	
	$name = $_POST['name'];
	$email = $_POST['email'];
	$mobile = $_POST['mobile'];
	$amount = $_POST['amount'];
	$ref = $_POST['ref'];

	// 	$name = 'sajdad' ;
	// $email = 'asda';
	// $mobile = 'e';
	// $amount = 't';
	// $ref = 'hj';
	$pay = new AddTransaction($name, $email, $mobile, $amount, $ref);
	echo $pay->addPay();
	// $sql = "INSERT INTO transactions (name, email, mobile, amount, ref) VALUES (?, ?, ?, ?, ?)";
	// $query = $db->prepare($sql);
	// $query->execute([$name, $email, $mobile, $amount, $ref]);
	// if ($query) {
	// 	echo "Inserted sucessfully";
	// }else {
	// 	echo "error inserting";
	// }

}
?>