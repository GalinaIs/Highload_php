<?php

class RedisCacheProvider {
    const REDIS_SERVER = '127.0.0.1';
    const REDIS_PORT = 6379;
    
    private static $connection = null;
    
    private function getConnection() {
        if(self::$connection===null){
            self::$connection = new Redis();
            self::$connection->connect(self::REDIS_SERVER, self::REDIS_PORT);
        }
        return self::$connection;

    }

    public static function get($key){
        $result = false;
        if($c = self::getConnection()){
            $result = $c->get($key);
        }
        return $result;
    }
    public static function set($key, $value, $time=100){
        if($c=self::getConnection()){
            $c->set($key, $value, $time);
        }
    }

    public static function del($key){
        if($c=self::getConnection()){
            $c->delete($key);
        }
    }

    public static function clear(){
        if($c=self::getConnection()){
            $c->flushDB();
        }
    }
}
