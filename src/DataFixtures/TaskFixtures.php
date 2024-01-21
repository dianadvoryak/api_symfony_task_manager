<?php

namespace App\DataFixtures;

use App\Entity\Task;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TaskFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $tasksFixtures = [
            (new Task())
                ->setTitle('code')
                ->setDescription('Write some code')
                ->setCreatedAt(new \DateTimeImmutable('2022-10-09'))
                ->setDateComplete(new \DateTimeImmutable('2022-10-10'))
                ->setStatus(true),
            (new Task())
                ->setTitle('move')
                ->setDescription('Move to Berlin')
                ->setCreatedAt(new \DateTimeImmutable('2022-03-03'))
                ->setDateComplete(new \DateTimeImmutable('2022-10-10'))
                ->setStatus(true),
            (new Task())
                ->setTitle('emoji')
                ->setDescription('Use an emoji')
                ->setCreatedAt(new \DateTimeImmutable('2022-03-04'))
                ->setDateComplete(null)
                ->setStatus(false),
            (new Task())
                ->setTitle('cookie')
                ->setDescription('Make a cookie')
                ->setCreatedAt(new \DateTimeImmutable('2022-03-05'))
                ->setDateComplete(null)
                ->setStatus(false),
        ];

        foreach ($tasksFixtures as $task) {
            $manager->persist($task);
        }

        $manager->flush();
    }
}
