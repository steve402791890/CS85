<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
   <head>
      <title>car</title>
   </head>
   <body> 
      <?php
           
          class Car
               {
               private $year;        
               private $make;        
               private $model;    
               private $paint;
               private $driver;
        
               public function __construct($y, $mk, $md, $p, $d) 
               {
                       $this->year = $y;
                       $this->make = $mk;
                       $this->model = $md;
                       $this->setPaint($p);
                       $this->setDriver($d);
               }
               public function getYear()   
               {
                       return $this->year;
               }
               
               public function getMake()    
               {
                       return $this->make;
               }
               
               public function getModel()  
               {
                       return $this->model;
               }
               
               public function getPaint()
               {
                       return $this->paint;
               }
               public function setPaint($new_color)
               {
                       $this->paint = $new_color;
               }
               
               public function getDriver()
               {
                       return $this->driver;
               }
               public function setDriver($new_driver)
               {
                       $this->driver = $new_driver;
               }
               public function state() 
               {
                       return $this->getDriver()." drives a ".$this->getPaint()." ".$this->getYear()." ".$this->getMake()." ".$this->getModel().".";
               }
              }
              
              
              
              

          $car = array();
          $car[] = new Car("2007", "Toyata", "Solara", "absolute red", "Jeannie");
          $car[] = new Car("1966", "Chevrolet", "Corvette", "burnt orange", "Bill");
          $car[] = new Car("1966", "Jaguar", "XKE", "pearl essence green", "Ken");
          

          for ($i = 0; $i < count($car); $i++) {
              print $car[$i]->state()."<br>";
              }
      ?>
   </body>
</html> 