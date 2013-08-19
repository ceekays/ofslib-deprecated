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
     * Holds a list of fields that are forbidden from modifying
     * @var $_forbidden_fields
     */
    private static $_forbidden_fields = array('message', 'text');

    /**
     * Holds a list of accessible fields
     * @var $_options_list
     */
    private static $_options_list = array('message', 'text');

    /**
     * Holds the raw response message
     * @var $_response
     */
    protected $_response;

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
        case    'text':
        case 'message':
          $value = $this->_response;
        break;
      }

      return $value;
    }
  }
?>

