<?php

namespace AlcoStop\Bundle\DrinkBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Drink
 *
 * @ORM\Table(name="alco_stages")
 * @ORM\Entity()
 */
class AlcoStage
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
     * @ORM\Column(name="ethyl_volume", type="float")
     */
    private $ethylVolume;

    /**
     * @ORM\OneToMany(targetEntity="User", mappedBy="alcoLevelId")
     */
    private $userId;

    /**
     *
     */
    public function __construct()
    {
        $this->userId = new ArrayCollection();
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
     * @return float
     */
    public function getEthylVolume()
    {
        return $this->ethylVolume;
    }

    /**
     * @param float $ethylVolume
     */
    public function setEthylVolume($ethylVolume)
    {
        $this->ethylVolume = $ethylVolume;
    }
}
