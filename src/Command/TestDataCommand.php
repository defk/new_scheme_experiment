<?php

namespace App\Command;

use App\Entity\Contract;
use App\Entity\Organization;
use App\Entity\Road;
use App\Entity\RoadPart;
use App\Entity\User;
use App\Entity\VideoStation;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * Class TestDataCommand
 * @package App\Command
 * @uses AsCommand
 */
#[AsCommand(name: 'TestData')]
class TestDataCommand extends Command
{

    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager, string $name = null)
    {
        $this->entityManager = $entityManager;
        parent::__construct($name);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $orgCustomer = new Organization();
        $orgCustomer->setTitle('Customer');
        $this->entityManager->persist($orgCustomer);

        $orgExecutor1 = new Organization();
        $orgExecutor1->setTitle('Executor 1');
        $this->entityManager->persist($orgExecutor1);
        $orgExecutor2 = new Organization();
        $orgExecutor2->setTitle('Executor 2');
        $this->entityManager->persist($orgExecutor2);
        
        $user1 = new User();
        $user1->setTitle('User 1');
        $user1->setIsRoot(true);
        $user1->setOrganization($orgCustomer);
        $this->entityManager->persist($user1);
        
        $user2 = new User();
        $user2->setTitle('User 2');
        $user2->setIsRoot(false);
        $user2->setOrganization($orgCustomer);
        $this->entityManager->persist($user2);
        
        $user3 = new User();
        $user3->setTitle('User 3');
        $user3->setIsRoot(false);
        $user3->setOrganization($orgExecutor1);
        $this->entityManager->persist($user3);
        
        $user4 = new User();
        $user4->setTitle('User 4');
        $user4->setIsRoot(false);
        $user4->setOrganization($orgExecutor2);
        $this->entityManager->persist($user4);

        $road = new Road();
        $road->setTitle('R-1 Test road');
        $road->setCode('R-1');
        $road->setOrderRank(1000001);
        $this->entityManager->persist($road);

        $road2 = new Road();
        $road2->setTitle('R-2 Test road');
        $road2->setCode('R-2');
        $road2->setOrderRank(1000002);
        $this->entityManager->persist($road2);

        $roadPart1 = new RoadPart();
        $roadPart1->setOwner($orgCustomer);
        $roadPart1->setStart(0);
        $roadPart1->setFinish(100000);
        $roadPart1->setRoad($road);
        $this->entityManager->persist($roadPart1);

        $roadPart2 = new RoadPart();
        $roadPart2->setOwner($orgCustomer);
        $roadPart2->setStart(100000);
        $roadPart2->setFinish(150000);
        $roadPart2->setRoad($road);
        $this->entityManager->persist($roadPart2);

        $roadPart3 = new RoadPart();
        $roadPart3->setOwner($orgCustomer);
        $roadPart3->setStart(150000);
        $roadPart3->setFinish(300000);
        $roadPart3->setRoad($road);
        $this->entityManager->persist($roadPart3);

        $roadPart4 = new RoadPart();
        $roadPart4->setOwner($orgCustomer);
        $roadPart4->setStart(0);
        $roadPart4->setFinish(26750);
        $roadPart4->setRoad($road2);
        $this->entityManager->persist($roadPart4);

        $roadPart5 = new RoadPart();
        $roadPart5->setOwner($orgCustomer);
        $roadPart5->setStart(25750);
        $roadPart5->setFinish(40229);
        $roadPart5->setRoad($road2);
        $this->entityManager->persist($roadPart5);
        
        $contract1 = new Contract();
        $contract1->setTitle('Contract 1');
        $contract1->setCustomer($orgCustomer);
        $contract1->setExecutor($orgExecutor1);
        $contract1->addRoadPart($roadPart1);
        $contract1->addRoadPart($roadPart2);
        $this->entityManager->persist($contract1);
        
        $contract2 = new Contract();
        $contract2->setTitle('Contract 2');
        $contract2->setCustomer($orgCustomer);
        $contract2->setExecutor($orgExecutor2);
        $contract2->addRoadPart($roadPart3);
        $this->entityManager->persist($contract2);
        
        $contract3 = new Contract();
        $contract3->setTitle('Contract 3');
        $contract3->setCustomer($orgCustomer);
        $contract3->setExecutor($orgExecutor2);
        $contract3->addRoadPart($roadPart3);
        $contract3->addRoadPart($roadPart4);
        $this->entityManager->persist($contract3);
        
        $contract4 = new Contract();
        $contract4->setTitle('Contract 4');
        $contract4->setCustomer($orgCustomer);
        $contract4->setExecutor($orgExecutor1);
        $contract4->addRoadPart($roadPart5);
        $this->entityManager->persist($contract4);

        for($address = 0; $address <= 300000; $address += random_int(3000, 8000)) {
            $this->entityManager->persist(
                (new VideoStation())
                    ->setRoad($road)
                    ->setAddress($address)
            );
        }

        for ($address = 0; $address <= 40229; $address += random_int(1000, 2500)) {
            $this->entityManager->persist(
                (new VideoStation())
                    ->setRoad($road2)
                    ->setAddress($address)
            );
        }

        $this->entityManager->flush();

        $io->success('Bye!');

        return Command::SUCCESS;
    }
}
