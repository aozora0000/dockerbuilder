<?php
namespace Dockerbuilder\Library;

class AlertVerborse {
    public static function Error($message) {
        return
        "<fg=red>###########################################################\n".
        "# {$message}\n".
        "###########################################################</fg=red>\n";
    }

    public static function ScriptStart($message,$count,$imagename) {
        return
        "<fg=cyan>###########################################################\n".
        "# {$message}\n".
        "# Found {$count} Branches\n".
        "# Build Start {$imagename} DockerImages\n".
        "###########################################################</fg=cyan>\n";
    }

    public static function ScriptEnd($message,$count,$imagename,$reports,$success,$error) {
        $elaped = 0;
        foreach($reports as $branch=>$report) {
            $result = $report['result'];
            $elaped += (isset($result->elapsed_second)) ? $result->elapsed_second : 0;
        }
        return
        "<fg=cyan>###########################################################\n".
        "# {$message}\n".
        "# End {$count} Tasks\n".
        "# Build {$imagename} DockerImages\n".
        "# <fg=green>Build Success {$success}</fg=green>\n".
        "# <fg=red>Build Failed  {$error}</fg=red>\n".
        "# Elaped {$elaped}ms\n".
        "###########################################################</fg=cyan>\n";
    }

    public static function BuildStart($image_name, $branch, $time, $count) {
        return
        "<fg=yellow>###########################################################\n".
        "# building {$image_name}:{$branch} {$time}/{$count}\n".
        "###########################################################</fg=yellow>\n";
    }

    public static function BuildSuccess($image_name, $branch, $result) {
        return
        "<fg=green>###########################################################\n".
        "# build success! {$image_name}:{$branch}\n".
        "# time: {$result->elapsed}\n".
        "# memory: {$result->mem_peak}\n".
        "###########################################################</fg=green>\n";
    }

    public static function BuildFailed($image_name, $branch, $result) {
        $message = implode("\n# ",$result->array_output);
        return
        "<fg=red>###########################################################\n".
        "# build failed! {$image_name}:{$branch}\n".
        "# time: {$result->elapsed}\n".
        "# memory: {$result->mem_peak}\n".
        "# message:\n".
        "# {$message}\n".
        "###########################################################</fg=red>\n";
    }
}
