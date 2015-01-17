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

            $branches = \Dockerbuilder\Model\Initialize::getBranches();
            $image_name = $input->getArgument('image_name');
            $verbose = $input->getOption('verbose');
            Build::build($output, $logger, $image_name, $branches, $verbose, "--force-rm=true --rm=true");
        } catch(\Exception $e) {
            $output->writeln(\Dockerbuilder\Library\Alert::Error($e->getMessage(),true));
        }
    }
}
