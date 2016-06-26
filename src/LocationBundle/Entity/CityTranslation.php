<?php

namespace LocationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Translatable\Entity\MappedSuperclass\AbstractTranslation;

/**
 * @ORM\Entity()
 * @ORM\Table(name="location_city_translations", indexes={
 * @ORM\Index(name="location_city_translation_idx", columns={"locale", "object_class", "field", "foreign_key"})
 * })
 */
class CityTranslation extends AbstractTranslation
{
}
