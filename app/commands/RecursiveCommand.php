<?php


namespace app\commands;


use app\services\Recursive;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class RecursiveCommand extends Command
{
    protected static $defaultName = 'recursive';

    protected function configure()
    {
        $this
            ->addArgument('target', InputArgument::OPTIONAL, 'target folder')
            ->addArgument('result', InputArgument::OPTIONAL, 'result folder')
            ->addArgument('extensions', InputArgument::OPTIONAL, 'available extensions of files. for example: "php,html,js"')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        (new Recursive(
            $input->getArgument('target'),
            $input->getArgument('result'))
        )->getStruct();

        return 0;
    }
}