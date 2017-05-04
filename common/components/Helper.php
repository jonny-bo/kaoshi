<?php
namespace common\components;

class Helper
{
    public static function truncate_utf8_string($string, $length, $etc = '...')
    {
        $result = '';
        $string = html_entity_decode(trim(strip_tags($string)), ENT_QUOTES, 'UTF-8');
        $strlen = strlen($string);
        for ($i = 0; (($i < $strlen) && ($length > 0)); $i++) {
            if ($number = strpos(str_pad(decbin(ord(substr($string, $i, 1))), 8, '0', STR_PAD_LEFT), '0')) {
                if ($length < 1.0) {
                    break;
                }
                $result .= substr($string, $i, $number);
                $length -= 1.0;
                $i += $number - 1;
            } else {
                $result .= substr($string, $i, 1);
                $length -= 0.5;
            }
        }
        $result = htmlspecialchars($result, ENT_QUOTES, 'UTF-8');
        if ($i < $strlen) {
            $result .= $etc;
        }
        return $result;
    }

    public static function getDict($name, $value = '')
    {
        $dicts = array(
            'questionType' => array(
                'choice' => '选择题',
                'fill' => '填空题',
                'essay' => '问答题',
                'determine' => '判断题',
                'material' => '材料题',
            ),
            'difficulty' => array(
                'simple' => '简单',
                'normal' => '普通',
                'difficulty' => '困难',
            )
        );

        if ($value == '') {
            return $dicts[$name];
        }

        return $dicts[$name][$value];
    }
}
