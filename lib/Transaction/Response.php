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
     * success indicator constants for a transaction response
     *
     */
    const SUCCESSFUL_TRANSACTION  = '7ae71c9e-0789-4c09-ae85-33122d3bfe0a';
    const ERROR_ENCOUNTERED       = '41f695d7-5a09-446e-b053-150c14279d51';
    const OVERRIDE_ENCOUNTERED    = '61ad2388-04f1-4b72-a254-8a69b2267e3a';
    const SYSTEM_IS_OFFLINE       = 'ae6688b8-4206-40b9-9489-1586a579fc46';

    /**
     * Holds a list of the actual success indicators
     * @var $_success_indicators
     */
    private static $_success_indicators = array(
      Transaction_Response::SUCCESSFUL_TRANSACTION  =>  1,
      Transaction_Response::ERROR_ENCOUNTERED       => -1,
      Transaction_Response::OVERRIDE_ENCOUNTERED    => -2,
      Transaction_Response::SYSTEM_IS_OFFLINE       => -3,
    );

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

      $resplen  = strlen($this->message);
      $start    = strpos($this->message, ',');

      if(($start === false))
        $hash = $this->get_error_details();
      else
        $hash = $this->extract_response_details();

      return $hash;
    }

    /**
     * Extracts the field details from the response data
     *
     * returns $this object
     */
    private function extract_response_details(){
      $start  = strpos($this->message, ',');
      $header = explode('/', substr($this->message, 0, $start));
      $data   = explode(',', substr($this->message, $start + 1));

      $this->set_header_details($header[0], $header[1], $header[2]);

      foreach($data as $data_field){

        $pattern  = '/(?P<field>[a-zA-Z-.0-9]*):(?P<multi_value>\d+):';
        $pattern .= '(?P<sub_value>\d+)=(?P<value>.{0,})/';

        preg_match($pattern, $data_field, $field);

        if(count($field) < 3){
          $pattern  = '/(?P<field>[a-zA-Z-.0-9]*)=(?P<value>.{0,}):';
          $pattern .= '(?P<multi_value>\d+):(?P<sub_value>\d+)/';

          preg_match($pattern, $data_field, $field);
        }

        $this->fields->add(
          $field['field'],
          $field['value'],
          $field['multi_value'],
          $field['sub_value']
        );
      }
      return $this;
    }

  }
?>

