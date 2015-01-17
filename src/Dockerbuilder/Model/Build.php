<?php
namespace Dockerbuilder\Model;

use \Monolog\Logger;
use \Dockerbuilder\Library\Alert;
use \Dockerbuilder\Library\AlertVerborse;
use \Dockerbuilder\Library\Docker;
use \Dockerbuilder\Library\Git;
use \Symfony\Component\Console\Output\OutputInterface;

class Build {

    public static function build(OutputInterface $output,Logger $logger, $image_name, $branches, $verbose = false, $option = "") {
        $i = 1;
        $error = 0;
        $success = 0;
        $count = count($branches);
        $report = array();
        $alert = ($verbose) ?  new AlertVerborse : new Alert;
        $alertMethod = ($verbose) ? "writeln" : "write";
        $output->writeln($alert::ScriptStart("DockerBuilder Build Start",$count,$image_name));

        foreach($branches as $branch) {
            if(!Git::changeBranch($branch)) {
                $output->writeln($alert::Error("{$branch} Branch Checkout Failed!"));
            }
            if(!Docker::dockerfileExists()) {
                $error++;
                $output->writeln($alert::Error("Dockerfile NotFound!"));
                $logger->warning("Dockerfile NotFound!");
            } else {
                $output->writeln($alert::BuildStart($image_name, $branch, $i, $count));

                $result = Docker::build($image_name, $branch,$option);
                if($result->exitcode === 0) {
                    $success++;
                    $output->$alertMethod($alert::BuildSuccess($image_name, $branch, $result));
                    $logger->info("build success {$image_name}:{$branch}");
                } else {
                    $error++;
                    $output->$alertMethod($alert::BuildFailed( $image_name, $branch, $result));
                    $logger->warning("build error {$image_name}:{$branch} {$result->raw_output}");
                }
                $report[$branch] = array(
                    "branch"=>$branch,
                    "result"=>$result
                );
            }
            $i++;
        }
        $output->writeln("");
        $output->writeln($alert::ScriptEnd("DockerBuilder Build End",$count,$image_name,$report,$success,$error));
    }
}
