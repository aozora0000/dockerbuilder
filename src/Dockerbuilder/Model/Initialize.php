<?php
namespace Dockerbuilder\Model;

use Dockerbuilder\Library\Git;
use Dockerbuilder\Library\Docker;
use \Exception;

class Initialize {
    public static function getBranches() {
        if(!Docker::available()) {
            throw new Exception("Dockerが起動されていません。またはDOCKER_HOSTに異常があります。");
        }
        if(Git::isGitDir() && Git::isExistBranches()) {
            return Git::getBrancheName();
        } else {
            throw new Exception("Gitリポジトリ、又はブランチが存在しません。");
        }
    }
}
