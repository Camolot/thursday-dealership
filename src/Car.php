<?php
  class Car
  {
    private $make_model;
    private $price;
    private $miles;
    private $image;
    function __construct($car_model = "Unknown Model", $car_price = 100000, $car_miles = 5000, $image_path="img/default.jpg")
    {
      $this->make_model = $car_model;
      $this->price = $car_price;
      $this->miles = $car_miles;
      $this->image = $image_path;
    }
    function setModel($car_model)
    {
      $this->make_model = $car_model;
    }
    function setPrice($car_price)
    {
      $this->price = $car_price;
    }
    function setMiles($car_miles)
    {
      $this->miles = $car_miles;
    }
    function setImage($image_path)
    {
      $this->image = $image_path;
    }
    function getModel()
    {
      return $this->make_model;
    }
    function getPrice()
    {
     return $this->price;
    }
    function getMiles()
    {
      return $this->miles;
    }
    function getImage()
    {
      return $this->image;
    }
  }
/*
  $cars_matching_search = array();
  foreach ($cars as $car) {
    if ( ($car->getPrice() <= $_GET["price"]) && ($car->getMiles() <= $_GET["mileage"]) ) {
      array_push($cars_matching_search, $car);
    }
  }
*/

?>
