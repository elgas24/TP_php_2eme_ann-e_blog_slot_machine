<?php
namespace Controllers;

class SlotMachineController
{
    private static $globalTemplatePath = ROOT . "/templates/global.php";


    public static function randomise($myArray)
    {
        $myArray = ["a" => "red", "b" => "green", "c" => "blue", "d" => "yellow", "e" => "purple"];
        $value = shuffle($myArray);


        if (mb_strtolower($_SERVER['REQUEST_METHOD']) === 'post') {
            var_dump('rvre');

        }

        require_once ROOT . "/views/slot_machine.php";
        require_once ROOT . "/templates/global.php";
    }

    private static function getRandomSymbol($symbols)
    {
        $rand = mt_rand(1, array_sum($symbols)); // Générer un nombre aléatoire
        foreach ($symbols as $symbol => $weight) {
            if ($rand <= $weight) {
                return $symbol;
            }
            $rand -= $weight; // Réduire le seuil
        }
        return null; // Cas improbable
    }

    public static function selectRandom()
    {
       

        $symbols_with_weights = [
            '🍋' => 40,
            '🍒' => 30,
            '⭐' => 15,
            '🔔' => 10,
            '💎' => 5,
        ];
        // Table des gains (combinaison => gain)
        $paytable = [
            '🍋🍋🍋' => 40,
            '🍒🍒🍒' => 50,
            '⭐⭐⭐' => 100,
            '🔔🔔🔔' => 150,
            '💎💎💎' => 200,
        ];

        //  getRandomSymbol(){
        //     echo "hii";
        // }

        // Générer 3 symboles
        $reel1 = self::getRandomSymbol($symbols_with_weights);
        $reel2 = self::getRandomSymbol($symbols_with_weights);
        $reel3 = self::getRandomSymbol($symbols_with_weights);

        // Résultat de la machine à sous
        $combination = $reel1 . $reel2 . $reel3;
        // Calculer le gain
        $gain = isset($paytable[$combination]) ? $paytable[$combination] : 0;
        // Réponse JSON
        // echo json_encode([
        //     'success' => true,
        //     'reels' => [$reel1, $reel2, $reel3],
        //     'gain' => $gain,
        // ]);

       
        require ROOT . "/views/slot_machine2.php";
        require_once ROOT . "/templates/global.php";


    }
}