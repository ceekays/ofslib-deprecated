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

  /**
   * Checks if an array is a 'hash' (i.e. it is an associative array)
   * @param array  $value  the array parameter
   * returns boolean $is_hashed
   *
   */
  function is_hash(array $value){
      $is_hashed = false;
      if(!is_array($value)) return $is_hashed;

      $keys       = array_keys($value);
      $key_range  = array_keys($keys);

      if($keys !== $key_range) $is_hashed = true;

    return $is_hashed;
  }

  /**
   * Flattens an array of arrays (if any)
   * Based on: http://snippets.dzone.com/posts/show/4660
   * @param array $value the array parameter
   *@returns $flattened_array
   */
  function array_flatten(array $value){

	  for ($i = 0; $i < count($value);){
	    is_array($value[$i]) ? array_splice($value,$i,1,$value[$i]) : $i++;
	  }

    $flattened_array = $value;

    return $flattened_array;
  }

  /**
   * Tokenizes a string based on either quotes or a tab space
   * Based on: http://www.php.net/manual/en/function.strtok.php#53244
   * @param array $value the array parameter
   * @param array $keys an optional array of keys
   *@returns $flattened_array
   */
  function strtok_quoted($string, array $keys = array()){
    $tok = strtok($string, "\t");

    for($i = 0, $tokens = array(); $tok !== false; $tok = strtok("\t")){
      if($tok[0] == '"'){
        if($tok[strlen($tok)-1] == '"')
          $tok = substr($tok, 1, -1);
        else
          $tok = substr($tok, 1) . ' ' . strtok('"');
      }

      $index = (isset($keys[$i]) && '' != trim($keys[$i])) ? $keys[$i] : $i;
      $tokens[$index] = trim($tok);

      $i++;
    }

    return $tokens;
  }
?>

