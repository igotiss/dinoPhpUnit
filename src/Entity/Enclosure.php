<?php

namespace App\Entity;

use App\Exceptions\NotABuffetException;
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

    /**
     * @throws NotABuffetException
     */
    public function addDinosaurs(Dinosaur $dinosaur): void
    {
        if (!$this->canAddDinosaur($dinosaur))
        {
            throw new NotABuffetException();
        }
        $this->dinosaurs[] = $dinosaur;
    }

    private function canAddDinosaur(Dinosaur $dinosaur): bool
    {
        return count($this->dinosaurs) === 0
            || $this->dinosaurs->first()->isCarnivorous() === $dinosaur->isCarnivorous();
    }
}