<?php

namespace Geekhub\PostBundle\DataFixtures\ORM;

use Geekhub\PostBundle\Entity\About;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class LoadAboutData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $title = 'About me';
        $body = 'About me About me About me About me About me About me About me About me About me About me About me
                About me About me About me About me About me About me About me About me About me About me About me
                About me About me About me About me About me About me About me About me About me About me About me';
        $img = 'images/user.png';

            $about = new About();

            $about->setTitle($title);
            $about->setBody($body);
            $about->setImage($this->getReference($img));

            $manager->persist($about);

        $manager->flush();
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    function getOrder()
    {
        return 3;
    }
}