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

    public static function getBrancheName($option) {
        exec("git branch 2>&1",$branches);
        return self::trimFilter($branches);
    }

    public static function changeBranch($branch) {
        exec("git checkout {$branch} 2>&1",$stdout,$exitcode);
        if($exitcode === 0) {
            return true;
        } else {
            return false;
        }
    }

    public static function trimFilter($branches) {
        return array_map(function($branch) {
            return trim(str_replace("*","",$branch));
        },$branches);
    }

    public static function branchFilter($branches,$include,$exclude) {
        var_dump($branches,$include,$exclude);
        $branches = array_filter($branches, function($branch) use ($include) {
            return ($include) ? in_array($branch,$include) : true;
        });
        $branches = array_filter($branches, function($branch) use ($exclude) {
            return ($exclude) ? true : !in_array($branch,$exclude);
        });
        var_dump($branches);exit;
        return $branches;
    }
}
