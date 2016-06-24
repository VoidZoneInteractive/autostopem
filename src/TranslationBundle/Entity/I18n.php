<?php

namespace TranslationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * I18n
 *
 * @ORM\Table(name="translation_i18n")
 * @ORM\Entity(repositoryClass="TranslationBundle\Repository\I18nRepository")
 */
class I18n
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
     * @var int
     *
     * @ORM\OneToMany(targetEntity="Translation", mappedBy="i18n")
     */
    private $translations;


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
     * Constructor
     */
    public function __construct()
    {
        $this->translations = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get translations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTranslations()
    {
        return $this->translations;
    }

    /**
     * Add translation
     *
     * @param \TranslationBundle\Entity\Translation $translation
     *
     * @return I18n
     */
    public function addTranslation(\TranslationBundle\Entity\Translation $translation)
    {
        $this->translations[] = $translation;

        return $this;
    }

    /**
     * Remove translation
     *
     * @param \TranslationBundle\Entity\Translation $translation
     */
    public function removeTranslation(\TranslationBundle\Entity\Translation $translation)
    {
        $this->translations->removeElement($translation);
    }
}
