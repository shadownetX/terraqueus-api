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
 * Article du blog.
 *
 * @ORM\Entity(repositoryClass="App\Repository\ArticleRepository")
 *
 */
class Article
{
    /**
     * Identifiant de l'article.
     *
     * @var int $id
     *
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * Titre de l'article.
     *
     * @var string $title
     *
     * @ORM\Column(type="string", length=255, unique=true)
     *
     * @Assert\NotBlank()
     */
    private $title;

    /**
     * Sous-titre de l'article.
     *
     * @var string|null $subtitle
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     */
    private $subtitle;

    /**
     * Slug de l'article.
     *
     * @var string $slug
     *
     * @ORM\Column(type="string", length=255, unique=true)
     *
     * @Gedmo\Slug(fields={"title"})
     *
     */
    private $slug;

    /**
     * Corps de l'article.
     *
     * @var string $body
     *
     * @ORM\Column(type="text")
     *
     * @Assert\NotBlank()
     */
    private $body;

    /**
     * L'article est-il en ligne ?
     *
     * @var boolean $online
     *
     * @ORM\Column(type="boolean")
     */
    private $online = false;

    /**
     * Tags associés à un ou plusieurs articles.
     *
     * @var ArrayCollection $tags
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Tag", inversedBy="articles")
     */
    private $tags;

    /**
     * Date de création de l'article.
     *
     * @var \DateTime $createdAt
     *
     * @ORM\Column(type="datetime")
     *
     * @Gedmo\Timestampable(on="create")
     */
    private $createdAt;

    /**
     * Date de mise à jour de l'article.
     *
     * @var \DateTime $updatedAt
     *
     * @ORM\Column(type="datetime")
     *
     * @Gedmo\Timestampable(on="update")
     */
    private $updatedAt;

    /**
     * Date de modification de l'article.
     *
     * @var \DateTime $contentChanged
     *
     * @ORM\Column(type="datetime", nullable=true)
     *
     * @Gedmo\Timestampable(on="change", field={"title", "subtitle", "body"})
     */
    private $contentChanged;

    public function __construct()
    {
        $this->tags = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string $title
     *
     * @return Article
     */
    public function setTitle(string $title): Article
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getSubtitle(): string
    {
        return $this->subtitle;
    }

    /**
     * @param string $subtitle
     *
     * @return Article
     */
    public function setSubtitle(string $subtitle): Article
    {
        $this->subtitle = $subtitle;

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
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * @param string $body
     *
     * @return Article
     */
    public function setBody(string $body): Article
    {
        $this->body = $body;

        return $this;
    }

    /**
     * @return bool
     */
    public function isOnline(): bool
    {
        return $this->online;
    }

    /**
     * @param bool $online
     *
     * @return Article
     */
    public function setOnline(bool $online): Article
    {
        $this->online = $online;

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getTags(): ArrayCollection
    {
        return $this->tags;
    }

    /**
     * Ajout d'un tag à l'article.
     *
     * @param Tag $tag
     *
     * @return Article
     */
    public function addTag(Tag $tag): Article
    {
        $this->tags[] = $tag;

        return $this;
    }

    /**
     * Supression d'un tag à l'article.
     *
     * @param Tag $tag
     *
     * @return Article
     */
    public function removeTag(Tag $tag): Article
    {
        $this->tags->removeElement($tag);

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): ?\DateTime
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

    /**
     * @return \DateTime
     */
    public function getContentChanged(): \DateTime
    {
        return $this->contentChanged;
    }
}