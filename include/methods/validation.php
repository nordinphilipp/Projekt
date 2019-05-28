<?php
	//tar emot sträng och regex-format
	//returnerar true om strängen matchar formatet
    function validate ($string, $format){    
        if (empty($string) || !preg_match($format, $string)){
            echo "\n ERROR: Could not validate";
            return false;
        }else{
            return true;
        }
    }

    //slumpar fram ett salt som är mellan 5 och 15 chars långt
    function salt(){
        $chars='abcdefghijklmnopqrstuvxyzABCDEFGHIJKLMNOPQRSTUVXYZ!?-_.0123456789';
        $length = rand(5,15);
        $output = "";

        for ($i=0; $i<$length; $i++){
            $random = rand(0, strlen($chars)-1);
            $output = $output . $chars[$random];
        }
            return $output;
    }

    
?>