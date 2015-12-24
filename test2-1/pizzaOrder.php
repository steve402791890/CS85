<?php session_start() 
    
?>
 
    
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
   <head>
      <title>Test 2</title>
      <style>
		body {
			background-color:lightgreen;
		}
		.center {
			 border-collapse: separate;
			 border-style: double;
		     padding:0px;
		     font-weight:bold;
		     border-width: 2px;
		}
      </style>
   </head>
   <body> 
      <?php
        
        global $pizzaPrices, $selPizza, $selSize;
        
        function setPizzaArray() {    
            global $pizzaPrices;
            $pizzaPrices = array("Plain" => array("Small"=>"3.50", 
                                                "Medium"=>"6.25",
                                                "Large"=>"8.00"
                                                ),
                                "Vegetarian" => array("Small"=>"4.35", 
                                                "Medium"=>"7.60",
                                                "Large"=>"12.00"
                                                ),
                                "Pepperoni" => array("Small"=>"7.25", 
                                                "Medium"=>"10.75",
                                                "Large"=>"14.00"
                                                ),
                                "Hawaiian" => array("Small"=>"8.00", 
                                                "Medium"=>"12.50",
                                                "Large"=>"15.50"
                                                )
            );
            
            }

        function displayMenu() {    
            global $pizzaPrices;
            
            print "<table class='center'>
                    <tr><th class='center'></th><th class='center'>Small</th><th class='center'>Medium</th><th class='center'>Large</th></tr>";
            foreach ($pizzaPrices as $zaType => $prices) {
                print "<tr><td class='center'>$zaType</td><td class='center'>".$pizzaPrices[$zaType]["Small"]."</td><td class='center'>".$pizzaPrices[$zaType]["Medium"]."</td><td class='center'>".$pizzaPrices[$zaType]["Large"]."</td></tr>";
                }
            print "</table>";    
            }
            
        function createSelects() {   
            global $selPizza, $selSize, $pizzaPrices;    
            
                
            $selPizza = "<select  name='type' >";
            foreach($pizzaPrices as $zaType => $prices) {
                $selPizza .= "<option value='".$zaType."' >".$zaType."</option>";
                }
            $selPizza .= "</select>";

            $selSize = "<select  name='size' >
                            <option value='Small'>Small</option>
                            <option value='Medium'>Medium</option>
                            <option value='Large'>Large</option>
                        </select>";
            }
        
        function printOrderForm() {   
            global $selPizza, $selSize;
            
            createSelects();
            ECHO <<<HERE
                <form id='myform' method='POST' >
                <h1>Order your pizza NOW!!</br>
                Pizza Type: $selPizza</br>
                Pizza Size: $selSize</br>
                <h1><button type='submit'>Order</button></h1>
                </form>
HERE;
            }
        
        function displayReceipt() {
            global $type, $size, $pizzaPrices;
            
            $price = $pizzaPrices[$type][$size];
            $tax = 0.0975 * (float) $price;
            $total = (float) $price + (float) $tax;
            
            $output = "<h1 >Thank you. Here is your receipt.</h1>
                <table class='center'>
                  <tr><td>
                    <table>
                    <tr><td class='center'>Kind of pizza</td><td class='center'>$type</td></tr>
                    <tr><td class='center'>Size</td><td class='center'>$size</td></tr>
                    <tr><td class='center'>Price</td><td class='center'>$ ".number_format($price, 2, '.', ',' )."</td></tr>
                    <tr><td class='center'>Tax</td><td class='center'>$ ".number_format($tax, 2, '.', ',' )."</td></tr>
                    <tr><td class='center'>Total</td><td class='center'>$ ".number_format($total, 2, '.', ',' )."</td></tr>
                    </table>
                  </td></tr>
                </table></br>
                <form id='myform' method='POST' >
                <h1><button type='submit' name='done'>Click to Pay Bill</button></h1>
                </form>";
                
            print $output;
            }
            
            
        if ( !isset($_SESSION["placeAnOrder"] ) ) {    
        
                $placeAnOrder = true;                    
                $_SESSION["placeAnOrder"] = $placeAnOrder;
                
                setPizzaArray();                        
                $_SESSION["pizzaPrices"] = $pizzaPrices;
                displayMenu();                           
                printOrderForm();                       
            
            } else if ( $_SESSION["placeAnOrder"] ) {     

                global $type, $size;
                $pizzaPrices = $_SESSION["pizzaPrices"];    
                $type = $_REQUEST["type"];                    
                $size = $_REQUEST["size"];
                
                displayReceipt();                        
                
                $placeAnOrder = false;                    
                $_SESSION["placeAnOrder"] = $placeAnOrder;                
                
            } else {                                     
            
                ECHO <<<HERE
                <h1>Thank you for your order!!</h1>
                <h3>Please refresh to continue.</h3>
HERE;

                session_destroy();                         
                
            }
        
      ?>


   </body>
</html>  