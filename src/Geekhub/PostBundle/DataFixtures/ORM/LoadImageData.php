<?php

namespace Geekhub\PostBundle\DataFixtures\ORM;

use Geekhub\PostBundle\Entity\Image;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class LoadImageData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $images = array(
            'images/user.png',
            'images/1.jpg',
            'images/2.jpg',
            'images/3.jpg',
            'images/4.jpg',
            'images/5.jpg',
            'images/6.jpg',
            'images/7.jpg',
            'images/8.jpg',
            'images/9.jpg',
            'images/10.jpg'
        );

        foreach ($images as $image) {

            $img = new Image();

            $img->setPath($image);

            $manager->persist($img);

            $this->addReference($image, $img);
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
        return 2;
    }
}