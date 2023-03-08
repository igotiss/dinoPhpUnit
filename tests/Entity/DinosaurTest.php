<?php

namespace App\Tests\Entity;

use App\Entity\Dinosaur;
use PHPUnit\Framework\TestCase;
class DinosaurTest extends TestCase
{
    public function testSettingLength():void
    {
        $dinosaur =new Dinosaur();

        $this->assertSame(0, $dinosaur->getLength());

        $dinosaur->setLength(9);

        $this->assertSame(9, $dinosaur->getLength());
    }

    public function testDinosaurHasNotShrunk()
    {
        $dino = new Dinosaur();
        $dino->setLength(13);

        $this->assertGreaterThan(12, $dino->getLength(), 'did you put it in washing machine?');
    }

    public function testReturnFullSpecificationOfDinosaur()
    {
        $dinosaur = new Dinosaur();

        $this->assertSame(
            'The Unknown non-carnivorous dinosaur is 0 meters long',
            $dinosaur->getSpecification()
        );
    }

    public function testReturnSpecificationsForTyrannosaurus()
    {
        $dinosaur = new Dinosaur('Tyrannosaurus', true);
        $dinosaur->setLength(12);

        $this->assertSame(
            'The Tyrannosaurus carnivorous dinosaur is 12 meters long',
            $dinosaur->getSpecification()
        );
    }

}