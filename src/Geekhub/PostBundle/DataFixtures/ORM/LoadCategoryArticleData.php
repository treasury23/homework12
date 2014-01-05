<?php

namespace Geekhub\PostBundle\DataFixtures\ORM;

use Geekhub\PostBundle\Entity\CategoryArticle;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class LoadCategoryArticleData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $categoryArticles = array(
            'Symfony2',
            'Doctrine',
            'Twig'
        );

        foreach ($categoryArticles as $categoryArticle) {

            $category = new CategoryArticle();
            $category->setTitle($categoryArticle);
            $manager->persist($category);

            $this->addReference($categoryArticle, $category);
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
        return 4;
    }
}