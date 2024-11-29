<?php
namespace Controllers;
class ErrorsControllers
{
    public static function launchError(int $code)
    {
        switch ($code) {
            case 404:
            default:
                require_once ROOT . "/views/not_found.php";
                require_once ROOT . "/templates/global.php";
                break;
        }
    }
}