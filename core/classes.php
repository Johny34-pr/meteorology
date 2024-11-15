<?php

class measurement{
    //Measurement object
}

class response{
    public $result, $log, $dataset;
    
    function __construct($result, $log = null, $dataset = null)
    {
        $this->result = $result;
        $this->log = $log;
        $this->dataset = $dataset;
    }
    //Response object for APIs
}


?>