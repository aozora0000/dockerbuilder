<?php
namespace Dockerbuilder\Library;

class Alert {
    public static function Error($message) {
        return
            "###########################################################\n".
            "# {$message}\n".
            "###########################################################";
    }
}
