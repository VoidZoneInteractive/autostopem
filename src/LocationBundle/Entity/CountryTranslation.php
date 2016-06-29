<?php

namespace LocationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Translatable\Entity\MappedSuperclass\AbstractTranslation;

/**
 * @ORM\Entity()
 * @ORM\Table(name="location_country_translations", indexes={
 * @ORM\Index(name="location_country_translation_idx", columns={"locale", "object_class", "field", "foreign_key"})
 * })
 */
class CountryTranslation extends AbstractTranslation
{
}
