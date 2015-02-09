<?php

namespace Dockerbuilder\Command;

use \Dockerbuilder\Model\Build;
use \Monolog\Logger;
use \Monolog\Handler\StreamHandler;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class PushCommand extends Command
{
    protected function configure()
    {
        $this
        ->setName('push')
        ->setDescription('docker build each git branch & dockerhub push')
        ->addArgument(
            'image_name',
            InputArgument::OPTIONAL,
            'DockerImage name',
            \Dockerbuilder\Library\Console::getCurrentDirName()
        );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            $logger = new Logger('push');
            $log_dir = getenv('HOME');
            $logger->pushHandler(new StreamHandler("{$log_dir}/dockerbuilder.log", Logger::INFO));

            $branches = \Dockerbuilder\Model\Initialize::getBranches();
            $image_name = $input->getArgument('image_name');
            $verbose = $input->getOption('verbose');
            if(\Dockerbuilder\Library\Docker::islogin(getenv('HOME'))) {
                Build::build($output, $logger, $image_name, $branches, $verbose, "", true);
            } else {
                throw new \Exception("after DockerLogin!");
            }
        } catch(\Exception $e) {
            $output->writeln(\Dockerbuilder\Library\Alert::Error($e->getMessage(),true));
        }
    }
}
