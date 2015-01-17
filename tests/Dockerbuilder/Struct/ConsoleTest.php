<?php
use Dockerbuilder\Struct\Console;
class StructConsoleTest extends PHPUnit_Framework_TestCase {
    public function testCallStructAttribute() {
        $struct = new Console;
        $this->assertNull($struct->__get("exitcode"));
        $this->assertNull($struct->__get("raw_output"));
        $this->assertNull($struct->__get("array_output"));
        $this->assertNull($struct->__get("elapsed"));
        $this->assertNull($struct->__get("elapsed_second"));
        $this->assertNull($struct->__get("mem_peak"));
        $this->assertNull($struct->__get("mem_usage"));
    }
}
