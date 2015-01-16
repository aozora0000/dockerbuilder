<?php
namespace Dockerbuilder\Model;

class Initialize {
    public static function init() {
        if(!exec('git rev-parse --is-bare-repository 2>&1',$stdout)) {
            throw new \Exception("Gitディレクトリではありません。");
        }
        if(!exec('git rev-parse --branches 2>&1',$stdout)) {
            throw new \Exception("Gitブランチが存在しません。");
        }
        if(exec('git rev-parse --branches',$stdout)) {
            print_r($stdout[2]);
        }
    }
}
