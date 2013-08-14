<?php
/******************************************************************************
 *      Field.php                                                             *
 *      - Defines an interface for manipulating enquiry fields                *
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
  class Enquiry_Field {

    /**
     *   data operation constants for enquiry field
     *
     */
    const FIELD     = '557ce059-dcf5-40d7-959a-237e835187a9';
    const OPERATOR  = 'e167e204-0be0-4dc1-b7aa-403e3489a56e';
    const VALUE     = 'd9b04ddb-f613-4b75-bd0d-e38176746b13';

    /**
     * Holds an enquiry field tuple
     * @var $_fields
     */
    private $_fields = array();

    private static $_fieldset = array(
      Enquiry_Field::FIELD    => 'field',
      Enquiry_Field::OPERATOR => 'operator',
      Enquiry_Field::VALUE    => 'value'
    );

    /**
     * Adds a new enquiry data operation field
     * @param string      $field    the enquiry field name
     * @param OFSOperator $operator the operator see OFSOperator.php for operator types
     * @param string      $value    the data content
     *  @returns object $this
     *
     */
    public function add($field, $operator, $value){

      $actual_operator = OFSOperator::get_value($operator);

      $data_content = array(
        self::$_fieldset[Enquiry_Field::FIELD]    => $field,
        self::$_fieldset[Enquiry_Field::OPERATOR] => $actual_operator,
        self::$_fieldset[Enquiry_Field::VALUE]    => $value
      );

      $this->_fields[] = $data_content;

      return $this;
    }

    /**
     * Creates a data content string
     *
     *  @returns string $data_string
     *
     */
    public function __toString(){
      $content_template = "%s:%s=%s,";
      $data_string      = null;

      foreach($this->_fields as $field){
        $substring = sprintf(
          $content_template,
          $field[self::$_fieldset[Enquiry_Field::FIELD]],
          $field[self::$_fieldset[Enquiry_Field::OPERATOR]],
          $field[self::$_fieldset[Enquiry_Field::VALUE]]
        );

        $data_string .= $substring;
      }

      $data_string = rtrim($data_string, ",");

      return $data_string;
    }
  }
?>

