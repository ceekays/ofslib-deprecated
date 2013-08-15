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
     * Holds the name of an transaction operation
     * @var $operation
     */
    public $operation = null;

    /**
     * Holds the name of an transaction operation
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

  }
?>

