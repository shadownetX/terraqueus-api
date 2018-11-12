<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Yaml\Yaml;
use App\Entity\Tag;
use App\Entity\Article;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // Load some tags
        $tagsNameExemples = Yaml::parseFile(__DIR__ . "/tags.yaml");
        foreach ($tagsNameExemples as $tagName) {
            $tag = new Tag();
            $tag->setName($tagName);
            $manager->persist($tag);
        }
        $manager->flush();

        // Load some articles
        $articlesExemples = Yaml::parseFile(__DIR__ . "/articles.yaml");
        foreach ($articlesExemples as $articleExemple) {
            $article = new Article();
            $article->setTitle($articleExemple['title']);
            $article->setSubtitle($articleExemple['subtitle']);
            $article->setBody($articleExemple['body']);
            $article->setOnline((bool)random_int(0, 1));

            // Associate 1 to 3 specific tags
            $currentTags = [];
            for ($i = 0; $i < random_int(1, 3); $i++) {
                $currentTag = $tagsNameExemples[random_int(0, count($tagsNameExemples) - 1)];

                if (!in_array($currentTag, $currentTags)) {
                    $article->addTag($manager->getRepository("App:Tag")->findOneBy([
                        "name" => $currentTag,
                    ]));

                    array_push($currentTags, $currentTag);
                }
            }
            $manager->persist($article);
        }
        $manager->flush();
    }
}
