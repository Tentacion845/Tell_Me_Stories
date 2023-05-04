<?php

namespace App\Command;

use App\Repository\UserRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:user:promote',
    description: 'Add a short description for your command',
)]
class UserPromoteCommand extends Command
{
    public UserRepository $userRepository;

    function __construct(UserRepository $userRepository)
    {
        parent::__construct();
        $this->userRepository = $userRepository;
    }

    protected function configure(): void
    {
        $this
            ->addArgument('id', InputArgument::OPTIONAL, 'Argument description')
            ->addArgument('role', InputArgument::OPTIONAL, 'Argument description');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $id = $input->getArgument('id');

        if ($id) {
            $io->note(sprintf('You passed an argument: %s', $id));
        }

        $role = $input->getArgument('role');

        if ($role) {
            $io->note(sprintf('You passed an argument: %s', $role));
        }

        $getUser = $this->userRepository->findOneBy(['id' => $id]);

        if ($getUser != null) {
            $io->info('user found');
            $getUser->setRoles([$role]);
            $this->userRepository->save($getUser, true);
        }


        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');

        return Command::SUCCESS;
    }
}
