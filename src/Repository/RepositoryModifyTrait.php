<?php

namespace App\Repository;

trait RepositoryModifyTrait
{
    public function save(object $object): void
    {
        assert($this->_entityName === $object::class);
        $this->_em->persist($object);
    }

    public function remove(object $object): void
    {
        assert($this->_entityName === $object::class);
        $this->_em->remove($object);
    }

    public function commit(): void
    {
        $this->_em->flush();
    }

    public function saveAndCommit(object $object): void
    {
        $this->_em->persist($object);
        $this->_em->flush();
    }

    public function removeAndCommit(object $object): void
    {
        $this->remove($object);
        $this->commit();
    }
}