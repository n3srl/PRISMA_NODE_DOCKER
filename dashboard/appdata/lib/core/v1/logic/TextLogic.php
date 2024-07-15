<?php

class TextLogic {
    /*
     * To change this license header, choose License Headers in Project Properties.
     * To change this template file, choose Tools | Templates
     * and open the template in the editor.
     */

    public static function parseText($n) {

        $n = str_replace("\"", "&quot;", $n);
        $n = nl2br(stripslashes(str_replace("\\r\\n", "&#13;&#10;", $n)));
        return $n;
    }

    public static function parseTextTextbox($n) {
        return $n;
    }

    public static function parseTextTable($n) {
        $n = str_replace("\"", "&quot;", $n);
        $n = nl2br(stripslashes(str_replace("\\r\\n", "<br>", $n)));

        return $n;
    }

}
