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
        \Dockerbuilder\Model\Initialize::init();
        $output->writeln('Hello World');
    }
    /*
    git rev-parse --branches | while read BRANCH_HASH; do \
    echo $(git branch --contains=$BRANCH_HASH) \
    done
     */
}
