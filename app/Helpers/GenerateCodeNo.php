<?php
namespace App\Helpers;

class GenerateCodeNo
{
    public static function getAccountPrefix()
    {
        return 'ID';
    }

    public static function getMonth()
    {
       $c_month = date('m').'/';
       return $c_month;
    }

    public static function appNumberPrefix()
    {
        return "AP";
    }
    public static function preNumberPrefix()
    {
        return "PRE";
    }

    public static function tranNoPrefix()
    {
        return "TR";
    }

    public static function getCodePrefix()
    {
        return "";
    }

    public static function  formatCode($p_prefix,$p_digit, $code){
        try {
            if (!$code) {
                $code = 1;
            } else {
                $code = str_replace_first($p_prefix, '', $code);
                $code = $code + 1;
            }

            $codeLength = strlen($code);

            return str_pad($p_prefix, $p_digit - $codeLength, '0', STR_PAD_RIGHT) . $code;
        }
        catch(\Exception $e){
            throw new \Exception($e);
        }
    }

    public static  function LoginCode($code)
    {
        return self::formatCode(self::getAccountPrefix(), 7, $code);
    }

    public static function bookNumber($code)
    {

        return self::formatCode(self::getMonth(), 8, $code);
    }

    public static  function appNumber($code)
    {

        return self::formatCode(self::appNumberPrefix(), 8, $code);
    }
    public static  function preNumber($code)
    {

        return self::formatCode(self::preNumberPrefix(), 9, $code);
    }

    public static  function tranNo($code)
    {

        return self::formatCode(self::tranNoPrefix(), 8, $code);
    }
    
     public static  function Bcode($code)
     {

        return self::formatCode(self::getCodePrefix(), 6, $code);
    }

    public static function priceCode($code)
    {
        return self::formatCode(self::getCodePrefix(), 7, $code);
    }

    public static function billNumber($code)
    {
        return self::formatCode(self::getCodePrefix(), 7, $code);
    }

    



    
}