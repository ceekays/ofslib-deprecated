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
  }
 ?>

