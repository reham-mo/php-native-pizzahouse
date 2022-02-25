<?php

//////////////////////////////////////////////////////////////////////////////////////////// sanitization
function Clean($input, $flag = 0)
{

    $input =  trim($input);

    if ($flag == 0) {
        $input =  filter_var($input, FILTER_SANITIZE_STRING);   
    }
    return $input;
}
//////////////////////////////////////////////////////////////////////////////////////////// sanitization



//////////////////////////////////////////////////////////////////////////////////////////// validation
function validate($input, $flag)
{

    $status = true;

    switch ($flag) {
        case 1:
            if (empty($input)) {
                $status = false;
            }
            break;

        case 2:
            if (!filter_var($input, FILTER_VALIDATE_INT)) {
                $status = false;
            }
            break;
        case 3:
            //get the img extension
            $nameArray = explode('.', $input);
            $imgExt = strtolower(end($nameArray));
            $allowedEx = ['jfif', 'jpg', 'jpeg', 'png'];
    
            if (!in_array($imgExt, $allowedEx)) {
                $status = false ;
            }
            break;   
        case 4: 
            if(!filter_var($input,FILTER_VALIDATE_EMAIL)){
                $status = false;
            }
            break;    
            
        case 5: 
            if(strlen($input)<6){
                $status = false;
            }    
            break;    
        case 6 :
            if (!preg_match('/^\\d+(\\.\\d{1,2})?$/D', $input)){
                $status = false;
            }
            break; 
        case 7: 
            if(!preg_match('/^01[0-2,5][0-9]{8}$/',$input)){
                $status = false;
                }
            break;           
    }
    return $status;
}
//////////////////////////////////////////////////////////////////////////////////////////// validation


//////////////////////////////////////////////////////////////////////////////////////////// validate file/image
function uploadFile($input){
    
    $result = '';

    $imgName  = $input['image']['name'];
    $imgTmp  = $input['image']['tmp_name'];

    $nameArray = explode('.', $imgName);
    $imgExt = strtolower(end($nameArray));
    $imgFinalName = time() . rand() . '.' . $imgExt;

    $disPath = 'images/' . $imgFinalName;

    if (move_uploaded_file($imgTmp, $disPath)) {
        $result =  $imgFinalName ;
    }

    return $result;
}
//////////////////////////////////////////////////////////////////////////////////////////// validate file/image



//////////////////////////////////////////////////////////////////////////////////////////// display session message
function displayMessage($text = null)
{

    if (isset($_SESSION['Message'])) {
        foreach ($_SESSION['Message'] as $val) {
            echo $val;
        }
        unset($_SESSION['Message']);
    } else {
        echo  $text ;
    }
}
//////////////////////////////////////////////////////////////////////////////////////////// display session message



//////////////////////////////////////////////////////////////////////////////////////////// control path
function url($input){

    return "http://".$_SERVER['HTTP_HOST']."/pizzahouse/admin/dist/".$input;

  }
  //////////////////////////////////////////////////////////////////////////////////////////// control path

