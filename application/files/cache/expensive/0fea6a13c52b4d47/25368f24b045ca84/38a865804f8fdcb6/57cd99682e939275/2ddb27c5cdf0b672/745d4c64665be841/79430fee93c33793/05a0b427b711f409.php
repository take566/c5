<?php 
/* Cachekey: cache/stash_default/doctrine/[concrete\core\entity\calendar\calendareventoccurrence][1]/ */
/* Type: array */
/* Expiration: 2022-05-27T19:16:41+09:00 */



$loaded = true;
$expiration = 1653646601;

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
     'name' => 'CalendarEventOccurrences',
     'schema' => NULL,
     'indexes' => 
    array (
      0 => 
      Doctrine\ORM\Mapping\Index::__set_state(array(
         'name' => 'eventdates',
         'columns' => 
        array (
          0 => 'occurrenceID',
          1 => 'startTime',
          2 => 'endTime',
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
