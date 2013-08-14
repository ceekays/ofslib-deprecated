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

?>

