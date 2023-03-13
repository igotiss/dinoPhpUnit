<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="dinosaurs")
 */
class Dinosaur
{

    const LARGE = 10;
    const HUGE = 30;
    private string $genus;
    private bool $isCarnivorous;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Enclosure", inversedBy="dinosaurs")
     */
    private $enclosure;
    public function __construct(string $genus = 'Unknown', bool $isCarnivorous = false)
    {
        $this->genus = $genus;
        $this->isCarnivorous = $isCarnivorous;
    }

    /**
     * @return int
     */
    public function getLength(): int
    {
        return $this->length;
    }

    /**
     * @param int $length
     */
    public function setLength(int $length): void
    {
        $this->length = $length;
    }
    /**
     * @ORM\Column(type="integer")
     */
    private $length = 0;

    public function getSpecification(): string
    {
        return sprintf(
            'The %s %s dinosaur is %d meters long',
            $this->genus,
            $this->isCarnivorous ? 'carnivorous' : 'non-carnivorous',
            $this->length
        );
    }

    /**
     * @return string
     */
    public function getGenus(): string
    {
        return $this->genus;
    }

    /**
     * @param string $genus
     */
    public function setGenus(string $genus): void
    {
        $this->genus = $genus;
    }

    public function isCarnivorous()
    {
        return $this->isCarnivorous;
    }

}
