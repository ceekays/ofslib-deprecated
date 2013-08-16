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
    const LISTING         = 'b3503fae-d85f-4572-ba46-d01cb4676997';
    const PROCESSING_FLAG = 'ae659a39-6ef5-408c-80ca-907329fe7b1c';
    const VERSION_NAME    = '1f91c755-7d7c-4c6e-9a45-e934bb70443d';

    /**
     * Holds a list of readonly attributes
     * @var $_forbidden_options
     */
    private static $_forbidden_options = array('listing');

    /**
     * Holds a list of accessible fields
     * @var $_options_list
     */
    private static $_options_list = array(
      Transaction_Option::AUTHORISERS     => 'authorisers',
      Transaction_Option::FUNCTION_TYPE   => 'function_type',
      Transaction_Option::GTS_CONTROL     => 'gts_control',
      Transaction_Option::LISTING         => 'listing',
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

      if('listing' == $option){
        $transaction_options = array_values(self::$_options_list);

          foreach($transaction_options as $key){
            if('listing' == $key) continue;

            if(isset($this->_transaction_options[$key])){
              $value[$key] = $this->_transaction_options[$key];
            }
            else{
              $value[$key] = null;
            }
          }
      }
      elseif(isset($this->_transaction_options[$option]))
        $value = $this->_transaction_options[$option];

      return $value;
    }

    /**
     * Writes data to magic properties
     *
     * @param string $option the name of the property
     * @param mixed  $value
     *
     */
    public function __set($option, $value){
      if(!in_array($option, array_values(self::$_options_list))){
        throw new OFSException(
          SyntaxError::UNKNOWN_TRANSACTION_OPTION,
          $option
        );
      }

      if(in_array($option, array_values(self::$_forbidden_options))){
        throw new OFSException(
          SyntaxError::READONLY_FIELD,
          $option
        );
      }

      switch($option){

        case 'authorisers':
          if(!in_array($value, Authoriser::get_authoriser_list())){
            throw new OFSException(
              SyntaxError::UNKNOWN_AUTHORISER,
              $value
            );
          }

          $authoriser = Authoriser::get_authoriser_value($value);
          $this->_transaction_options[$option] = $authoriser;
        break;

        case 'function_type':
          if(!in_array($value, FunctionType::get_function_type_list())){
            throw new OFSException(
              SyntaxError::UNKNOWN_FUNCTION_TYPE,
              $value
            );
          }

          $function_type = FunctionType::get_function_type_value($value);
          $this->_transaction_options[$option] = $function_type;
        break;

        case 'gts_control':
          if(!in_array($value, GTSControl::get_gts_control_list())){
            throw new OFSException(
              SyntaxError::UNKNOWN_GTS_CONTROL,
              $value
            );
          }

          $gts_control = GTSControl::get_gts_control_value($value);
          $this->_transaction_options[$option] = $gts_control;
        break;

        case 'processing_flag':
          if(!in_array($value, ProcessingFlag::get_processing_flag_list())){
            throw new OFSException(
              SyntaxError::UNKNOWN_PROCESSING_FLAG,
              $value
            );
          }

          $processing_flag = ProcessingFlag::get_processing_flag_value($value);
          $this->_transaction_options[$option] = $processing_flag;
        break;

        default:
          $this->_transaction_options[$option] = $value;
        break;
      }
    }
  }
?>

