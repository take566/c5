<?php 
/* Cachekey: cache/stash_default/doctrine/[concrete\core\entity\page\container\instancearea$instance][1]/ */
/* Type: array */
/* Expiration: 2022-05-26T14:10:33+09:00 */



$loaded = true;
$expiration = 1653541833;

$data = array();

/* Child Type: array */
$data['return'] = array (
  0 => 
  Doctrine\ORM\Mapping\ManyToOne::__set_state(array(
     'targetEntity' => 'Instance',
     'cascade' => NULL,
     'fetch' => 'LAZY',
     'inversedBy' => 'instanceAreas',
  )),
  1 => 
  Doctrine\ORM\Mapping\JoinColumn::__set_state(array(
     'name' => 'containerInstanceID',
     'referencedColumnName' => 'containerInstanceID',
     'unique' => false,
     'nullable' => true,
     'onDelete' => 'CASCADE',
     'columnDefinition' => NULL,
     'fieldName' => NULL,
  )),
);

/* Child Type: integer */
$data['createdOn'] = 1653164963;
