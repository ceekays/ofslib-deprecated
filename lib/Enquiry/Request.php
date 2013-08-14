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
    function Enquiry_Request(){
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
    function __get($option){
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
    function __set($option, $value){
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
  }
 ?>

