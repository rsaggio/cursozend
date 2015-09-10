<?php

namespace Produto\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;

class ProdutoRepository extends EntityRepository
{
    public function getProdutosPaginados($offset = 0, $limit = 10)
    {
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();

        $qb->select('p')
            ->from('\Produto\Entity\Produto', 'p')
            ->orderBy('p.id')
            ->setMaxResults($limit)
            ->setFirstResult($offset);

        $query = $qb->getQuery();

        $paginator = new Paginator( $query );

        return $paginator;
    }
}

?>