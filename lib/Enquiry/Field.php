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
     * Holds an enquiry field tuple
     * @var $_fields
     */
    private $_fields = array();

    /**
     * Adds a new enquiry data operation field
     * @param string      $field    the enquiry field name
     * @param OFSOperator $operator the operator see OFSOperator.php for operator types
     * @param string      $value    the data content
     *  @returns object $this
     *
     */
    public function add($field, $operator, $value){

      $actual_operator = OFSOperator::get_operator_name($operator);

      $data_content = array(
        Enquiry::FIELD    => $field,
        Enquiry::OPERATOR => $actual_operator,
        Enquiry::VALUE    => $value
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
          $field[Enquiry::FIELD],
          $field[Enquiry::OPERATOR],
          $field[Enquiry::VALUE]
        );

        $data_string .= $substring;
      }

      $data_string = rtrim($data_string, ",");

      return $data_string;
    }
  }
?>

