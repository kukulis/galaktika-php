<?php
function wave($people){

    $i = 0;
    $wave = [];
    for ( $i=0; $i < strlen($people); $i++) {
        if ( preg_match( "/\w{1}/", $people[$i])) {
            $element = $people;
            $element[$i] = strtoupper($people[$i]);
            $wave[] = $element;
        }
    }

    return $wave;
}