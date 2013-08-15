<?php
/******************************************************************************
 *      OFSException.php                                                      *
 *      - Handles different OFS exceptions                                    *
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

  class OFSException extends Exception{

    /**
     * Holds the actual exception message
     * @var string $exception
     */
    static $exception;

    /**
     * Holds the debug backtrace
     * @var string $stacktrace
     */
    static $stacktrace;

    /**
     * Creates an OFSException 
     *
     * @param   string  $message the actual exception message
     * @param   string  $option An optional parameter that modifies the exception message
     * @return  OFSException object
     *
     */
    public function OFSException($message, $option=null){
      parent::__construct($message);

      static::$stacktrace = debug_backtrace();

      $last = static::$stacktrace[count(static::$stacktrace) - 1];

      $file = $last['file'];
      $line = $last['line'];

      static::$exception  = "<b>OFSException:</b> ";
      static::$exception .= sprintf($this->getMessage(), $option);
      static::$exception .= " in ";
      static::$exception .= $file;
      static::$exception .= " on line ";
      static::$exception .= $line;

      OFSException::callStack();
    }

    /**
     *  print a neat callstack
     *
     *  Credit: Don Briggs
     *  http://stackoverflow.com/questions/1423157/print-php-call-stack
     */
    private static function callStack(){
      $exception_template = "%s <b> %s </b>: %s () line %s <br/>";

      echo "<pre>";
      echo static::$exception ."<br/>";
      echo str_repeat("_", strlen(static::$exception))."<br/><br/>";

      $i = 1;
      foreach(static::$stacktrace as $node){
        if(isset($node['file'])){
          $message = sprintf(
            $exception_template,
            $i,
            basename($node['file']),
            $node['function'],
            $node['line']
          );

          echo $message;
          $i++;
        }
      }

      echo "</pre>";
      exit;
    }
  }
?>

