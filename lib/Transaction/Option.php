<?php
/******************************************************************************
 *      Option.php                                                            *
 *      - Defines an interface for transaction options                        *
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
  class Transaction_Option{

    /**
     *   constants for transaction options
     *
     */
    const AUTHORISERS     = '7cc34cbf-839b-41df-9d8f-075093e3fe5b';
    const FUNCTION_TYPE   = 'de16a64e-a830-4672-bac4-60d6f2beb282';
    const GTS_CONTROL     = '87bd3d87-05d5-4df9-a8a5-055f2f27b18e';
    const PROCESSING_FLAG = 'ae659a39-6ef5-408c-80ca-907329fe7b1c';
    const VERSION_NAME    = '1f91c755-7d7c-4c6e-9a45-e934bb70443d';

    /**
     * Holds a list of accessible fields
     * @var $_options_list
     */
    private static $_options_list = array(
      Transaction_Option::AUTHORISERS     => 'authorisers',
      Transaction_Option::FUNCTION_TYPE   => 'function_type',
      Transaction_Option::GTS_CONTROL     => 'gts_control',
      Transaction_Option::PROCESSING_FLAG => 'processing_flag',
      Transaction_Option::VERSION_NAME    => 'version_name'
    );

    /**
     * Holds transaction options
     * @var $_transaction_options
     */
    private $_transaction_options = array();

    /**
     * Reads data from magic properties
     *
     * @param   string $option the name of the property
     * @return  mixed  $value
     *
     */
    public function __get($option){
      $value = null;

      if(!in_array($option, array_values(self::$_options_list)))
        throw new OFSException(SyntaxError::UNKNOWN_FIELDS, $option);

      if(isset($this->_transaction_options[$option]))
        $value = $this->_transaction_options[$option];

      return $value;
    }
  }
?>

