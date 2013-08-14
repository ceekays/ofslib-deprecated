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
  }
 ?>

