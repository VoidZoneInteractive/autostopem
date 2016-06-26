<?php

namespace LocationBundle\Repository;
use Doctrine\ORM\Query;

/**
 * CityRepository
 */
class CityRepository extends \Doctrine\ORM\EntityRepository
{
    /**
     * @param $name
     * @param $locale
     * @return array
     */
    public function findCitiesByNameForAutocomplete($term, $locale)
    {

        $queryBuilder = $this->createQueryBuilder('c');
        $query = $queryBuilder->select('c.id, c.name, c.latitude, c.longitude')
            ->where('c.name LIKE :name')
            ->setParameter('name', '%' . $term . '%')
            ->getQuery();

        $query->setHint(\Doctrine\ORM\Query::HINT_CUSTOM_OUTPUT_WALKER, 'Gedmo\\Translatable\\Query\\TreeWalker\\TranslationWalker');
        $query->setHint(\Gedmo\Translatable\TranslatableListener::HINT_TRANSLATABLE_LOCALE, $locale);

        return $query->getResult();
    }
}
