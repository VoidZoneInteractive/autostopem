<?php

namespace LocationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * City
 *
 * @ORM\Table(name="location_city")
 * @ORM\Entity(repositoryClass="LocationBundle\Repository\CityRepository")
 */
class City
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var float
     *
     * @ORM\Column(name="latitude", type="float")
     */
    private $latitude;

    /**
     * @var float
     *
     * @ORM\Column(name="longitude", type="float")
     */
    private $longitude;

    /**
     * @var int
     *
     * @ORM\OneToOne(targetEntity="\TranslationBundle\Entity\I18n")
     * @ORM\JoinColumn(name="i18n", referencedColumnName="id")
     */
    private $i18n;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set latitude
     *
     * @param float $latitude
     *
     * @return City
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Get latitude
     *
     * @return float
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set longitude
     *
     * @param float $longitude
     *
     * @return City
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * Get longitude
     *
     * @return float
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Set i18n
     *
     * @param \TranslationBundle\Entity\I18n $i18n
     *
     * @return City
     */
    public function setI18n(\TranslationBundle\Entity\I18n $i18n = null)
    {
        $this->i18n = $i18n;

        return $this;
    }

    /**
     * Get i18n
     *
     * @return \TranslationBundle\Entity\I18n
     */
    public function getI18n()
    {
        return $this->i18n;
    }
}
