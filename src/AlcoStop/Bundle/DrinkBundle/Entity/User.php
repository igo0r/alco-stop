<?php

namespace AlcoStop\Bundle\DrinkBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table()
 * @ORM\Entity()
 */
class User
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
     * @ORM\Column(name="first_name", type="string", length=255)
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="string", length=255)
     */
    private $lastName;

    /**
     * @var float
     *
     * @ORM\Column(name="alco_level_id", type="float")
     */

    /**
     * @ORM\ManyToOne(targetEntity="AlcoStage", inversedBy="userId")
     * @ORM\JoinColumn(name="alco_stage_id", referencedColumnName="id")
     */
    private $alcoLevelId;

    /**
     * @ORM\OneToMany(targetEntity="DrinkActivity", mappedBy="userId")
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
     * @return float
     */
    public function getAlcoLevelId()
    {
        return $this->alcoLevelId;
    }

    /**
     * @param float $alcoLevelId
     */
    public function setAlcoLevelId($alcoLevelId)
    {
        $this->alcoLevelId = $alcoLevelId;
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

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }
}
