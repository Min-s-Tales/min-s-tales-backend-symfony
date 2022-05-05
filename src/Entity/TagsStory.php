<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=App\Repository\tags::Class)
 * @ORM\Table(name="tags_story")
 */
class TagsStory
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\GeneratedValue
     */
    protected $id;

    /**
     * @ORM\Column(name="id_story", type="integer", nullable=false)
     * @ORM\ManyToMany(targetEntity="App\Entity\Story")
     * @ORM\JoinColumn(name="story_id", referencedColumnName="story_id")
     */
    private $idStory;

    /**
     * @ORM\Column(name="id_tags", type="integer", nullable=false)
     * @ORM\ManyToMany(targetEntity="App\Entity\Tags")
     * @ORM\JoinColumn(name="tags_id", referencedColumnName="id", onDelete="cascade")
     */
    private $idTags;

    /**
     * @return mixed
     */
    public function getIdStory()
    {
        return $this->idStory;
    }

    /**
     * @param mixed $idStory
     */
    public function setIdStory($idStory): void
    {
        $this->idStory = $idStory;
    }

    /**
     * @return mixed
     */
    public function getIdTags()
    {
        return $this->idTags;
    }

    /**
     * @param mixed $idTags
     */
    public function setIdTags($idTags): void
    {
        $this->idTags = $idTags;
    }

    /**
     * toString Handling Circular Reference
     * @return string
     */
    public function __toString(): string
    {
        return $this->idStory;
    }
}
