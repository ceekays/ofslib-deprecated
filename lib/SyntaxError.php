<?php
/******************************************************************************
 *      SyntaxError.php                                                       *
 *      - Contains all the different OFSLib error/exception messages          *
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

  class SyntaxError{
    const CONNECTION_FAILURE      = "Unable to connect. Error: '%s'";
    const SOAPFAULT_EXCEPTION     = "Unable to execute your OFS Request. Reason: '%s'";
    const UNDEFINED_CHANNEL       = "Channel is undefined.";
    const UNDEFINED_WEBSERVICE    = "Undefined endpoint webservice link.";
  }
?>

