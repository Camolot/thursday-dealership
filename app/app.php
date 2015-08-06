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

        return $app['twig']->render('home.html.twig', array('cars' => Car::getAll()));

    });

    $app->get("/car_search", function() use ($app) {
        return $app['twig']->render('cars.html.twig');
    });


    $app->get("/car_results", function() use ($app) {


        $cars = $_SESSION['list_of_cars'];
        $cars_matching_search = array();
        foreach ($cars as $car) {
            if ( ($car->getPrice() <= $_GET["price"]) && ($car->getMiles() <= $_GET["miles"]) ) {
                array_push($cars_matching_search, $car);
            }
        }

        return $app['twig']->render('matching_car.html.twig', array('cars' => $cars_matching_search));
    });

    $app->get("/car_add", function() use ($app) {

        return $app['twig']->render('creating_car.html.twig');
    });

    $app->post("/cars_list", function() use ($app) {
        $car = new Car($_POST['model'], $_POST['price'], $_POST['miles'], $_POST['image'] );
        $car->save();
        return $app['twig']->render('new_car.html.twig', array('cars' => Car::getAll()));
    });

    $app->post("/delete_all", function() use ($app) {
        Car::deleteAll();
        return $app['twig']->render('home.html.twig', array('cars' =>Car::getAll()));
    });


    return $app;

 ?>
