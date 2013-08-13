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
     * @var string
     */
    static $message;

    /**
     * Holds the debug backtrace
     * @var string
     */
    static $stacktrace;

    /**
     * Creates an OFSException 
     *
     * @param   string  $exception the actual exception message
     * @param   string  $option An optional parameter that modifies the exception message
     * @return  OFSException object
     *
     */
    public function OFSException($exception, $option=null){
      parent::__construct($exception);

      static::$stacktrace = debug_backtrace();

      $last = static::$stacktrace[count(static::$stacktrace) - 1];

      $file = $last['file'];
      $line = $last['line'];

      static::$message  = "<b>OFSException:</b> ";
      static::$message .= sprintf($this->getMessage(), $option);
      static::$message .= " in ";
      static::$message .= $file;
      static::$message .= " on line ";
      static::$message .= $line;

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
      echo static::$message ."<br/>";
      echo str_repeat("_", 120)."<br/><br/>";

      $i = 1;
      foreach(static::$stacktrace as $node){
        if(isset($node['file'])){
          $exception = sprintf(
            $exception_template,
            $i,
            basename($node['file']),
            $node['function'],
            $node['line']
          );

          echo $exception;
          $i++;
        }
      }

      echo "</pre>";
      exit;
    }
  }
?>

