<?php
require_once 'Redis.php';
require_once 'Input.php';

class Aof
{
    /**
     * [protected description]
     * @var Redis
     */
    protected $redis;

    protected $commands;

    protected $filePath ;

    public function __construct($host = "192.160.1.140", $port = 6379, $file = "/aof_file.aof")
    {
        $this->redis = new RedisModel();
        $this->redis->pconnect($host, $port);
        $this->filePath = __DIR__.$file;
    }
    /**
     * aof重写方法
     * 六星教育 @shineyork老师
     * @return [type] [description]
     */
    public function aofRewrite()
    {
        // 1. 获取所有的 数据库
        $dbs = $this->redis->config('GET', 'databases')['databases'];
        // Input::info($dbs);
        // 2. 根据库去循环获取key scan
        //    key可能很多
        for ($i=0; $i < $dbs; $i++) {
            // 3. 再根据key 调用重写的规则的方法 去重写
            //    判断重写的数据类型

            // 用于记录命令的
            $commands = null;
            // 切换数据库
            $this->redis->select($i);
            // 针对于 $i 这个数据库去进行命令的重写
            $commands = $this->rewrite($commands);

            if (!empty($commands)) {
              Input::info($commands);
              $this->rewriteFile( "db:".$i.";key:".$commands);
            }
        }
    }

    protected function rewrite($commands, $iterator = -1)
    {
        $keys = $this->redis->scan($iterator);
        // Input::info($keys);
        // Input::info($iterator);

        // 是否有数据
        if (empty($keys)) {
            return ;
        }
        // 重写获取的key的数据
        foreach ($keys as $key) {
            // 得到key的类型
            $keyType = $this->redis->getType($key);
            // 再根据类型去重写命令，并且拼接
            $commands .= $this->{"rewrite".$keyType}($key);
        }

        // 判断后面是否还有数据
        if ($iterator > 0) {
            $this->rewrite($commands, $iterator);
        } else {
            return $commands;
        }
    }

    protected function rewriteFile($commands)
    {
        file_put_contents($this->filePath, $commands, 8);
    }

    protected function rewriteSet($key)
    {
        $value = $this->redis->sMembers($key);
        return $this->rewriteCommand('SADD', $key, implode(" ", $value));
    }
    // protected function rewriteList($key)
    // {
    //     return $this->rewriteCommand('', $key, $value);
    // }
    // protected function rewriteZset($key)
    // {
    //     return $this->rewriteCommand('', $key, $value);
    // }
    // protected function rewriteString($key)
    // {
    //     return $this->rewriteCommand('', $key, $value);
    // }
    // protected function rewriteHash($key)
    // {
    //     return $this->rewriteCommand('', $key, $value);
    // }
    // protected function rewriteExpireTime($key)
    // {
    //     return $this->rewriteCommand('SADD', $key, $value);
    // }
    protected function rewriteCommand($method, $key, $value)
    {
        return $method." ".$key." ".$value.";";
    }
}
(new Aof)->aofRewrite();
