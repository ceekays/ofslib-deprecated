<?php
/******************************************************************************
 *      Request.php                                                           *
 *      - Contains methods for creating and executing a transaction request   *
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
  class Transaction_Request extends OFSConnector {

    /**
     * Holds the raw request message
     * @var $_request
     */
    private $_request = null;

    /**
     * Holds a list of fields that are forbidden from modifying
     * @var $_forbidden_fields
     */
    private static $_forbidden_fields = array(
      'message',
      'text'
    );

    /**
     * Holds a list of accessible fields
     * @var $_options_list
     */
    private static $_options_list = array(
      'message',
      'message_id',
      'name',
      'operation',
      'text',
      'transaction_id'
    );

    /**
     * Holds transaction details: transaction_id and message_id
     * @var $_transaction_details
     */
    private $_transaction_details = array();

    /**
     * Holds Transaction_Field object
     * @var $fields
     */
    public $fields = null;

    /**
     * Holds the name of a transaction operation
     * @var $_operation
     */
    private $_operation = null;

    /**
     * Holds the name of a transaction operation
     * @var $options
     */
    public $options = null;

    /**
     * Holds Transaction_Response object
     * @var $response
     */
    public $response = null;

    /**
     * Holds OFSUser object
     * @var $user
     */
    public $user = null;

    /**
     * Creates a transaction request
     *
     * @return  Transaction_Request object
     *
     */
    function Transaction_Request(){
      $this->user     = new OFSUser();
      $this->options  = new Transaction_Option();
      $this->fields   = new Transaction_Field();
      $this->response = new Transaction_Response();
    }

    /**
     * Reads data from magic properties
     *
     * @param   string $option the name of the property
     * @return  mixed  $value
     *
     */
    public function __get($option){
      $value = null;

      if(!in_array($option, self::$_options_list))
        throw new OFSException(SyntaxError::WRONG_DATA, $option);

      switch($option){
        case      'name':
        case 'operation':
          $value = $this->_operation;
        break;

        case    'text':
        case 'message':
          $value = $this->_request;
        break;

        case     'message_id':
        case 'transaction_id':
          if(isset($this->_transaction_details[$option]))
            $value = $this->_transaction_details[$option];
        break;
      }

      return $value;
    }

    /**
     * Writes data to magic properties
     *
     * @param string $option the name of the property
     * @param mixed  $value
     *
     */
    public function __set($option, $value){

      if(!in_array($option, self::$_options_list))
        throw new OFSException(SyntaxError::WRONG_DATA, $option);

      switch($option){
        case      'name':
        case 'operation':
          $this->_operation = $value;
        break;

        case    'text':
        case 'message':
          $this->_request = $value;
        break;

        case     'message_id':
        case 'transaction_id':
            $this->_transaction_details[$option] = $value;
        break;
      }
    }

    /**
     * Creates a transaction request message in the form:
     * OPERATION,VERSION_NAME/FUNCTION_TYPE/PROCESSING_FLAG,USERNAME/PASSWORD/COMPANY,TRANSACTION_ID/MESSAGE_ID,FIELD:VM:SM=DATA
     *
     * @returns $this object
     *
     */
    public function to_ofs() {
      $transaction_request_template = "%s,%s,%s,%s,%s";

      $transaction_request = sprintf(
        $transaction_request_template,
        $this->_operation,
        $this->options->__toString(),
        $this->user->__toString(),
        $this->get_transaction_details_string(),
        $this->fields->__toString()
      );

      $this->_request = $transaction_request;

      return $this;
    }

  /**
   * Executes a transaction request and sets the transaction response
   *
   * @returns $this object
   *
   */
    public function execute(){
      $this->to_ofs();
      parent::execute_ofs($this->_request);
      $this->response->set_response($this->get_response());

      return $this;
    }
  }
?>

