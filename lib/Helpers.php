<?php
/******************************************************************************
 *      Helpers.php                                                           *
 *      - Contains miscellaneous handy functions                              *
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


  /**
   * This is like Ruby's 'inspect' method. Whenever you are not sure, just dump
   * @param mixed $object
   * @returns void
   *
   */
  function dump($object) {
    echo "<pre>";
      print_r($object);
    echo "</pre>";
    exit;
  }

  /**
   * Find the last element in an array
   * @param   array $value  the array parameter
   * @returns mixed $last_element
   *
   */
  function array_last(array $value){
    $last_element = null;

    if(!is_array($value)) return $last_element;
    if(sizeof($value) < 1) return $last_element;

    $keys = array_keys($array_value);
    $last = $keys[sizeof($keys) - 1];

    $last_element = $value[$last];

    return $last_element;
  }

?>

