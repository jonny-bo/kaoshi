<?php
namespace backend\models;

class QuestionTypeFactory
{
    private static $cached = array();

    public static function create($type)
    {
        if (empty(self::$cached[$type])) {
            $className = __NAMESPACE__  . '\\'.ucfirst($type).'Question';
            self::$cached[$type] = new $className();
        }

        return self::$cached[$type];
    }

    public static function getClass($type)
    {
        return __NAMESPACE__  . '\\'.ucfirst($type).'Question';
    }
}
