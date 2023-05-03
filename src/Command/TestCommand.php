<?php

namespace App\Command;

use App\Entity\EventPlanning;
use App\Entity\EventPlanningConference;
use App\Entity\EventPlanningSport;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:test',
    description: 'Add a short description for your command',
)]
class TestCommand extends Command
{

	public function __construct(private EntityManagerInterface $em)
	{
		parent::__construct();
	}

	protected function configure(): void
    {
        $this
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
		// create new evtSport with Evt entity parent field
		$eventSport = new EventPlanningSport();
		$eventSport->setName('sport');
		$eventSport->setCode('sport');
		$eventSport->setOpponentTeamName('opponent');
		$eventSport->setOpponentTeamLogo('logo');

		// create new evtConference with Evt entity parent field
		$eventConference = new EventPlanningConference();
		$eventConference->setName('conference');
		$eventConference->setCode('conference');
		$eventConference->setSpeaker('speaker');


		// persist and flush
//		$this->em->persist($eventSport);
//		$this->em->persist($eventConference);
//		$this->em->flush();


	    // retrieve all events
		$eventRepo = $this->em->getRepository(EventPlanning::class);

		// retrieve all events of type sport
		$eventSportRepo = $this->em->getRepository(EventPlanningSport::class);
		// retrieve all event of type conference
		$eventConfRepo = $this->em->getRepository(EventPlanningConference::class);

		/*
		 * 1 - retrieve all events
		 * 2 -  Retrieve only eventSport
		 * 3 - Retrieve only eventConference*/
		dump($eventRepo->findAll(), $eventSportRepo->findAll(), $eventConfRepo->findAll());


		// if inheritance type is JOINED and i want to retrieve only eventSport with eventRepo
		$eventRepoResSport = $eventRepo->createQueryBuilder('e')
			->select('e')
			->where('e INSTANCE OF :evtSport')
			->setParameter('evtSport', $this->em->getClassMetadata(EventPlanningSport::class))
			->getQuery()
			->getResult();

		dump($eventRepoResSport);

		return Command::SUCCESS;

    }
}
