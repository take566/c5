<?php 
/* Cachekey: cache/stash_default/doctrine/[concrete\core\entity\permission\ipaccesscontrolcategory$ipaccesscontrolcategoryid][1]/ */
/* Type: array */
/* Expiration: 2022-05-21T17:57:26+09:00 */



$loaded = true;
$expiration = 1653123446;

$data = array();

/* Child Type: array */
$data['return'] = array (
  0 => 
  Doctrine\ORM\Mapping\Column::__set_state(array(
     'name' => 'iaccID',
     'type' => 'integer',
     'length' => NULL,
     'precision' => NULL,
     'scale' => NULL,
     'unique' => false,
     'nullable' => false,
     'insertable' => true,
     'updatable' => true,
     'enumType' => NULL,
     'options' => 
    array (
      'unsigned' => true,
      'comment' => 'The IP Access Control Category identifier',
    ),
     'columnDefinition' => NULL,
     'generated' => NULL,
  )),
  1 => 
  Doctrine\ORM\Mapping\Id::__set_state(array(
  )),
  2 => 
  Doctrine\ORM\Mapping\GeneratedValue::__set_state(array(
     'strategy' => 'AUTO',
  )),
);

/* Child Type: integer */
$data['createdOn'] = 1652734034;
