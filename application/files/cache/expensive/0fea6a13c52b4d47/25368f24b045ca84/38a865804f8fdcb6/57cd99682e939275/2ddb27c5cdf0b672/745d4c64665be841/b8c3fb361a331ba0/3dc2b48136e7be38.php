<?php 
/* Cachekey: cache/stash_default/doctrine/[concrete\core\entity\file\version][1]/ */
/* Type: array */
/* Expiration: 2022-05-27T19:04:05+09:00 */



$loaded = true;
$expiration = 1653645845;

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
     'name' => 'FileVersions',
     'schema' => NULL,
     'indexes' => 
    array (
      0 => 
      Doctrine\ORM\Mapping\Index::__set_state(array(
         'name' => 'fvFilename',
         'columns' => 
        array (
          0 => 'fvFilename',
        ),
         'fields' => NULL,
         'flags' => NULL,
         'options' => NULL,
      )),
      1 => 
      Doctrine\ORM\Mapping\Index::__set_state(array(
         'name' => 'fvExtension',
         'columns' => 
        array (
          0 => 'fvExtension',
        ),
         'fields' => NULL,
         'flags' => NULL,
         'options' => NULL,
      )),
      2 => 
      Doctrine\ORM\Mapping\Index::__set_state(array(
         'name' => 'fvType',
         'columns' => 
        array (
          0 => 'fvType',
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
