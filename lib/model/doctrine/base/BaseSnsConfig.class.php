<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
abstract class BaseSnsConfig extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('sns_config');
        $this->hasColumn('id', 'integer', 4, array('type' => 'integer', 'primary' => true, 'autoincrement' => true, 'length' => '4'));
        $this->hasColumn('name', 'string', 64, array('type' => 'string', 'default' => '', 'notnull' => true, 'length' => '64'));
        $this->hasColumn('value', 'string', 2147483647, array('type' => 'string', 'length' => '2147483647'));

        $this->option('charset', 'utf8');
    }

}