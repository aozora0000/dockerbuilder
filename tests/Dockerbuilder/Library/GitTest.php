<?php
use Dockerbuilder\Library\Git;

class GitTest extends PHPUnit_Framework_TestCase {

    public function testIsGitDir() {
        $this->assertTrue(Git::isGitDir());
    }

    public function testIsExistBranches() {
        $this->assertTrue(Git::isExistBranches());
    }

    public function testGetBranchesHash() {
        $this->assertContainsOnly("string",Git::getBranchesHash());
    }

    public function testGetBrancheNameFromHash() {
        $hash = "f908dc3e6ea4a955d11ab0a6bc3f08667fcc4882";
        $this->assertEquals("master",Git::getBrancheNameFromHash($hash));
    }

    public function testGetBrancheNameFromHashFaildCase() {
        $hash = "teststring";
        $this->assertEquals("error: malformed object name {$hash}",Git::getBrancheNameFromHash($hash));
    }
}
