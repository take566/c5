<?php 
/* Cachekey: cache/stash_default/doctrine/[concrete\core\entity\file\file$author][1]/ */
/* Type: array */
/* Expiration: 2022-05-18T08:50:43+09:00 */



$loaded = true;
$expiration = 1652831443;

$data = array();

/* Child Type: array */
$data['return'] = array (
  0 => 
  Doctrine\ORM\Mapping\ManyToOne::__set_state(array(
     'targetEntity' => '\\Concrete\\Core\\Entity\\User\\User',
     'cascade' => NULL,
     'fetch' => 'LAZY',
     'inversedBy' => NULL,
  )),
  1 => 
  Doctrine\ORM\Mapping\JoinColumn::__set_state(array(
     'name' => 'uID',
     'referencedColumnName' => 'uID',
     'unique' => false,
     'nullable' => true,
     'onDelete' => 'SET NULL',
     'columnDefinition' => NULL,
     'fieldName' => NULL,
  )),
);

/* Child Type: integer */
$data['createdOn'] = 1652404976;
