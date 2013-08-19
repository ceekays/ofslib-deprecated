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
    const FIELD         = '83a2d051-9894-41f8-8cce-763145d351e1';
    const MULTI_VALUE  = '686aaecf-998a-4414-9cb3-2e10ee5fe92f';
    const SUB_VALUE    = '5e3e83e5-d882-4dd1-aa95-76b7ec952500';

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
      Transaction_Field::FIELD        => 'field',
      Transaction_Field::MULTI_VALUE  => 'multi_value',
      Transaction_Field::SUB_VALUE    => 'sub_value'
    );

    /**
     * Adds a new transaction field
     *
     * @param string  $field        the transaction field name
     * @param int     $multi_value  multi value number
     * @param int     $sub_value    sub-value number
     * @returns object $this
     *
     */
    public function add($field, $multi_value=1, $sub_value=1){

      $data_content = array(
        self::$_fieldset[Transaction_Field::FIELD]        => $field,
        self::$_fieldset[Transaction_Field::MULTI_VALUE]  => $multi_value,
        self::$_fieldset[Transaction_Field::SUB_VALUE]    => $sub_value
      );

      $this->_fields[] = $data_content;

      return $this;
    }
  }
?>

