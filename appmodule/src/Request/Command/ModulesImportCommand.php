<?php

namespace App\Request\Command;

use App\Entity\Module;
use Doctrine\ORM\EntityManagerInterface;
use League\Csv\Reader;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class ModulesImportCommand extends Command
{
    /** @var EntityManagerInterface  */
    private EntityManagerInterface $entityManager;

    /**
     * CSVImportCommand constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct();
        $this->entityManager = $entityManager;
    }

    protected function configure()
    {
        $this
            ->setName("csv:import:modules")
            ->setDescription("Imports a mock CSV file");
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $io->title("En attente de l'importation des csv..");

        $reader = Reader::createFromPath('../src/Request/CSV/modules.csv', "r");
        $reader->setDelimiter(';');

        $results = $reader->fetchAssoc();

        foreach ($results as $row) {
            if (substr($row['module(PPN) '], 0, 1) != '#') { // Exclusion des commentaires éventuels
                // On récupère le module à partir de son PPN
                $module = $this->entityManager->getRepository(Module::class)->findOneBy(array(
                    'PPN' => str_replace(' ', '', $row['module(PPN) '])));

                if ($module == null) {
                    $module = new Module();
                }

                $module->setPPN(str_replace(' ', '', $row['module(PPN) ']));
                $module->setIntitule(substr(
                    $row[' module(GPU) intitulé'],
                    1,
                    strlen($row[' module(GPU) intitulé']) - 1
                ));

                $this->entityManager->persist($module);
            }
        }

        $this->entityManager->flush();

        unlink('../src/Request/CSV/modules.csv');

        $io->success("L'importation est finie !");
        return Command::SUCCESS;
    }
}
