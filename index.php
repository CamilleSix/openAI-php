<?php
// need valid ssl certificate to work

require_once "php/openIA.class.php" ;

$gptCall = new openIA() ;

$gptCall->setPrompt("What's currently trending in coding ?") ;

echo $gptCall->sendRequest() ;