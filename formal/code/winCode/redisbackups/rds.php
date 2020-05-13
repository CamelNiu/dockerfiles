<?php

/**
 * redis
 */
class rds extends \redis
{
    private $redisObj;
    function __construct($host="127.0.0.1",$port="6379")
    {
        $this->redisObj = $this->pconnect($host,$port);
    }



}



