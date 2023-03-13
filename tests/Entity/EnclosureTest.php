<?php

namespace App\Tests\Entity;

use App\Entity\Dinosaur;
use App\Entity\Enclosure;
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

}
