<?php
//session_start();

//Reset, reset and clear the sessions when the Reset Cart link is selected.
if ( isset($_GET['reset']) )
{
if ($_GET["reset"] == 'true')
  {
  unset($_SESSION["retail"]); //The quantity for each product
  unset($_SESSION["discount"]); //The amount from each product
  unset($_SESSION["total"]); //The total cost
  unset($_SESSION["invoiceTotal"]);
  unset($_SESSION["cart"]); //Which item has been chosen
  }
  echo "<script type='text/javascript'>alert('Thank you for your purchase');</script>";
}

?>