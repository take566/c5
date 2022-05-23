<?php 
/* Cachekey: cache/stash_default/doctrine/[concrete\core\entity\site\locale$tree][1]/ */
/* Type: array */
/* Expiration: 2022-05-28T02:02:24+09:00 */



$loaded = true;
$expiration = 1653670944;

$data = array();

/* Child Type: array */
$data['return'] = array (
  0 => 
  Doctrine\ORM\Mapping\OneToOne::__set_state(array(
     'targetEntity' => 'SiteTree',
     'mappedBy' => 'locale',
     'inversedBy' => NULL,
     'cascade' => 
    array (
      0 => 'all',
    ),
     'fetch' => 'LAZY',
     'orphanRemoval' => false,
  )),
  1 => 
  Doctrine\ORM\Mapping\JoinColumn::__set_state(array(
     'name' => 'siteTreeID',
     'referencedColumnName' => 'siteTreeID',
     'unique' => false,
     'nullable' => true,
     'onDelete' => NULL,
     'columnDefinition' => NULL,
     'fieldName' => NULL,
  )),
);

/* Child Type: integer */
$data['createdOn'] = 1653255339;
