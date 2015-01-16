<?php
namespace Dockerbuilder\Library;

class Git {
    public static function isGitDir() {
        if(exec("git rev-parse --is-bare-repository 2>&1")) {
            return true;
        } else {
            return false;
        }
    }

    public static function isExistBranches() {
        if(exec("git rev-parse --branches 2>&1")) {
            return true;
        } else {
            return false;
        }
    }
    public static function getBranchesHash() {
        exec("git rev-parse --branches 2>&1",$branches);
        return $branches;
    }
    public static function getBrancheNameFromHash($hash) {
        exec("git branch --contains={$hash} 2>&1",$gitbranche);
        return trim(str_replace("*","",$gitbranche[0]));
    }
}
