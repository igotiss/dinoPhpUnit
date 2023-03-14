<?php

namespace App\Entity;

use App\Exceptions\DinosaursAreRunningRampantException;
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
    private Collection $dinosaurs;
    /**
     * @var Collection|Security[]
     * @ORM\OneToMany(targetEntity="App\Entity\Security", mappedBy="enclosure", cascade={"persist"})
     */
    private Collection|array $securities;
    public function __construct(bool $withBasicSecurity = false)
    {
        $this->dinosaurs = new ArrayCollection();
        $this->securities = new ArrayCollection();

        if ($withBasicSecurity) {
            $this->addSecurity(new Security('Fence', true, $this));
        }
    }

    public function getDinosaurus(): Collection
    {
        return $this->dinosaurs;
    }

    /**
     * @throws NotABuffetException
     * @throws DinosaursAreRunningRampantException
     */
    public function addDinosaurs(Dinosaur $dinosaur): void
    {
        if (!$this->canAddDinosaur($dinosaur))
        {
            throw new NotABuffetException();
        }

        if (!$this->isSecurityActive()){
            throw new DinosaursAreRunningRampantException('Are you craaazy ?!?');
        }
        $this->dinosaurs[] = $dinosaur;
    }
    

    public function isSecurityActive(): bool
    {
        foreach ($this->securities as $security) {
            if ($security->getIsActive()) {

                return true;
            }
        }

        return false;
    }

    private function canAddDinosaur(Dinosaur $dinosaur): bool
    {
        return count($this->dinosaurs) === 0
            || $this->dinosaurs->first()->isCarnivorous() === $dinosaur->isCarnivorous();
    }

    public function addSecurity(Security $security)
    {
        $this->securities[] = $security;
    }
}