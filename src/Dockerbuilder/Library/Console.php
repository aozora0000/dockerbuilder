<?php
namespace Dockerbuilder\Library;
class Console {
    public static function getCurrentDirName() {
        exec("basename `pwd`",$returnArray);
        return $returnArray[0];
    }
}
