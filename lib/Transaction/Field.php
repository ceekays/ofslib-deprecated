<?php
/******************************************************************************
 *      Field.php                                                             *
 *      - Defines an interface for managing transaction fields                *
 *                                                                            *
 *      https://github.com/ceekays/ofslib                                     *
 *                                                                            *
 ******************************************************************************
 *                                                                            *
 *      Created in August 2013                                                *
 *      by Edmond C. Kachale (Malawi)                                         *
 *      (kachaleedmond [at] gmail [dot] com)                                  *
 *                                                                            *
 ******************************************************************************/
  class Transaction_Field{

    /**
     *   data operation constants for a transaction field
     *
     */
    const FIELD               = '83a2d051-9894-41f8-8cce-763145d351e1';
    const MULTI_VALUE_NUMBER  = '686aaecf-998a-4414-9cb3-2e10ee5fe92f';
    const SUB_VALUE_NUMBER    = '5e3e83e5-d882-4dd1-aa95-76b7ec952500';

    /**
     * Holds a transaction field tuple
     * @var $_fields
     */
    private $_fields = array();

    /**
     * Holds a list of accessible transaction fields
     * @var $_options_list
     */
    private static $_fieldset = array(
      Transaction_Field::FIELD               => 'field',
      Transaction_Field::MULTI_VALUE_NUMBER  => 'multi_value',
      Transaction_Field::SUB_VALUE_NUMBER    => 'sub_value'
    );
  }
?>

