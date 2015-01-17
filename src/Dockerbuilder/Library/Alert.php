<?php
namespace Dockerbuilder\Library;

class Alert {
    public static function Error($message) {
        return "<fg=red>F</fg=red>";
    }

    public static function ScriptStart($message,$count,$imagename) {
        return "<fg=cyan>{$message}</fg=cyan>\n";
    }

    public static function ScriptEnd($message,$count,$imagename,$reports,$success,$error) {
        $returnLine = "";
        foreach($reports as $branch=>$report) {
            $result = $report["result"];
            if($result->exitcode > 0) {
                $lastline = array_pop($result->array_output);
                $returnLine .= "<fg=red>{$branch}:\n  {$lastline}</fg=red>\n";
            }
        }
        return "<fg=cyan>{$message}</fg=cyan>\n{$returnLine}";
    }

    public static function BuildStart($image_name, $branch, $time, $count) {
        return "";
    }

    public static function BuildSuccess($image_name, $branch, $result) {
        return "<fg=green>S  {$branch}:{$result->elapsed}</fg=green>";
    }

    public static function BuildFailed ($image_name, $branch, $result) {
        return "<fg=red>F  {$branch}:{$result->elapsed}</fg=red>";
    }
}
