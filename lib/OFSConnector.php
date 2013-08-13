<?php
/******************************************************************************
 *      OFSConnector.php                                                      *
 *      - Manages OFS connection settings for the remote server               *
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
  class OFSConnector{

    /**
     * An array of channels: default and custom
     * @var $_channel
     */
    private static $_channel = array();

    /**
     * Holds a persistent SoapClient instance
     * @var $_soap_client
     */
    private static $_soap_client = null;

    /**
     * Holds the actual webservice link
     * @var $_web_service_url
     */
    private static $_web_service_url = null;

    /**
     * Holds the raw OFS request text
     * @var     string $_request
     */
    private $_request;

    /**
     * Holds the raw OFS response text
     * @var     string $_response
     */
    private $_response;

    /**
     * Connects to the remote T24/Globus server and keeps a persistent connection
     *
     * @param   string $web_service_url the actual webservice link
     * @return  void
     *
     */
    public static function connect($web_service_url){
      self::$_web_service_url = $web_service_url;

      try{
        try{
          self::$_soap_client = new SoapClient(self::$_web_service_url);
        }
        catch(Exception $ex){
          throw new OFSException(
            SyntaxError::CONNECTION_FAILURE,
            $ex->getMessage()
          );
        }
      }
      catch(OFSException $ex){
        throw new OFSException(
          SyntaxError::CONNECTION_FAILURE,
          $ex->getMessage()
        );
      }
    }

    /**
     * Sets the default OFS channel
     *
     * @param  string $channel the name of the OFS channel that will be used
     * @return void
     *
     */
    public static function set_default_channel($channel){
      self::$_channel['default'] = $channel;
    }

    /**
     * Sets the custom OFS channel
     *
     * @param  string $channel the name of the custom OFS channel
     * @return void
     *
     */
    public static function set_custom_channel($channel){
      self::$_channel['custom'] = $channel;
    }

    /**
     * Executes given OFS message
     *
     * @param  string $request the OFS request message
     * @return object $this
     *
     */
    protected function execute_ofs($request){
      $channel_to_use   = null;
      $this->_response  = null;

      $this->_request = $request;

      if($this->has_custom_channel())
        $channel_to_use = $this->get_custom_channel();
      else
        $channel_to_use = $this->get_default_channel();

      if(empty($channel_to_use))
        throw new OFSException(SyntaxError::UNDEFINED_CHANNEL);

      $this->send_ofs($channel_to_use);

      return $this;
    }

    /**
     * Executes a given OFS message via a specified channel
     *
     * @param   string $request the OFS request message
     * @param   string  $channel_to_use actual to use
     * @return object $this
     *
     */
    protected function execute_ofs_by_channel($request, $channel_to_use){
      $channel          = null;
      $this->_response  = null;
      $this->_request   = $request;

      if(empty($channel_to_use))
        throw new OFSException(SyntaxError::UNDEFINED_CHANNEL);

      if($channel_to_use == OFSConnector::DEFAULT_CHANNEL){
        $channel = $this->get_default_channel();
      }
      elseif($channel_to_use == OFSConnector::CUSTOM_CHANNEL){
        $channel = $this->get_custom_channel();
      }
      else{
        $channel = $channel_to_use;
      }

      $this->send_ofs($channel);

      return $this;
    }

    /**
     * Checks whether the current OFS instance has a custom channel
     *
     * @return boolean $has_channel
     *
     */
    protected function has_custom_channel(){
      $has_channel = false;

      if((isset(self::$_channel['custom']) && !empty(self::$_channel['custom']))
        $has_channel = true;
      else
        $has_channel = false;

      return $has_channel;
    }

    /**
     * Returns a default OFS channel
     *
     * @returns self::$_channel['default']
     */
    protected function get_default_channel(){
      return isset(self::$_channel['default']) ? self::$_channel['default'] : null;
    }

    /**
     * Returns a custom OFS channel
     *
     * @returns self::$_channel['custom']
     */
    protected function get_custom_channel(){
      return isset(self::$_channel['custom']) ? self::$_channel['custom'] : null;
    }

    /**
     * Sends the OFS message to the remote T24/Globus server
     *
     * @returns void
     */
    private function send_ofs($channel_to_use){
      $this->_response = null;

      try{
        if(empty($channel_to_use))
          throw new OFSException(SyntaxError::UNDEFINED_CHANNEL);

        if(empty(self::$_web_service_url))
          throw new OFSException(SyntaxError::UNDEFINED_WEBSERVICE);

        $this->_response = self::$_soap_client->executeOFS(
          $channel_to_use,
          $this->_request
        );
      }
      catch(SoapFault $ex){
        $this->_response = null;
        throw new OFSException(
          SyntaxError::SOAPFAULT_EXCEPTION,
          $ex->faultstring
        );
      }
    }

    /**
     * Retrieves an OFS response
     *
     * @returns $this->_response
     */
    protected function get_response(){
      return $this->_response;
    }
  }
?>

