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
    /* connection related messages */
    const CONNECTION_FAILURE      = "Unable to connect. Error: '%s'";
    const SOAPFAULT_EXCEPTION     = "Unable to execute your OFS Request. Reason: '%s'";
    const UNDEFINED_CHANNEL       = "Channel is undefined.";
    const UNDEFINED_WEBSERVICE    = "Undefined endpoint webservice link.";

    /* enquiry and transaction related messages */
    const READONLY_FIELD          = "Cannot modify '%s'. It is readonly.";
    const UNDEFINED_FIELD         = "Expected '%s' but has not been defined or supplied.";
    const UNDEFINED_USER_OPTIONS  = "Undefined user information.";
    const UNKNOWN_AUTHORISER      = "Unknown authoriser type '%s' supplied";
    const UNKNOWN_FIELDS          = "Unknown fields supplied: '%s'.";
    const UNKNOWN_FUNCTION_TYPE   = "Unknown function type '%s' supplied";
    const UNKNOWN_GTS_CONTROL     = "Unknown GTS control '%s' supplied";
    const UNKNOWN_PROCESSING_FLAG = "Unknown processing flag '%s' supplied";
    const UNKNOWN_TRANSACTION_OPTION = "Unknown transaction option '%s' supplied";
    const WRONG_DATA              = "Wrong data format supplied. Expected '%s'";
    const WRONG_FIELD_COUNT       = "You supplied wrong number of arguments.";
  }
?>

