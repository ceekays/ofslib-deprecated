<?php
/******************************************************************************
 *      Response.php                                                          *
 *      - Contains methods for manipulating a transaction response            *
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
  class Transaction_Response extends OFSConnector {

    /**
     * Holds a list of fields that are forbidden from modifying
     * @var $_forbidden_fields
     */
    private static $_forbidden_fields = array('message', 'text');

    /**
     * Holds a list of accessible fields
     * @var $_options_list
     */
    private static $_options_list = array('message', 'text');

    /**
     * Holds the raw response message
     * @var $_response
     */
    protected $_response;

    /**
     * Holds Transaction_Field object
     * @var $fields
     */
    public $fields = null;

    /**
     * Creates a transaction response
     *
     * @return  Transaction_Response object
     *
     */
    public function Transaction_Response() {
      $this->fields = new Transaction_Field();
    }

    /**
     * Reads data from internal attributes
     *
     * @param   string $option the name of the property
     * @returns mixed  $value
     *
     */
    public function __get($option){
      $value = null;

      if(!in_array($option, self::$_options_list))
        throw new OFSException(SyntaxError::WRONG_DATA, $option);

      switch($option){
        case    'text':
        case 'message':
          $value = $this->_response;
        break;
      }

      return $value;
    }

    /**
     * Sets an OFS response
     *
     */
    public function set_response($text){
      $this->_response = $text;
    }

    /**
     * Interprets a transaction response of the form:
     *  TRANSACTION ID/MESSAGE ID/SUCCESS INDICATOR, RESPONSE DATA
     */
    public function to_hash(){
      $matches  = null;
      $hash     = null;

      preg_match_all('/([\,\/])/', $this->message, $matches);

      if(count($matches[0]) >= 3)
        $hash = $this->get_response_details();
      else
        $hash = $this->get_error_details();

      return $hash;
    }

  }
?>

