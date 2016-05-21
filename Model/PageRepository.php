<?php
namespace Model;

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
        $qb = $this->entityManager->createQueryBuilder();
        $qb->add('select', 'p')
            ->add('from', 'Model\Entity\Page p')
            ->add('orderBy', 'p.title ASC');
        $query = $qb->getQuery();
        return $query->getResult();
    }
}
