<?php
/******************************************************************************
 *      Request.php                                                           *
 *      - Contains methods for creating and executing an enquiry request      *
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
  class Enquiry_Request extends OFSConnector {
    /**
     * Holds the actual enquiry name
     * @var $_name
     */
    private $_name = null;

    /**
     * Holds the raw request message
     * @var $_request
     */
    private $_request = null;

    /**
     * Holds a list of fields that are forbidden from modifying
     * @var $_forbidden_fields
     */
    private $_forbidden_fields = array('message', 'text');

    /**
     * Holds the name of an enquiry operation
     * @var $_operation
     */
    private $_operation = 'ENQUIRY.SELECT';

    /**
     * Holds a list of accessible fields
     * @var $_options_list
     */
    private $_options_list = array('name', 'message', 'text');

    /**
     * Holds Enquiry_Field object
     * @var $fields
     */
    public $fields = null;

    /**
     * Holds Enquiry_Response object
     * @var $response
     */
    public $response = null;

    /**
     * Holds OFSUser object
     * @var $user
     */
    public $user = null;

    /**
     * Creates an enquiry request
     *
     * @return  Enquiry_Request object
     *
     */
    public function Enquiry_Request(){
      $this->fields   = new Enquiry_Field();
      $this->response = new Enquiry_Response();
      $this->user     = new OFSUser();
    }

    /**
     * Reads data from private properties
     *
     * @param   string $option the name of the property
     * @return  mixed  $value
     *
     */
    public function __get($option){
      $value = null;

      if(!in_array($option, $this->_options_list))
        throw new OFSException(SyntaxError::WRONG_DATA, $option);

      switch($option){
        case 'name':
          $value = $this->_name;
        break;

        case    'text':
        case 'message':
          $value = $this->_request;
        break;
      }

      return $value;
    }

    /**
     * Writes data to private properties
     *
     * @param string $option the name of the property
     * @param mixed  $value
     *
     */
    public function __set($option, $value){
      if(!in_array($option, $this->_options_list))
        throw new OFSException(SyntaxError::UNKNOWN_FIELDS, $option);

      if(in_array($option, $this->_forbidden_fields))
        throw new OFSException(SyntaxError::READONLY_FIELD, $option);

      switch($option){
        case 'name':
          $this->_name = $value;
        break;

        case    'text':
        case 'message':
          $this->_request = $value;
        break;
      }
    }

  /**
   * Creates an enquiry request message in the form:
   * ENQUIRY.SELECT,,USERNAME/PASSWORD/COMPANY,ENQUIRY.NAME,FIELD:OPERAND=DATA
   *
   * @returns $this object
   *
   */
    public function to_ofs() {
      $enquiry_request_template = "%s,,%s,%s,%s";

      $enquiry_request = sprintf(
        $enquiry_request_template,
        $this->_operation,
        $this->user->__toString(),
        $this->_name,
        $this->fields->__toString()
      );

      $this->_request = $enquiry_request;

      return $this;
    }

  /**
   * Executes an enquiry request and sets the enquiry response
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

