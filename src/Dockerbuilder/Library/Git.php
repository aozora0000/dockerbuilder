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
        return array_unique($branches);
    }

    public static function getBrancheNameFromHash($hash) {
        exec("git branch --contains={$hash} 2>&1",$gitbranche);
        return trim(str_replace("*","",$gitbranche[0]));
    }

    public static function getBrancheName() {
        exec("git branch 2>&1",$gitbranche);
        return array_map(function($branch) {
            return trim(str_replace("*","",$branch));
        },$gitbranche);
    }

    public static function changeBranch($branch) {
        exec("git checkout {$branch} 2>&1",$stdout,$exitcode);
        if($exitcode === 0) {
            return true;
        } else {
            return false;
        }
    }
}
