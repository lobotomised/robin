<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Entities\Past;
use App\Support\CarbonCopy;
use Doctrine\ORM\EntityRepository;

class PastRepository extends EntityRepository implements PastRepositoryInterface
{
    /**
     * @param \App\Entities\Past $past
     *
     * @return \App\Entities\Past
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(past $past): Past
    {
        $this->_em->persist($past);
        $this->_em->flush();

        return $past;
    }

    /**
     * @return mixed
     */
    public function removeExpired(): int
    {
        return $this->createQueryBuilder('p')
            ->where('p.expire_at < :now')
            ->setParameter('now', CarbonCopy::now())
            ->delete()
            ->getQuery()
            ->execute();
    }
}
