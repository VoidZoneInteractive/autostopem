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
        $query = $this->createQueryBuilder('c')
            ->select('c.id AS id, t.translation AS label')
            ->join('c.i18n', 'i')
            ->join('i.translations', 't')
            ->join('t.locale', 'l')
            ->where('t.translation LIKE :name')
            ->andWhere('l.locale = :locale')
            ->setParameters(array(
                'name' => '%' . $term . '%',
                'locale' => $locale,
            ));

        return $query->getQuery()->getResult(Query::HYDRATE_ARRAY);
    }
}
