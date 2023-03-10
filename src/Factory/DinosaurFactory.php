<?php

namespace App\Factory;

use App\Entity\Dinosaur;
use Exception;

class DinosaurFactory
{
    public function growVelociraptor(int $length): Dinosaur
    {
        return $this->createDinosaur('Velociraptor', true, $length);
    }

    private function createDinosaur(string $genus, bool $isCarnivorous, int $length): Dinosaur
    {
        $dinosaur = new Dinosaur($genus, $isCarnivorous);
        $dinosaur->setLength($length);

        return $dinosaur;
    }

    /**
     * @throws Exception
     */
    public function growFromSpecification(string $specification): Dinosaur
    {
        //default
        $codeName = 'Ing-' . random_int(1, 99999);
        $length = random_int(1, Dinosaur::LARGE - 1);
        $isCarnivorous = false;

        if (str_contains($specification, 'large')) {
            $length = random_int(Dinosaur::LARGE, Dinosaur::HUGE - 1);
        }

        if (str_contains($specification, 'huge')) {
            $length = random_int(Dinosaur::HUGE, Dinosaur::HUGE + 30);
        }

        if (str_contains($specification, 'carnivorous')) {
            $isCarnivorous = true;
        }

        return $this->createDinosaur($codeName, $isCarnivorous, $length);
    }


}