<?php

namespace AlcoStop\Bundle\UserBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Sonata\UserBundle\Entity\BaseUser;
use AlcoStop\Bundle\DrinkBundle\Entity\AlcoStage;
use Sonata\UserBundle\Model\UserInterface;

/**
 * User
 *
 * @ORM\Table()
 * @ORM\Entity()
 */
class User extends BaseUser
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * @var float
     *
     * @ORM\Column(name="alco_level_id", type="float")
     */

    /**
     * @ORM\ManyToOne(targetEntity="AlcoStop\Bundle\DrinkBundle\Entity\AlcoStage", inversedBy="userId")
     * @ORM\JoinColumn(name="alco_stage_id", referencedColumnName="id")
     */
    private $alcoLevelId;

    /**
     * @ORM\OneToMany(targetEntity="AlcoStop\Bundle\PartyTimeBundle\Entity\DrinkActivity", mappedBy="userId")
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

    public function __toString()
    {
        return $this->getFirstname() . ' ' . $this->getLastName();
    }

    /**
     * Returns the gender list
     *
     * @return array
     */
    public static function getGenderList()
    {
        return array(
            UserInterface::GENDER_UNKNOWN => '',
            UserInterface::GENDER_FEMALE  => 'Female',
            UserInterface::GENDER_MALE    => 'Male',
        );
    }
}
