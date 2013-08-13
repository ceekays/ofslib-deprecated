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

    private static $_soap_client      = null;
    private static $_web_service_url  = null;

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
  }
?>

