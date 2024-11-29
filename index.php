<?php
use Controllers\ArticlesControllers;
use Controllers\ErrorsControllers;
use Controllers\SlotMachineController;
use Models\Autoloader;
ini_set("date.timezone", "Europe/Paris");
require_once "./utils/Defines.php";
require_once "./models/Autoloader.php";


// use autoloader to import all models
Autoloader::register();
use Models\Article;
use Models\BDD;
use Models\Router;
// use Controllers\ArticlesControllers;

$article = new Article(BDD::dbConnect());

$article_test = [
    "title" => "Test",
    "content" => "test content by gagas24 bienn guez🤫",
    "author" => "webgas24"
];

$myArray = ["a" => "red", "b" => "green", "c" => "blue", "d" => "yellow", "e" => "purple"];


$uri = $_SERVER['REQUEST_URI'];
$router = new Router();
$idParam = (int) preg_replace("/[\D]+/", "", $uri);

switch (true) {

    case ($uri === "/"):
        $router->get("/", function () {

            require_once ROOT . "/views/home.php";
            require_once ROOT . "/templates/global.php";
        });
        break;


    case (strpos($uri, "/articles") === 0):

        //add 
        if ($uri === "/articles/add") {
            $router->get("/articles/add", function () {
                // Display the form
                require_once ROOT . "/views/writing_page.php";
                require_once ROOT . "/templates/global.php";
            });
            $router->post("/articles/add", function () {
                $title = $_POST['title'];
                $content = $_POST['content'];
                $author = $_POST['author'];

                ArticlesControllers::addArticle($title, $content, $author);
            });
        }
        //update
        elseif (preg_match('/^\/articles\/update\/(\d+)$/', $uri)) {
            $router->post("/articles/update/$idParam", function () use ($idParam) {
                ArticlesControllers::update($idParam);
            });

            $router->get("/articles/update/$idParam", function () use ($idParam, $router) {
                ArticlesControllers::update($idParam);
            });


        }
        //fallback ==> list articles 
        else {
            $router->get("/articles", ArticlesControllers::getList());

        }
        break;

    case ($uri === "/slot-machine"):
        $router->get("/slot-machine", SlotMachineController::randomise($myArray));
        break;

    case (strpos($uri, '/game')===0):
        if ($uri === '/game/fetch') {
            $router->get("/game/fetch", SlotMachineController::selectRandom());
            exit;
        } 
            $router->get("/game", SlotMachineController::displaySlot());

        
        break;

    default:

        ErrorsControllers::launchError(404);
        // echo "404";
        break;
}


$router->run();
