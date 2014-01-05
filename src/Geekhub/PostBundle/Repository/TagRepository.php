<?php

namespace Geekhub\PostBundle\Repository;

use Doctrine\ORM\EntityRepository;

class TagRepository extends EntityRepository
{
    public function getTags()
    {
        $blogTags = $this->getEntityManager()->createQuery('SELECT t.title FROM GeekhubPostBundle:Tag t')->execute();

        $tags = array();
        foreach ($blogTags as $blogTag) {
            $tags = array_merge(explode(",", $blogTag['title']), $tags);
        }

        foreach ($tags as &$tag) {
            $tag = trim($tag);
        }

    return $tags;
    }

    public function getTagWeights($tags)
    {
        $tagWeights = array();
        if (empty($tags))

            return $tagWeights;

        foreach ($tags as $tag)
        {
            $tagWeights[$tag] = (isset($tagWeights[$tag])) ? $tagWeights[$tag] + 1 : 1;
        }

        $max = max($tagWeights);

        // Max of 5 weights
        $multiplier = ($max > 5) ? 5 / $max : 1;
        foreach ($tagWeights as &$tag) {

            $tag = ceil($tag * $multiplier);
        }

        return $tagWeights;
    }
}