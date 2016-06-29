<?php

namespace LocationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Translatable\Translatable;

/**
 * City
 *
 * @ORM\Table(name="location_country")
 * @ORM\Entity(repositoryClass="LocationBundle\Repository\CountryRepository")
 * @Gedmo\TranslationEntity(class="CountryTranslation")
 */
class Country implements Translatable
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
     * @Gedmo\Translatable
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(name="shortname", type="string", length=2)
     */
    private $shortname;

    /**
     * @ORM\Column(name="country_locale", type="string", length=5)
     */
    private $country_locale;

    /**
     * @Gedmo\Locale
     */
    private $locale;

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
     *
     * @return CityTranslation
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

    public function setTranslatableLocale($locale)
    {
        $this->locale = $locale;
    }

    /**
     * Set shortname
     *
     * @param string $shortname
     *
     * @return Country
     */
    public function setShortname($shortname)
    {
        $this->shortname = $shortname;

        return $this;
    }

    /**
     * Get shortname
     *
     * @return string
     */
    public function getShortname()
    {
        return $this->shortname;
    }

    /**
     * Set countryLocale
     *
     * @param string $countryLocale
     *
     * @return Country
     */
    public function setCountryLocale($countryLocale)
    {
        $this->country_locale = $countryLocale;

        return $this;
    }

    /**
     * Get countryLocale
     *
     * @return string
     */
    public function getCountryLocale()
    {
        return $this->country_locale;
    }
}
