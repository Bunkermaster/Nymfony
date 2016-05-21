<?php
namespace Model;

use Doctrine\ORM\EntityManager;
use Helper\ServiceContainer;

/**
 * Class PageRepository
 * @author Yann Le Scouarnec <yann.le-scouarnec@hetic.net>
 * @package Model
 */
class PageRepository extends Repository
{

    /**
     * Entity name
     * @var string
     */
    protected $entity = 'Model\\Entity\\Page';

    /**
     * @return array
     */
    public function get()
    {
        /** @var EntityManager $em */
        $em = ServiceContainer::getService('EntityManager');
        $qb = $em->createQueryBuilder();
        $qb->add('select', 'p')
            ->add('from', 'Model\Entity\Page p')
            ->add('orderBy', 'p.title ASC');
        $query = $qb->getQuery();
        return $query->getResult();
    }
}
