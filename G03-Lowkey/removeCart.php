<?php
	session_start();

	if (isset($_POST['remove'])) 
	{
		$key = array_search($_GET['removeID'],$_SESSION['cart']);
		if($key !== false)
		{
			unset($_SESSION['cart'][$key]);
			$_SESSION["cart"] = array_values($_SESSION["cart"]);
			$_SESSION['message'] = "Product deleted from cart";
			header('location: shoppingCart.php');
		}
	} 
?>