<?php

namespace G4\Tasker\Model\Mapper\Mysql;

use G4\Tasker\Consts;
use G4\DataMapper\Mapper\Mysql\MysqlAbstract;

class Task extends MysqlAbstract
{
    protected $_factoryDomainName = '\G4\Tasker\Model\Factory\Domain\Task';

    protected $_tableName = 'tasks';

    private $_identifier;


    public function getReservedTasks($limit)
    {
        $limit = intval($limit);

        if(!$limit) {
            throw new \Exception('Limit is not valid');
        }

        $identity = $this
            ->getIdentity()
            ->field('identifier')
            ->eq($this->getIdentifier())
            ->field('status')
            ->eq(Consts::STATUS_PENDING)
            ->field('ts_created')
            ->le(time())
            ->field('started_count')
            ->eq(0)
            ->setLimit($limit);

        return $this->findAll($identity);
    }

    public function getIdentifier()
    {
        if (!isset($this->_identifier)) {
            $this->_generateIdentifier();
        }
        return $this->_identifier;
    }

    private function _generateIdentifier()
    {
        $this->_identifier = gethostname();
        return $this;
    }
}