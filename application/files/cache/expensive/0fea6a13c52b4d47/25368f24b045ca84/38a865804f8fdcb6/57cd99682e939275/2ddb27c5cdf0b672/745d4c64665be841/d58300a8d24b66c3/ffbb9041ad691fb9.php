<?php 
/* Cachekey: cache/stash_default/doctrine/[concrete\core\entity\statistics\usagetracker\stackusagerecord][1]/ */
/* Type: array */
/* Expiration: 2022-05-28T01:09:48+09:00 */



$loaded = true;
$expiration = 1653667788;

$data = array();

/* Child Type: array */
$data['return'] = array (
  0 => 
  Doctrine\ORM\Mapping\Entity::__set_state(array(
     'repositoryClass' => NULL,
     'readOnly' => false,
  )),
  1 => 
  Doctrine\ORM\Mapping\Table::__set_state(array(
     'name' => 'StackUsageRecord',
     'schema' => NULL,
     'indexes' => 
    array (
      0 => 
      Doctrine\ORM\Mapping\Index::__set_state(array(
         'name' => 'block',
         'columns' => 
        array (
          0 => 'block_id',
        ),
         'fields' => NULL,
         'flags' => NULL,
         'options' => NULL,
      )),
      1 => 
      Doctrine\ORM\Mapping\Index::__set_state(array(
         'name' => 'collection_version',
         'columns' => 
        array (
          0 => 'collection_id',
          1 => 'collection_version_id',
        ),
         'fields' => NULL,
         'flags' => NULL,
         'options' => NULL,
      )),
    ),
     'uniqueConstraints' => NULL,
     'options' => 
    array (
    ),
  )),
);

/* Child Type: integer */
$data['createdOn'] = 1653270538;
