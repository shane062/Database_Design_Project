<?php
	session_start();

	if(!isset($_SESSION['cart'])){
		$_SESSION['cart'] = array();
	}
	//unset qunatity
	unset($_SESSION['qty_array']);
	//check if product is already in the cart
	if(!in_array($_GET['addID'], $_SESSION['cart']))
	{
		array_push($_SESSION['cart'], $_GET['addID']);
		$_SESSION['message'] = 'Product is successfully added to cart.';
	}
	else
	{
		$_SESSION['message'] = 'Product is already in cart.';
	}

	header("Location:productList.php");
?>