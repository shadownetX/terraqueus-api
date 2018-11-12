<?php

/**
 * This file is part of the terraqueus-api package.
 *
 * (c) thiebaudet.fr <thomas@thiebaudet.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Tag du blog.
 *
 * @ORM\Entity(repositoryClass="App\Repository\TagRepository")
 */
class Tag
{
    /**
     * Identifiant du tag.
     *
     * @var int $id
     *
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * Nom du tag.
     *
     * @var string $name
     *
     * @ORM\Column(type="string", length=50, unique=true)
     *
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * Slug du tag.
     *
     * @var string $slug
     *
     * @ORM\Column(type="string", length=50, unique=true)
     *
     * @Gedmo\Slug(fields={"name"})
     *
     */
    private $slug;

    /**
     * Articles associés à un ou plusieurs tags.
     *
     * @var ArrayCollection $articles
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Article", mappedBy="tags")
     */
    private $articles;

    /**
     * Date de création du tag.
     *
     * @var \DateTime $createdAt
     *
     * @ORM\Column(type="datetime")
     *
     * @Gedmo\Timestampable(on="create")
     */
    private $createdAt;

    /**
     * Date de mise à jour du tag.
     *
     * @var \DateTime $updatedAt
     *
     * @ORM\Column(type="datetime")
     *
     * @Gedmo\Timestampable(on="update")
     */
    private $updatedAt;

    public function __construct()
    {
        $this->articles = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return Tag
     */
    public function setName(string $name): Tag
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * Ajout d'un article à un tag.
     *
     * @param Article $article
     *
     * @return Tag
     */
    public function addTag(Article $article): Tag
    {
        $this->articles[] = $article;

        return $this;
    }

    /**
     * Supression d'un article à un tag.
     *
     * @param Article $article
     *
     * @return Tag
     */
    public function removeTag(Article $article): Tag
    {
        $this->articles->removeElement($article);

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getArticles(): ArrayCollection
    {
        return $this->articles;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }
}