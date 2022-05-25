<?php
namespace App\Traits;
/**/
trait GeneralEnum
{
    public static function getEnumList($attribute)
    {
        return SELF::$generalenum[$attribute];
    }

    public function getEnumInString($attribute)
    {
        return isset(SELF::$generalenum[$attribute][$this->$attribute])?SELF::$generalenum[$attribute][$this->$attribute]:"";
    }
    
    public function setEnum($attribute, $enum)
    {
        $this->$attribute = $enum;
        return $this->update();
    }
}