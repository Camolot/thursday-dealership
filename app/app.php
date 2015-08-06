<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Car.php";

    session_start();
    if (empty($_SESSION['list_of_cars'])) {
        $_SESSION['list_of_cars'] = array();
    }

    $app = new Silex\Application();

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'));


    $app->get("/", function() use ($app) {

        return $app['twig']->render('home.html.twig');

    });

    $app->get("/car_search", function() use ($app) {
        return $app['twig']->render('cars.html.twig');
    });


    $app->get("/car_results", function() use ($app) {


        $cars = array();
        $cars_matching_search = array();
        foreach ($cars as $car) {
            if ( ($car->getPrice() <= $_GET["price"]) && ($car->getMiles() <= $_GET["mileage"]) ) {
                array_push($cars_matching_search, $car);
            }
        }

        return $app['twig']->render('matching_car.html.twig', array('cars' => $cars_matching_search));
    });

    $app->get("/car_add", function() use ($app) {
        return $app['twig']->render('creating_car.html.twig');
    });



    return $app;

 ?>
