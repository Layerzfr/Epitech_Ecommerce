<?php

namespace App\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotNull
     * @var string
     */
    protected $deliveryCountry;

    /**
     * @var string
     * @Assert\NotNull
     * @ORM\Column(type="string")
     */
    protected $deliveryCity;

    /**
     * @var string
     * @Assert\NotNull
     * @ORM\Column(type="string")
     */
    protected $deliveryZip;

    /**
     * @var string
     * @Assert\NotNull
     * @ORM\Column(type="string")
     */
    protected $deliveryAddress;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    protected $promotionPercent;

    /**
     * @var \DateTime
     * @Assert\NotNull
     * @ORM\Column(type="datetime")
     */
    protected $birthDate;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime")
     */
    protected $creationDate;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    protected $image;

    /**
     * @return string
     */
    public function getDeliveryCountry()
    {
        return $this->deliveryCountry;
    }

    /**
     * @param string $deliveryCountry
     */
    public function setDeliveryCountry(string $deliveryCountry): void
    {
        $this->deliveryCountry = $deliveryCountry;
    }

    /**
     * @return string
     */
    public function getDeliveryCity()
    {
        return $this->deliveryCity;
    }

    /**
     * @param string $deliveryCity
     */
    public function setDeliveryCity(string $deliveryCity): void
    {
        $this->deliveryCity = $deliveryCity;
    }

    /**
     * @return string
     */
    public function getDeliveryZip()
    {
        return $this->deliveryZip;
    }

    /**
     * @param string $deliveryZip
     */
    public function setDeliveryZip(string $deliveryZip): void
    {
        $this->deliveryZip = $deliveryZip;
    }

    /**
     * @return string
     */
    public function getDeliveryAddress()
    {
        return $this->deliveryAddress;
    }

    /**
     * @param string $deliveryAddress
     */
    public function setDeliveryAddress(string $deliveryAddress): void
    {
        $this->deliveryAddress = $deliveryAddress;
    }

    /**
     * @return int
     */
    public function getPromotionPercent()
    {
        return $this->promotionPercent;
    }

    /**
     * @param int $promotionPercent
     */
    public function setPromotionPercent(int $promotionPercent)
    {
        $this->promotionPercent = $promotionPercent;
    }

    /**
     * @return \DateTime
     */
    public function getCreationDate()
    {
        return $this->creationDate;
    }

    /**
     * @param \DateTime $creationDate
     */
    public function setCreationDate(\DateTime $creationDate)
    {
        $this->creationDate = $creationDate;
    }

    /**
     * @return \DateTime
     */
    public function getBirthDate()
    {
        return $this->birthDate;
    }

    /**
     * @param \DateTime $birthDate
     */
    public function setBirthDate(\DateTime $birthDate)
    {
        $this->birthDate = $birthDate;
    }

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param string $image
     */
    public function setImage(string $image)
    {
        $this->image = $image;
    }


    public function __construct()
    {
        parent::__construct();
        $this->setPromotionPercent(0);
        $this->setCreationDate(new \DateTime());
        $this->setImage("");
        // your own logic
    }
}