<?php
use Dockerbuilder\Library\Docker;

class DockerTest extends PHPUnit_Framework_TestCase {

    public function testAvailable() {
        $this->assertFalse(Docker::available());
    }

    public function testBuild() {
        $result = Docker::build("dockerbuilder","dev");
        $this->assertEquals(1,$result->exitcode);
    }

    public function testClean() {
        Docker::clean();
        $result = Docker::clean();
        $this->assertEquals(2,$result->exitcode);
    }
}
