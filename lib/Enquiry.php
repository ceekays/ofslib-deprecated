<?php
/******************************************************************************
 *      Enquiry.php                                                           *
 *      - Defines interface for creating and accessing an enquiry             *
 *                                                                            *
 *      https://github.com/ceekays/ofslib                                     *
 *                                                                            *
 ******************************************************************************
 *                                                                            *
 *      Created in July 2013                                                  *
 *      by Edmond C. Kachale (Malawi)                                         *
 *      (kachaleedmond [at] gmail [dot] com)                                  *
 *                                                                            *
 ******************************************************************************/
  class Enquiry{

    /**
     *   data operation constants for enquiry
     *
     */
    const FIELD   = '557ce059-dcf5-40d7-959a-237e835187a9';
    const OPERAND = 'e167e204-0be0-4dc1-b7aa-403e3489a56e';
    const VALUE   = 'd9b04ddb-f613-4b75-bd0d-e38176746b13';

    /**
     * Holds the Enquiry_Request() object
     * @var $request
     */
    public $request;

    /**
     * Holds the Enquiry_Response() object
     * @var $response
     */
    public $response;

    /**
     * Creates an Enquiry
     *
     * @return  Enquiry object
     *
     */
    public function Enquiry(){
      $this->request   = new Enquiry_Request();
      $this->response  = $this->request->response;
    }
  }
?>

