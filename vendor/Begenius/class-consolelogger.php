<?php

namespace Begenius;

class ConsoleLogger 
{

  public function log($message, $to_json=false) 
  {
    $this->push_log_message( $message, $to_json );
  }
  
  private function push_log_message( $message, $to_json=false )
  {
    $timestamp = date('Y-m-d H:i:s');    
    $message = $to_json ? json_encode( $message ) : '"'.$timestamp.': '.$message.'"';
    $script = <<<EOT
        <script>        
          console.log($message);
        </script>
EOT;
    echo $script;
  }
}