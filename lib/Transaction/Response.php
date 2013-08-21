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
    private static $_forbidden_fields = array(
      'has_error',
      'has_override',
      'message',
      'text'
    );

    /**
     * Holds a list of accessible fields
     * @var $_options_list
     */
    private static $_options_list = array(
      'has_error',
      'has_override',
      'message',
      'text'
    );

    /**
     * Determines whether the response has an error
     * @var $_has_error
     */
    private $_has_error = false;

    /**
     * Determines whether the response has an override
     * @var $_has_override
     */
    private $_has_override = false;

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
        case 'has_error':
          $value = $this->_has_error;
        break;

        case 'has_override':
          $value = $this->_has_override;
        break;

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

        if('DUPLICATE.TRAP' == $field['field']){
          $this->has_error    = true;
          $this->is_duplicate = true;
        }
      }

      return $this;
    }

    /**
     * Sets header details: transaction_id, message_id and success_indicator
     *
     * @param string $record_id     the actual transaction id
     * @param string $msg_id        the message id
     * @param string $success_flag  the success indicator
     * @returns $this object
     *
     */
    private function set_header_details($record_id, $msg_id, $success_flag){
      $this->transaction_id     = $record_id;
      $this->message_id         = $msg_id;
      $this->success_indicator  = $success_flag;

      switch($this->success_indicator_type()){
        case Transaction_Response::SUCCESSFUL_TRANSACTION:
          $this->has_error    = false;
          $this->has_override = false;
        break;

        case Transaction_Response::ERROR_ENCOUNTERED:
          $this->has_error    = true;
          $this->has_override = false;
        break;

        case Transaction_Response::OVERRIDE_ENCOUNTERED:
          $this->has_error    = false;
          $this->has_override = true;
        break;

        case Transaction_Response::SYSTEM_IS_OFFLINE:
          $this->has_error    = true;
          $this->has_override = false;
        break;
      }

      return $this;
    }

    /**
     * Returns a success indicator type as defined by $_success_indicators list
     *
     * @returns $success_type the type of success indicator
     *
     */
    public function success_indicator_type(){
      $success_type = null;

      foreach(self::$_success_indicators as $success_flag_key => $value){
        if($value == $this->success_indicator){
          $success_type = $success_flag_key;
          break;
        }
      }

      return $success_type;
    }
  }
?>

