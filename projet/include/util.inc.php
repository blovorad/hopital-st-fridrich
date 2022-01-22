<?php

    /*cette fonction detecte le navigateur*/
    function getBrowser(): string{
    	$var =  getenv("HTTP_USER_AGENT");
    	if(strpos($var, "Chrome")){
    		$brower = "\t\t<p class=\"text\">navigateur : Chrome</p>\n";
    	}
    	else if(strpos($var, "Firefox")){
    		$brower = "\t\t<p class=\"text\">navigateur : Firefox</p>\n";
    	}
    	else if(strpos($var, "Mac")){
    		$brower = "\t\t<p class=\"text\">navigateur : Mac</p>\n";
    	}
    	else if(strpos($var, "Opera")){
    		$brower = "\t\t<p class=\"text\">navigateur : Opera</p>\n";
    	}
    	else if(strpos($var, "Safari")){
    		$brower = "\t\t<p class=\"text\">navigateur : Safari</p>\n";
    	}
    	else{
    		$brower = "\t\t<p class=\"text\">navigateur : non reconnus</p>\n";
    	}

    	return $brower;
    }
?>
