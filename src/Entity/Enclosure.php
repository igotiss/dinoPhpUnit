<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="enclosure")
 *
 */
class Enclosure
{

    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity="App\Entity\Dinosaur", mappedBy="enclosure", cascade={"persist"})
     */
    private $dinosaurs;
    public function __construct()
    {
        $this->dinosaurs = new ArrayCollection();
    }

    public function getDinosaurus(): Collection
    {
        return $this->dinosaurs;
    }

    public function addDinosaurs(Dinosaur $dinosaur)
    {
        $this->dinosaurs[] = $dinosaur;
    }
}