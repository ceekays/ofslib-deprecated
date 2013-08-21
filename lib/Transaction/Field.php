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
    const VALUE         = 'a6090045-d6c7-4e47-b78f-718db451785f';
    const MULTI_VALUE   = '686aaecf-998a-4414-9cb3-2e10ee5fe92f';
    const SUB_VALUE     = '5e3e83e5-d882-4dd1-aa95-76b7ec952500';

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
      Transaction_Field::VALUE        => 'value',
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
    public function add($field, $value, $multi_value=1, $sub_value=1){

      $data_content = array(
        self::$_fieldset[Transaction_Field::FIELD]        => $field,
        self::$_fieldset[Transaction_Field::VALUE]        => $value,
        self::$_fieldset[Transaction_Field::MULTI_VALUE]  => $multi_value,
        self::$_fieldset[Transaction_Field::SUB_VALUE]    => $sub_value
      );

      $this->_fields[] = $data_content;

      return $this;
    }

    /**
     * Fetches for a value of a given field
     *
     * @param string  $field        the transaction response field name
     * @param int     $multi_value  multi value number
     * @param int     $sub_value    sub-value number
     * @returns $value
     *
     */
    public function fetch($field_name, $multi_value=1, $sub_value=1){
      $value = null;
      $field_accessor = self::$_fieldset[Transaction_Field::FIELD];
      $vm_accessor    = self::$_fieldset[Transaction_Field::MULTI_VALUE];
      $sm_accessor    = self::$_fieldset[Transaction_Field::SUB_VALUE];
      $value_accessor = self::$_fieldset[Transaction_Field::VALUE];

      foreach($this->_fields as $field){
        if(
              $field[$field_accessor] == $field_name
          &&  $field[$vm_accessor]    == $multi_value
          &&  $field[$sm_accessor]    == $sub_value
        ){
          $value = $field[$value_accessor];
          break;
        }
      }

      return $value;
    }
    /**
     * Creates a data content string
     *
     *  @returns string $data_string
     *
     */
    public function __toString(){
      $content_template = "%s:%s:%s=%s,";
      $data_string      = null;

      foreach($this->_fields as $field){
        $substring = sprintf(
          $content_template,
          $field[self::$_fieldset[Transaction_Field::FIELD]],
          $field[self::$_fieldset[Transaction_Field::MULTI_VALUE]],
          $field[self::$_fieldset[Transaction_Field::SUB_VALUE]],
          $field[self::$_fieldset[Transaction_Field::VALUE]]
        );

        $data_string .= $substring;
      }

      $data_string = rtrim($data_string, ",");

      return $data_string;
    }
  }
?>

