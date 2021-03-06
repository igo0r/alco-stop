<?php

namespace AlcoStop\Bundle\DrinkBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Drink
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AlcoStop\Bundle\DrinkBundle\Entity\Repositories\DrinkRepository")
 */
class Drink
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var float
     *
     * @ORM\Column(name="strength", type="float")
     */
    private $strength;

    /**
     * @ORM\OneToMany(targetEntity="AlcoStop\Bundle\PartyTimeBundle\Entity\DrinkActivity", mappedBy="drinkId")
     */
    private $drinkActivityId;

    /**
     *
     */
    public function __construct()
    {
        $this->drinkActivityId = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Drink
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set strength
     *
     * @param float $strength
     * @return Drink
     */
    public function setStrength($strength)
    {
        $this->strength = $strength;

        return $this;
    }

    /**
     * Get strength
     *
     * @return float
     */
    public function getStrength()
    {
        return $this->strength;
    }

    /**
     * @return mixed
     */
    public function getDrinkActivityId()
    {
        return $this->drinkActivityId;
    }

    /**
     * @param mixed $drinkActivityId
     */
    public function setDrinkActivityId($drinkActivityId)
    {
        $this->drinkActivityId = $drinkActivityId;
    }

    public function __toString()
    {
        return $this->getName();
    }
}
