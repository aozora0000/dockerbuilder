<?php
namespace Dockerbuilder\Library;
class Docker {

    public static function Available() {
        exec("docker ps 2>&1",$returnArray,$exitcode);
        return ($exitcode === 0) ? true : false;
    }

    public static function dockerfileExists() {
        return is_file("Dockerfile");
    }

    public static function build($image_name, $tag_name, $opt = "") {
        $bench = new \Ubench;
        $bench->start();

        exec("docker build {$opt} -t {$image_name}:{$tag_name} ./ 2>&1",$returnArray,$exitcode);

        $bench->end();

        $console = new \Dockerbuilder\Struct\Console;
        $console->exitcode = $exitcode;
        $console->raw_output = implode("\n",$returnArray);
        $console->array_output = $returnArray;
        $console->elapsed = $bench->getTime();
        $console->mem_peak = $bench->getMemoryPeak();
        $console->mem_usage = $bench->getMemoryUsage();
        $console->elapsed_second = $bench->getTime(false,"%.2f");
        return $console;
    }

    public static function clean() {
        exec("docker rm -f $(docker ps -a -q) 2>&1",$returnArray,$exitcode);
        $console = new \Dockerbuilder\Struct\Console;
        $console->exitcode = $exitcode;
        $console->raw_output = implode("\n",$returnArray);
        $console->array_output = $returnArray;
        return $console;
    }

}
