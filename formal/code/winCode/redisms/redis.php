<?php


class RedisMs
{

    public $config;
    public $master;
    public $slaves;

    public function __construct($config)
    {
        $this->config = $config;
        $this->master = $config['master'];
        $this->slaves = $config['slaves'];
    }

    public function run()
    {
        Swoole\Timer::tick(1, function(){
            var_dump('abc');
        });
    }

}



