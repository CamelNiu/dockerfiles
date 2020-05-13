<?php


class RedisModel extends \Redis
{
    /**
     * 根据传递的key返回一下数据类型
     * 六星教育 @shineyork老师
     * @param  [type] $key [description]
     * @return [type]      [description]
     */
    public function getType($key)
    {
        $keyType = $this->type($key);
        switch ($keyType) {
          case Redis::REDIS_SET :
            return "Set";
            break;
          case Redis::REDIS_LIST :
            return "List";
            break;
          case Redis::REDIS_ZSET :
            return "Zset";
            break;
          case Redis::REDIS_STRING :
            return "String";
            break;
          case Redis::REDIS_HASH :
            return "Hash";
            break;
        }
    }
}
