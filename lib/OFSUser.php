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
      OFSUser::COMPANY  => 'company',
      OFSUser::PASSWORD => 'password',
      OFSUser::USERNAME =>'username'
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
          foreach(self::$_options_list as $key){
            if(isset(self::$_defaults[$key])){
              $values[$key] = self::$_defaults[$key];
            }
            else{
              $values[$key] = null;
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
        throw new OFSException(SyntaxError::UNDEFINED_FIELD, 'default_'.$option);
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
    private function get_instance_options($option){
      $values = array();

      if($option == 'information'){
          foreach(self::$_options_list as $key){
            if(isset($this->_locals[$key])){
              $values[$key] = $this->_locals[$key];
            }
            else{
              $values[$key] = null;
            }
          }
        }
      elseif(   !empty($this->_locals)
            &&  array_key_exists($option, $this->_locals)
      ){
        $values = $this->_locals[$option];
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

        $array_diff = array_diff(
          array_keys($values),
          array_keys(self::$_options_list)
        );

        if(!empty($array_diff)){
          throw new OFSException(
            SyntaxError::UNKNOWN_FIELDS,
            join(',', $array_diff)
          );
        }

        foreach($values as $key => $data){
          self::$_defaults[self::$_options_list[$key]] = $data;
        }
      }
      elseif(in_array($option, array_values(self::$_options_list))){
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
        if(!is_hash($values)){
          throw new OFSException(SyntaxError::WRONG_DATA, 'a hash');
        }

        $array_diff = array_diff(
          array_keys($values),
          array_keys(self::$_options_list)
        );

        if(!empty($array_diff)){
          throw new OFSException(
            SyntaxError::UNKNOWN_FIELDS,
            join(',', $array_diff)
          );
        }

        foreach($values as $key => $data){
          $this->_locals[self::$_options_list[$key]]  = $data;
        }
      }
      elseif(in_array($option, self::$_options_list)){
        $this->_locals[$option] = $values;
      }
      else{
        throw new OFSException(SyntaxError::UNKNOWN_FIELDS, $option);
      }
    }

    /**
     * Turns on and off use of default user information
     *
     * @param boolean $flag true/false parameter
     * @returns void
     *
     */
    public function use_defaults($flag){
      if(true == $flag || false == $flag)
        $this->_use_defaults = $flag;
      else
        throw new OFSException(SyntaxError::WRONG_DATA, ' true or false');
    }


    /**
     * Checks whether to use default user information
     *
     * @returns $this->_use_defaults
     *
     */
    public function should_use_defaults(){
      return $this->_use_defaults;
    }

    /**
     * Creates an OFS user information string
     *
     * @returns $user_details
     *
     */
    public function __toString(){
      $user_details = null;
      if($this->should_use_defaults()){
        $user_details = sprintf(
          "%s/%s/%s",
          $this->default_username,
          $this->default_password,
          $this->default_company
        );
      }
      else{
        // localised options take higher precedence
        if (null != $this->username) $username = $this->username;
        else $username = $this->default_username;

        if (null != $this->password) $password = $this->password;
        else $password = $this->default_password;

        if (null != $this->company) $company = $this->company;
        else $company = $this->default_company;

        $user_details = sprintf(
          "%s/%s/%s",
          $username,
          $password,
          $company
        );
      }
      return $user_details;
    }
  }
?>

