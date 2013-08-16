<?php
/******************************************************************************
 *      GTSControl.php                                                        *
 *      - Defines GTS Control settings                                        *
 *                                                                            *
 *      - GTS Control defines what should happen when                         *
 *        an error or an override occurs during OFS processing                *
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

  class GTSControl{

    /**
     * A list of allowed GTS Control Values
     */
    const HOLD_ALL_TRANSACTIONS                   = 'ba95e787-5a3b-4130-b406-41ee3e53f5b2';
    const HOLD_ON_BOTH_ERROR_AND_OVERRIDE         = 'a9490ee4-d7a6-4feb-8b11-0289299a5bed';
    const HOLD_ON_ERROR_AND_APPROVE_ON_OVERRIDE   = '5bd371fe-2dff-4bca-8883-529c808da536';
    const REJECT_ON_ERROR_AND_APPROVE_ON_OVERRIDE = 'b86834d1-0a74-40fb-a0f9-ca58c448d132';
    const REJECT_ON_ERROR_AND_HOLD_ON_OVERRIDE    = 'cb8392e7-7fc3-4d0d-b3c2-184129bc49ce';

    /* alias for GTSControl::REJECT_ON_ERROR_AND_APPROVE_ON_OVERRIDE */
    const USE_DEFAULT = GTSControl::REJECT_ON_ERROR_AND_APPROVE_ON_OVERRIDE;

    private static $_gts_control_values = array(
      GTSControl::REJECT_ON_ERROR_AND_APPROVE_ON_OVERRIDE  => '',
      GTSControl::HOLD_ON_ERROR_AND_APPROVE_ON_OVERRIDE    => '1',
      GTSControl::REJECT_ON_ERROR_AND_HOLD_ON_OVERRIDE     => '2',
      GTSControl::HOLD_ON_BOTH_ERROR_AND_OVERRIDE          => '3',
      GTSControl::HOLD_ALL_TRANSACTIONS                    => '4'
    );

    /**
     * Retrieves the name of a given GTS Control
     *
     * @param   $gts_control GTS Control name
     * @returns $value
     *
     */
    public static function get_gts_control_value($gts_control){
      $value = null;

      if(!in_array($gts_control, FunctionType::get_function_type_list())){
        throw new OFSException(
          SyntaxError::UNKNOWN_FUNCTION_TYPE,
          $gts_control
        );
      }

      $value = self::$_gts_control_values[$gts_control];

      return $value;
    }
  }
?>

