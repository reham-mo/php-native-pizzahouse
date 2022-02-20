<?php

function clean($input)
{
    trim($input);
    filter_var($input, FILTER_SANITIZE_STRING);

    return $input;
}



function validate($input, $flag){

    $status = true;

    switch ($flag) {
        case 1:
           if(empty($input)){
               $status = false;
           }
            break;

        case 2:
            if(!filter_var($input, FILTER_VALIDATE_INT)){
                $status = false;
            }
                break;
       
    }
return $status;

}