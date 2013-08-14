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

