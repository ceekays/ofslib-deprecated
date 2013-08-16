<?php
/******************************************************************************
 *      FunctionType.php                                                      *
 *      - Defines OFS function types                                          *
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

  class FunctionType{

    /**
     * A list of allowed function types
     */
    const AUTHORISE = '666e16ab-f825-4b2c-887e-f43f721efb8b';
    const DELETE    = '49970220-284e-4cda-8d2f-ac7efbe96de6';
    const INPUT     = 'd9cef70b-bed9-4965-9ac6-55a2092dbc31';
    const NONE      = 'e73e1555-2d26-4dc1-9186-445d2400cc2a';
    const REVERSE   = '5eb22e74-7b58-4847-a798-b36061047f2a';
    const SEE       = 'c158389b-fb48-41f4-af1b-01d5fb21f4b7';
    const VERIFY    = 'c92b2962-b780-4c1a-87ea-0c09b13b16c6';

    /**
     * Holds the actual names of the function type names
     * @var $_function_type_names
     */
    private static $_function_type_names = array(
      FunctionType::AUTHORISE => 'A',
      FunctionType::DELETE    => 'D',
      FunctionType::INPUT     => 'I',
      FunctionType::NONE      => '',
      FunctionType::REVERSE   => 'R',
      FunctionType::SEE       => 'S',
      FunctionType::VERIFY    => 'V'
    );

    /**
     * Retrieves the name of a given function type
     *
     * @param   $function_type the function type
     * @returns $name
     *
     */
    public static function get_function_type_value($function_type){
      $name = null;

      if(!in_array($function_type, FunctionType::get_function_type_list())){
        throw new OFSException(
          SyntaxError::UNKNOWN_FUNCTION_TYPE,
          $function_type
        );
      }

      $name = self::$_function_type_names[$function_type];

      return $name;
    }

    /**
     * Retrieves a list of function types
     *
     * @returns $function_type_list
     *
     */
    public static function get_function_type_list(){
      $function_type_list = array_keys(self::$_function_type_names);

      return $function_type_list;
    }
  }
?>

