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

class TestCommand extends Command
{
    protected function configure()
    {
        $this
        ->setName('test')
        ->setDescription('docker build test each git branch')
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
            $logger = new Logger('build');
            $log_dir = getenv('HOME');
            $logger->pushHandler(new StreamHandler("{$log_dir}/dockerbuilder.log", Logger::INFO));

            $image_name = $input->getArgument('image_name');
            //$branch_option['include'] = $input->getArgument('include');
            //$branch_option['exclude'] = $input->getArgument('exclude');
            $verbose = $input->getOption('verbose');
            //var_dump($branch_option);exit;

            //$branches = \Dockerbuilder\Model\Initialize::getBranches($branch_option);
            $branches = \Dockerbuilder\Model\Initialize::getBranches();
            Build::build($output, $logger, $image_name, $branches, $verbose, "--force-rm=true --rm=true");
        } catch(\Exception $e) {
            print_r($e);exit;
            $output->writeln(\Dockerbuilder\Library\Alert::Error($e->getMessage(),true));
        }
    }
}
