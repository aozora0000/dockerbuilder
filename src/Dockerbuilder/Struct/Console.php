<?php
namespace Dockerbuilder\Struct;
class Console {
    public $exitcode;
    public $raw_output;
    public $array_output;
    public $elapsed;
    public $elapsed_second;
    public $mem_peak;
    public $mem_usage;

    public function __get($name) {
        return $this->$name;
    }
}
