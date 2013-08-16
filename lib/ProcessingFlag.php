<?php
/******************************************************************************
 *      ProcessingFlag.php                                                    *
 *      - Definitions for OFS Processing Flags                                *
 *                                                                            *
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
  class ProcessingFlag{

    /**
     * A list of allowed processing flags
     */
    const PROCESS   = '0cebda77-312a-45b3-ae62-f7e57907902c';
    const VALIDATE  = '5f5fc458-d24d-4fbf-97f7-6700725f59ee';

    /**
     * Holds the actual names of the processing flags
     * @var $_processing_flag_names
     */
    private static $_processing_flag_names = array(
      ProcessingFlag::PROCESS   => 'PROCESS',
      ProcessingFlag::VALIDATE  => 'VALIDATE'
    );

    /**
     * Retrieves the name of a given processing flag
     *
     * @param   $flag the processing flag
     * @returns $name
     *
     */
    public static function get_processing_flag_value($flag){
      $name = null;

      if(!in_array($flag, ProcessingFlag::get_processing_flag_list())){
        throw new OFSException(
          SyntaxError::UNKNOWN_PROCESSING_FLAG,
          $flag
        );
      }

      $name = self::$_processing_flag_names[$flag];

      return $name;
    }
  }
?>
