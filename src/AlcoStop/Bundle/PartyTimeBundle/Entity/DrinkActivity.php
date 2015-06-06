<?php

namespace AlcoStop\Bundle\PartyTimeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Drink
 *
 * @ORM\Table(name="drink_activities")
 * @ORM\Entity()
 */
class DrinkActivity
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
     * @ORM\ManyToOne(targetEntity="AlcoStop\Bundle\DrinkBundle\Entity\Drink", inversedBy="drinkActivityId")
     * @ORM\JoinColumn(name="drink_id", referencedColumnName="id")
     */
    private $drinkId;

    /**
     * @ORM\ManyToOne(targetEntity="AlcoStop\Bundle\UserBundle\Entity\User", inversedBy="drinkActivityId")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $userId;

    /**
     * @var float
     *
     * @ORM\Column(name="volume", type="float")
     */
    private $volume;

    /**
     * @var \DateTime $validFrom
     *
     * @ORM\Column(name="issue_date", type="date")
     */
    private $issueDate;

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
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param mixed $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    /**
     * @return mixed
     */
    public function getDrinkId()
    {
        return $this->drinkId;
    }

    /**
     * @param mixed $drinkId
     */
    public function setDrinkId($drinkId)
    {
        $this->drinkId = $drinkId;
    }

    /**
     * @return float
     */
    public function getVolume()
    {
        return $this->volume;
    }

    /**
     * @param float $volume
     */
    public function setVolume($volume)
    {
        $this->volume = $volume;
    }

    /**
     * @return \DateTime
     */
    public function getIssueDate()
    {
        return $this->issueDate;
    }

    /**
     * @param \DateTime $issueDate
     */
    public function setIssueDate($issueDate)
    {
        $this->issueDate = $issueDate;
    }
}
