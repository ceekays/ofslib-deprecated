<?php
/******************************************************************************
 *      OFSLib.php                                                            *
 *      - Contains an autoload function for OFSLib                            *
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
  require 'lib/Helpers.php';

  function __autoload_ofslib($class_name){
    $class_path = null;
    $basePath   = realpath(isset($class_path) ? $class_path : './lib');

    $class_path  = $basePath.DIRECTORY_SEPARATOR ;
    $class_path .= str_replace('_', DIRECTORY_SEPARATOR, $class_name);
    $class_path .= '.php';

    try{
      if (file_exists($class_path))
        require_once $class_path;
      else
        throw new OFSException('unable to load '.$class_path);
    } catch(OFSException $e){
      // the exception will be handled by OFSException.
    }
  }

  spl_autoload_register('__autoload_ofslib');
?>

