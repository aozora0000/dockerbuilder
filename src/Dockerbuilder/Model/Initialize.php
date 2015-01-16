<?php
namespace Dockerbuilder\Model;

use Dockerbuilder\Library\Git;
use \Exception;
class Initialize {
    public static function getBranches() {
        if(Git::isGitDir() && Git::isExistBranches()) {
            $branchArray = array();
            foreach(Git::getBranchesHash() as $hash) {
                $branchArray[] = Git::getBrancheNameFromHash($hash);
            }
            return $branchArray;
        } else {
            throw new Exception("Gitリポジトリ、又はブランチが存在しません。");
        }
    }
}
