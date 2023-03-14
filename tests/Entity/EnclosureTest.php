<?php

namespace App\Tests\Entity;

use App\Entity\Dinosaur;
use App\Entity\Enclosure;
use App\Exceptions\NotABuffetException;
use PHPUnit\Framework\TestCase;

class EnclosureTest extends TestCase
{
    public function testItHasNoDinosaursByDefault()
    {
        $enclosure = new Enclosure();

        $this->assertEmpty($enclosure->getDinosaurus());
    }

    public function testItAddsDinosaurs()
    {
        $enclosure = new Enclosure();
        $enclosure->addDinosaurs(new Dinosaur());
        $enclosure->addDinosaurs(new Dinosaur());

        $this->assertCount(2, $enclosure->getDinosaurus());
    }

    public function testDoesNotMixCarnivorousAndOtherTypeOfDino()
    {
        $enclosure = new Enclosure();
        $enclosure->addDinosaurs(new Dinosaur());

        $this->expectException(NotABuffetException::class);
        $enclosure->addDinosaurs(new Dinosaur('Velociraptor', true));
    }

    public function testDoesNotMixNotCarnivorousAndCarvivorousTypeOfDino()
    {
        $this->expectException(NotABuffetException::class);
        $enclosure = new Enclosure();
        $enclosure->addDinosaurs(new Dinosaur('Velociraptor', true));
        $enclosure->addDinosaurs(new Dinosaur());



    }




}
