<?php
use Dockerbuilder\Library\Docker;

class DockerTest extends PHPUnit_Framework_TestCase {

    public function testAvailable() {
        $this->assertFalse(Docker::available());
    }
}
