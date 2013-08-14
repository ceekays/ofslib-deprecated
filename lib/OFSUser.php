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
  }
?>

