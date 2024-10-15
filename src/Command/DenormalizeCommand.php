<?php

namespace App\Command;

use App\Model\Main;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

#[AsCommand(
    name: 'app:denormalize',
    description: 'Add a short description for your command',
)]
class DenormalizeCommand extends Command
{
    public function __construct(protected DenormalizerInterface $denormalizer)
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $json = <<<'JSON'
        {
          "id": 25,
          "attributes": {
            "title": "Attribute",
            "grid": {
              "columns": [
                "one",
                "two",
                "three"
              ]
            }
          }
        }
        JSON;

        $data = json_decode($json);

        $object = $this->denormalizer->denormalize($data, Main::class);

        dump($object);

        return Command::SUCCESS;
    }
}
