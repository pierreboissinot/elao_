<?php

declare(strict_types=1);

namespace App\Command;

use App\Legacy\HtaccessGenerator;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class GenerateRedirectionsCommand extends Command
{
    protected static $defaultName = 'app:generate-redirections';

    private HtaccessGenerator $generator;

    public function __construct(HtaccessGenerator $generator)
    {
        $this->generator = $generator;

        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Generate redirections rules for Nginx.')
            ->addOption('target', 't', InputOption::VALUE_REQUIRED, HtaccessGenerator::TARGET_SITE)
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        /** @var string $target */
        $target = $input->getOption('target');
        $output->writeln($this->generator->generateNginxRewriteRules($target));

        return Command::SUCCESS;
    }
}
