<?php 
/* Cachekey: cache/stash_default/doctrine/[concrete\core\entity\command\process][1]/ */
/* Type: array */
/* Expiration: 2022-05-27T19:21:26+09:00 */



$loaded = true;
$expiration = 1653646886;

$data = array();

/* Child Type: array */
$data['return'] = array (
  0 => 
  Doctrine\ORM\Mapping\Entity::__set_state(array(
     'repositoryClass' => 'ProcessRepository',
     'readOnly' => false,
  )),
  1 => 
  Doctrine\ORM\Mapping\InheritanceType::__set_state(array(
     'value' => 'JOINED',
  )),
  2 => 
  Doctrine\ORM\Mapping\DiscriminatorColumn::__set_state(array(
     'name' => 'processType',
     'type' => 'string',
     'length' => NULL,
     'fieldName' => NULL,
     'columnDefinition' => NULL,
  )),
  3 => 
  Doctrine\ORM\Mapping\Table::__set_state(array(
     'name' => 'MessengerProcesses',
     'schema' => NULL,
     'indexes' => NULL,
     'uniqueConstraints' => NULL,
     'options' => 
    array (
    ),
  )),
);

/* Child Type: integer */
$data['createdOn'] = 1653270538;
