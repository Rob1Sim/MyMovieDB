<?php

declare(strict_types=1);

namespace Html;

use Entity\Exception\ParameterException;

trait StringEscaper
{
    /**
     * Encode avec les charactères spéciaux html, un string
     * @param string $string
     * @return string
     */
    public static function escapeString(?string $string): string
    {
        $ret = "";
        if ($string != null) {
            $ret = htmlspecialchars($string, flags: ENT_QUOTES | ENT_HTML5);
        }
        return $ret;
    }

    /**
     * Nettoie une chaîne de charactère
     * @param string|null $string chaîne de charactère à netoyer
     * @return string
     */
    public function stripTagsAndTrim(?string $string): string
    {
        $res = "";
        if ($string != null) {
            $res = trim(strip_tags($string));
        }
        return $res;
    }


}
