<?php 
/* Cachekey: cache/stash_default/doctrine/[concrete\core\entity\express\entry\association][1]/ */
/* Type: array */
/* Expiration: 2022-05-28T00:38:29+09:00 */



$loaded = true;
$expiration = 1653665909;

$data = array();

/* Child Type: array */
$data['return'] = array (
  0 => 
  Doctrine\ORM\Mapping\Entity::__set_state(array(
     'repositoryClass' => NULL,
     'readOnly' => false,
  )),
  1 => 
  Doctrine\ORM\Mapping\InheritanceType::__set_state(array(
     'value' => 'SINGLE_TABLE',
  )),
  2 => 
  Doctrine\ORM\Mapping\DiscriminatorColumn::__set_state(array(
     'name' => 'type',
     'type' => 'string',
     'length' => NULL,
     'fieldName' => NULL,
     'columnDefinition' => NULL,
  )),
  3 => 
  Doctrine\ORM\Mapping\Table::__set_state(array(
     'name' => 'ExpressEntityEntryAssociations',
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
