<?php
/******************************************************************************
 *      OFSUser.php                                                           *
 *      - Defines an interface for OFS user information                       *
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

  class OFSUser{

    /* OFS user information constants */
    const USERNAME    = 'b203bfc2-0b6f-41d8-894f-cffe3a8f2d2b';
    const PASSWORD    = '10722f2b-4907-4836-840b-fcd30489aeef';
    const COMPANY     = 'd2623728-e25e-4621-9651-a10ea8e3b918';

    /**
     * Holds an array of instance-specific user information
     * @var $_locals
     */
    private $_locals = array();

    /**
     * Determines what user information to use for a given transaction/enquiry:
     * whether "default" or "instance specific"
     * @var $_use_defaults
     */
    private $_use_defaults = false;

    /**
     * Holds an array of default/global user information
     * @var $_defaults
     */
    private static $_defaults = array();

    /**
     * Holds an array of accessible fields
     * @var $_options_list
     */
    private static $_options_list = array(
      'company',
      'password',
      'username'
    );

    /**
     * Reads data from private user properties
     *
     * @param   string  $option the property being accessed
     * @return  mixed   $values
     *
     */
    public function __get($option){
      $values = array();

      if('default_' == substr($option, 0, 8))
        $values = $this->get_default_options(substr($option, 8));
      else
        $values = $this->get_instance_options($option);

      return $values;
    }

    /**
     * Writes data to private user properties
     *
     * @param   string  $option the property name
     * @param   mixed   $value the value being assigned
     *
     */
    public function __set($option, $value){
      if('default_' == substr($option, 0, 8))
        $this->set_default_options(substr($option, 8), $value);
      else
        $this->set_instance_options($option, $value);
    }

    /**
     * Reads a given property from default user properties
     *
     * @param   string  $option the property being accessed
     * @return  mixed   $values
     *
     */
    private function get_default_options($option){
      $values = array();

      if($option == 'information'){
          foreach(self::$_options_list as $option){
            if(isset(self::$_defaults[$option])){
              $values[$option] = self::$_defaults[$option];
            }
            else{
              $values[$option] = null;
            }
          }
        }
      elseif(  !empty(self::$_defaults)
            && array_key_exists($option, self::$_defaults)
      ){
        $values = self::$_defaults[$option];
      }
      elseif(in_array($option, self::$_options_list)){
        $values = null;
      }
      else{
        throw new OFSException(SyntaxError::UNDEFINED_FIELD, $option);
      }

      return $values;
    }

    /**
     * Reads a given property from instance specific user properties
     *
     * @param   string  $option the property being accessed
     * @return  mixed   $values
     *
     */
    private function get_instance_values($option){
      $values = array();

      if($option == 'information'){
          foreach(self::$options_list as $option){
            if(isset($this->_locals[$option])){
              $values[$option] = $this->_locals[$option];
            }
            else{
              $values[$option] = null;
            }
          }
        }
      elseif(   !empty($this->_locals)
            &&  array_key_exists($option, $this->_locals)
      ){
        $values = $this->_locals[$option];
      }
      elseif(in_array($option, self::$options_list)){
        $values = null;
      }
      else{
        throw new OFSException(SyntaxError::UNDEFINED_FIELD, $option);
      }

      return $values;
    }

    /**
     * Sets a given property to default user properties
     *
     * @param string  $option the name of the property
     * @param mixed   $values the actual values
     *
     */
    private function set_default_options($option, $values){

      if($option == 'information'){
        if(!is_hash($values)){
          throw new OFSException(SyntaxError::WRONG_DATA, 'a hash');
        }

        $array_keys = array_keys($values);
        $array_diff = array_diff($array_keys, self::$options_list);

        if(!empty($array_diff)){
          throw new OFSException(
            SyntaxError::UNKNOWN_FIELDS,
            join(',', $array_diff)
          );
        }

        foreach($values as $key => $data){
          self::$_defaults[$key] = $data;
        }
      }
      elseif(in_array($option, self::$options_list)){
        self::$_defaults[$option] = $values;
      }
      else{
        throw new OFSException(SyntaxError::UNKNOWN_FIELDS, $option);
      }
    }

    /**
     * Sets a given property to instance specific user properties
     *
     * @param string  $option the name of the property
     * @param mixed   $values the actual values
     *
     */
    private function set_instance_options($option, $values){

      if($option == 'information'){
        if(!is_hash($value)){
          throw new OFSException(SyntaxError::WRONG_DATA, 'a hash');
        }

        $array_keys = array_keys($values);
        $array_diff = array_diff($array_keys, self::$options_list);

        if(!empty($array_diff)){
          throw new OFSException(
            SyntaxError::UNKNOWN_FIELDS,
            join(',', $array_diff)
          );
        }

        foreach($values as $key => $data){
          $this->_locals[$key]  = $data;
        }
      }
      elseif(in_array($option, self::$options_list)){
        $this->_locals[$option] = $values;
      }
      else{
        throw new OFSException(SyntaxError::UNKNOWN_FIELDS, $option);
      }
    }
  }
?>

