<?php

declare(strict_types=1);

namespace App\GeneratorPass;

class GeneratorPassword
{
    public function __construct()
    {
        $this->tabSpecial = ['!', '@', '#', '$', '%', '^', '&', '*'];
        $this->tabNum = range(0, 9);
    }

    public function generate(int $nbChar, bool $pronunceable, float $numerals, float $specials): string
    {
        if ($pronunceable) {
            return $this->generatePronunceable($nbChar, $numerals, $specials);
        } else {
            return $this->generateNonPronunceable($nbChar, $numerals, $specials);
        }
    }

    public function generateNonPronunceable(int $nbChar, float $numerals, float $specials): string
    {
        $password = [];
        $nbNum = intval($nbChar * $numerals);

        $password = array_merge($password, $this->filler($nbNum, $this->tabNum));

        $nbSpe = intval($nbChar * $specials);

        $password = array_merge($password, $this->filler($nbSpe, $this->tabSpecial));
        $nbAlpha = $nbChar - $nbSpe - $nbNum;
        $tabAlpha = range('a', 'z') + range('A', 'Z');
        $password = array_merge($password, $this->filler($nbAlpha, $tabAlpha));

        shuffle($password);

        return implode('', $password);
    }

    public function generatePronunceable(int $nbChar, float $numerals, float $specials): string
    {
        $tabVowels = ['a', 'e', 'i', 'o', 'u', 'y'];
        $tabConsonants = ['z', 'r', 't', 'p', 'q', 's', 'd', 'f', 'g', 'h', 'j', 'k', 'l', 'm', 'w', 'x', 'c', 'v', 'b', 'n'];

        $switch = true;
        $password = '';

        for ($i = 0; $i < $nbChar; ++$i) {
            $length = rand(4, 10);
            $word = [];

            for ($a = 0; $a < $length; ++$a) {
                $word[] = $switch ? $this->charsRandom($tabVowels) : $this->charsRandom($tabConsonants);
                $switch = $switch ? false : true;
                // if($switch) {
                //     $word[] = $tabVowels[rand(0, count($tabVowels) - 1)];
                //     $switch = false;
                // } else {
                //     $word[] = $tabConsonants[rand(0, count($tabConsonants) - 1)];
                //     $switch = true;
                // }
            }

            $realWord = implode('', $word).$this->charsRandom($this->tabNum).$this->charsRandom($this->tabSpecial);
            $password = $password.$realWord;
        }

        return $password;
    }

    private function filler(int $nb, array $chars): array
    {
        $result = [];

        for ($i = 0; $i < $nb; ++$i) {
            $result[] = $this->charsRandom($chars);
        }

        return $result;
    }

    private function charsRandom(array $chars): string
    {
        return strval($chars[rand(0, count($chars) - 1)]);
    }
}
// $test = new GeneratorPassword();
// print_r($test->generate(9, false,  0.3, 0.5));
// echo "\n";
// print_r($test->generate(5, true,  0.3, 0.5));
// echo "\n";

// declare(strict_types=1);
// namespace App\Generator;
// class PasswordGenerator {
// 	public function __construct()
// 	{
// 		$this->tabSpe = ['&', '-', '@', '_', '+', ':'];
// 		$this->tabNum = range(0, 9);
// 	}
// 	public function generate(int $nbChar, bool $pronunceable, float $numerals, float $specials): string
// 	{
// 		if ($pronunceable) {
// 			return $this->generatePronunceable($nbChar, $numerals, $specials);
// 		} else {
// 			return $this->generateNonPronunceable($nbChar, $numerals, $specials);
// 		}
// 	}
// 	public function generateNonPronunceable(int $nbChar, float $numerals, float $specials): string
// 	{
// 		$password = [];
// 		$nbNum = intval($nbChar * $numerals);

// 		$password = array_merge($password, $this->filler($nbNum, $this->tabNum));
// 		$nbSpe = intval($nbChar * $specials);
// 		$password = array_merge($password, $this->filler($nbSpe, $this->tabSpe));
// 		$nbAlpha = $nbChar - $nbSpe - $nbNum;
// 		$tabAlpha = range('a', 'z') + range('A', 'Z');
// 		$password = array_merge($password, $this->filler($nbAlpha, $tabAlpha));
// 		shuffle($password);
// 		return implode('', $password);
// 	}
// 	public function generatePronunceable(int $nbChar, float $numerals, float $specials): string
// 	{
// 		$tabVowels = ['a', 'e', 'i', 'o', 'u', 'y'];
// 		$tabConsonants = ['z', 'r', 't', 'p', 'q', 's', 'd', 'f', 'g', 'h', 'j', 'k', 'l', 'm', 'w', 'x', 'c', 'v', 'b', 'n'];
// //		$switch = true;
// 		$password = '';

// 		for ($i = 0; $i < $nbChar; $i++) {
// 			$length = rand(4, 10);
// 			$word = [];
// 			for ($a = 0; $a < $length; $a++) {
// // Première optim : on remplace le if/else par l'opérateur ternaire
// //				$word[] = $switch ? $this->charsRandom($tabVowels) : $this->charsRandom($tabConsonants);
// //				$switch = $switch ? false : true;
// // Deuxième optim : on utilise l'opérateur directement dans l'appel de la méthode
// //				$word[] = $this->charsRandom($switch ? $tabVowels : $tabConsonants);
// //				$switch = !$switch;
// // Dernière optim : on se passe de $switch pour utiliser l'alternance pair/impair de $a
// 				$word[] = $this->charsRandom($a % 2 === 0 ? $tabVowels : $tabConsonants);
// 			}
// 			$realWord = implode('', $word) . $this->charsRandom($this->tabNum) . $this->charsRandom($this->tabSpe);
// 			$password = $password . $realWord;
// 		}
// 		return $password;
// 	}
// 	private function filler(int $nb, array $chars): array
// 	{
// 		$result = [];
// 		for ($i = 0; $i < $nb; $i++) {
// 			$result[] = $this->charsRandom($chars);
// 		}
// 		return $result;
// 	}
// 	private function charsRandom(array $chars): string
// 	{
// 		return strval($chars[rand(0, count($chars) - 1)]);
// 	}
// }
// $test = new PasswordGenerator();
// print_r($test->generate(9, false,  0.3, 0.5));
// echo "\n";
// print_r($test->generate(5, true,  0.3, 0.5));
// echo "\n";
