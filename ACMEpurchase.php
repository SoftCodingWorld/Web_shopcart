<?php session_start();
// array of inventory data
$inventory = array(
    array("mandolin", 225, 460),
    array("classical guitar", 568, 1200),
    array("acoustic guitar", 365, 750),
    array("kazoo", 3.25, 6.8),
    array("djembe", 123, 250),
    array("sitar", 378, 810),
    array("bamboo flute", 15, 48)
);

//initial the session
if ( !isset($_SESSION["invoiceTotal"]) ) 
{
    $invoiceTotal = 0;
    $_SESSION["invoiceTotal"] = 0;
    for ($i=0; $i < count($inventory); $i++) {
    $_SESSION["retail"][$i] = 0;
    $_SESSION["discount"][$i] = 0;
    $_SESSION["total"][$i] = 0;
   }
}


$submitNum = 0;
 //---------------------------
 //Add, adds an item to the sessions when the ‘Add to Cart’ link is clicked:
 if ( isset($_GET["submit"]) )
{   
    $item = $_GET['item'] ;
    $price = $_GET['retail'];
    $discount = $_GET['discount'] ;
    $total = $_GET['total'];
    $message = "The discount is too high!";
    $noitemmsg = "Cannot find the item!";
    for ( $i=0; $i< count($inventory); $i++ )
    {
        if ( $inventory[$i][0] == $item )
        {
            $realcost = ( $inventory[$i][1] * 0.5 );
            if ( ($realcost <=> $total) === 1 ) {
                echo "<script type='text/javascript'>alert('$message');</script>";
            } 
            else {
                // count the number of valid request
                if(isset($_SESSION['cart'])){
                    $submitNum = count($_SESSION['cart']);
                }
                //store the attributes of each form submission
                $_SESSION["item"][$submitNum] = $item;
                $_SESSION["retail"][$submitNum] = $price;
                $_SESSION["discount"][$submitNum] = $discount;
                $_SESSION["total"][$submitNum] = $total;
                $_SESSION["cart"][$submitNum] = $submitNum;
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Your name here">
    <link rel="stylesheet" href="ACMEpurchase.css">
    <title>ACME Customer Care Portal</title>
    <script src="ACMEpurchase.js" defer></script>
</head>
<body>
<?php include "reset.php"; ?>
    <header>
        <h1>ACME Corporation</h1>
        <div class="tagline">yes we deliver!</div>
    </header>

    <main>
 <!-- create the table of customre Invoice data -->
 <br/><br/><br/>
 <h2>Customer Invoice</h2>
 <table class="invoice">
 <tr>
 <th class="invoiceheader">Item</th>
 <th class="invoiceheader">Retail Cost</th>
 <th class="invoiceheader">Discount</th>
 <th class="invoiceheader">Total</th>
 </tr>
 <hr>
<?php
$invoiceTotal = 0;
if ( isset($_SESSION["cart"]) ) 
{

// $invoiceTotal = 0;
foreach ( $_SESSION["cart"] as $i ) {
?>
<tr>
    <td class="centered"><?php echo( $_SESSION["item"][$i] ); ?></td>
    <td class="centered"><?php echo( $_SESSION["retail"][$i] ); ?></td>
    <td class="centered"><?php echo( $_SESSION["discount"][$i] ); ?></td>
    <td class="centered"><?php echo( $_SESSION["total"][$i] ); ?></td>
</tr>
<!-- calculate the total price of items in the cart -->
<?php
    $invoiceTotal = $invoiceTotal + $_SESSION['total'][$i];
}
$_SESSION["invoiceTotal"] = $invoiceTotal;

}
?>
<tr class="totalline">
<td colspan="3">Invoice total: </td>
 <td class="centered"><?php echo ("$".$invoiceTotal); ?></td>
 </tr>
 </table> 
 <?php
 $mycart = isset($_SESSION['cart']) ? $_SESSION['cart'] : '';
 $disabled = ($mycart == '') ? 'disabled' : '';
 ?>
 <!-- set the status of the purchase button -->
        <div id="purchase">
            <button id="submitorder" <?php echo $disabled; ?> onclick="window.location.assign('ACMEpurchases.php?reset=true');">Purchase</button>
        </div>

        <hr>
        <form action="ACMEpurchases.php" method="get" onsubmit="return validateForm()">
            <fieldset class="additem">
                <legend>Add Item to Order</legend>
                <select id="newitem" name="optionlist" onchange="getOption(this)">
                <option value="" selected="selected">Please Choose</option>
                <!-- make a list of options using PHP and the given array of musical instruments -->
                <?php
                    $arrlength = count($inventory);
                    for($i = 0; $i < $arrlength; $i++) {
                ?>
                    <option><?php echo $inventory[$i][0] ?></option>
                <?php
                    }
                    ?>
                </select>
                <!-- the table of attributes of items -->
                <div class="itemdetails">
                    <label for="item">Item:</label>
                    <input type="text" name="item" id="item" disabled>
                </div>
                <div class="itemdetails">    
                    <label for="retail">Price:</label>
                    <input type="text" name="retail" id="retail" disabled>
                    <label for="discount">Discount:</label>
                    <input type="text" name="discount" id="discount">
                    <label for="total">Total:</label>
                    <input type="text" name="total" id="total" disabled>
                </div>

                <div class="purchase">
                    <button type="submit" name="submit">Add to Invoice</a></button>
                </div>

                <p class="centered">
                    Attention, all discounts will be verified by our software.
                </p>

            </fieldset>
        </form>
        
        <script>
        </script>
        <footer>ACME Coporation for all that you can scheme up!</footer>

    </main>
</body>
</html>
