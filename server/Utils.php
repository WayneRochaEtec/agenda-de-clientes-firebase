<?php

class Utils {
    public function convertDateToLocalString($date){
        $formatedDate = date('d-m-Y', strtotime($date));
        return str_replace("-", "/", $formatedDate);
    }

    public function createErrorLog($error){
        $date = date( 'Y-m-d H:i:s' );
        $msg = sprintf( "[%s] [%s]: %s%s", $date, 0, $error, PHP_EOL );
        file_put_contents( "errors.log", $msg, FILE_APPEND );
    }
}
?>