<?php

namespace Geekhub\PostBundle\DataFixtures\ORM;

use Geekhub\PostBundle\Entity\Blog;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Symfony\Component\Yaml\Yaml;
use Doctrine\Common\Collections\ArrayCollection;

class LoadBlogData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $articles = Yaml::parse(__DIR__ . '/Data/articles.yml');

        foreach ($articles['articles'] as $articleItem) {

            $article = new Blog();
            $article->setTitle($articleItem['title']);
            $article->setDescription($articleItem['description']);
            $article->setImage($this->getReference($articleItem['image']));
            $article->setCategoryArticle($this->getReference($articleItem['category']));

            $article->setTags($this->getReferencesFromArray($articleItem['tags']));

            $manager->persist($article);
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
        return 6;
    }

    protected function getReferencesFromArray(array $array)
    {
        $outputReferences = new ArrayCollection();

        foreach ($array as $reference) {
            $outputReferences->add($this->getReference($reference));
        }

        return $outputReferences;
    }
}