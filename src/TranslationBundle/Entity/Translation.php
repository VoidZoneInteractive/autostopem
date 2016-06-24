<?php

namespace TranslationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Translation
 *
 * @ORM\Table(name="tranlation_translation", uniqueConstraints={@ORM\UniqueConstraint(name="translation_unique", columns={"locale", "i18n"})})
 * @ORM\Entity(repositoryClass="TranslationBundle\Repository\TranslationRepository")
 */
class Translation
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
     * @var string
     *
     * @ORM\Column(name="translation", type="text")
     */
    private $translation;

    /**
     * @var int
     *
     * @ORM\ManyToOne(targetEntity="Locale")
     * @ORM\JoinColumn(name="locale", referencedColumnName="id")
     */
    private $locale;

    /**
     * @var int
     *
     * @ORM\ManyToOne(targetEntity="I18n", inversedBy="translations")
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
     * Set translation
     *
     * @param string $translation
     *
     * @return Translation
     */
    public function setTranslation($translation)
    {
        $this->translation = $translation;

        return $this;
    }

    /**
     * Get translation
     *
     * @return string
     */
    public function getTranslation()
    {
        return $this->translation;
    }

    /**
     * Set locale
     *
     * @param \TranslationBundle\Entity\Locale $locale
     *
     * @return Translation
     */
    public function setLocale(\TranslationBundle\Entity\Locale $locale = null)
    {
        $this->locale = $locale;

        return $this;
    }

    /**
     * Get locale
     *
     * @return \TranslationBundle\Entity\Locale
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * Set i18n
     *
     * @param \TranslationBundle\Entity\I18n $i18n
     *
     * @return Translation
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
