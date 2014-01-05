<?php

namespace Geekhub\PostBundle\DataFixtures\ORM;

use Geekhub\PostBundle\Entity\Tag;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class LoadTagData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $tags = array(
            'Wordpress',
            'Symfony',
            'CSS',
            'Joomla',
            'Drupal'
        );

        foreach ($tags as $tag) {

            $tagObject = new Tag();

            $tagObject->setTitle($tag);

            $manager->persist($tagObject);

            $this->addReference($tag, $tagObject);
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
        return 5;
    }
}