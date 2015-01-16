<?php

namespace Dockerbuilder\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class BuildCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('build')
            ->setDescription('docker build each git branch');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            $branches = \Dockerbuilder\Model\Initialize::getBranches();
            print_r($branches);
            $output->writeln(\Dockerbuilder\Library\Alert::Error("Hello World"));
            $output->writeln('Hello World');
        } catch(\Exception $e) {
            $output->writeln(\Dockerbuilder\Library\Alert::Error($e->getMessage()));
        }
    }
    /*
    git rev-parse --branches | while read BRANCH_HASH; do \
    echo $(git branch --contains=$BRANCH_HASH) \
    done
     */
}
