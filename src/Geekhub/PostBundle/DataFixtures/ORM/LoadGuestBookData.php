<?php

namespace Geekhub\PostBundle\DataFixtures\ORM;

use Geekhub\PostBundle\Entity\GuestBook;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Symfony\Component\Yaml\Yaml;

class LoadGuestBookData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $posts = Yaml::parse(__DIR__ . '/Data/posts.yml');

        foreach ($posts['posts'] as $postsItem) {

            $post = new GuestBook();
            $post->setName($postsItem['name']);
            $post->setEmail($postsItem['email']);
            $post->setBody($postsItem['body']);

            $manager->persist($post);
        }

        $manager->flush();
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    function getOrder()
    {
        return 1;
    }
}