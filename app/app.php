<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Car.php";

    $app = new Silex\Application();

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'));


    $app->get("/", function() use ($app) {

        return $app['twig']->render('cars.html.twig');

    });

    $app->get("/car_search", function() use ($app) {
        $porsche = new Car("2014 Porsche 911", 118795, 76453, "img/porsche");
        $ford = new Car("2011 Ford F450", 584736, 7364, "img/ford.jpg");
        $camaro = new Car("1967 Camaro", 56477, 4, "img/camaro.jpg");
        $random = new Car();
        $cars = array($porsche, $ford, $camaro, $random);

        $cars_matching_search = array();
        foreach ($cars as $car) {
            if ( ($car->getPrice() <= $_GET["price"]) && ($car->getMiles() <= $_GET["mileage"]) ) {
                array_push($cars_matching_search, $car);
            }
        }
        $person = 'Will Swanson';
        return $app['twig']->render('matching_car.html.twig', array('cars' => $cars_matching_search, 'my_best_friend' => $person));
    });
    return $app;

 ?>
