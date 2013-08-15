<?
/******************************************************************************
 *      Transaction.php                                                       *
 *      - Defines interface for creating and accessing a transaction          *
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
  class Transaction{

    /**
     * Holds the Transaction_Request() object
     * @var $request
     */
    public $request;

    /**
     * Holds the Transaction_Response() object
     * @var $response
     */
    public $response;

    /**
     * Creates an Transaction
     *
     * @return  Transaction object
     *
     */
    public function Transaction(){
      $this->request   = new Transaction_Request();
      $this->response  = $this->request->response;
    }
  }
?>

