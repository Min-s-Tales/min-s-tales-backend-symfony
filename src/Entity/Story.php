<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=App\Repository\StoryRepository::Class)
 */
class Story
{
    /**
     * @ORM\Column(name="story_id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue
     */
    private $idStory;

    /**
     * @ORM\Column(name="title", type="string", length=180, nullable=false, unique=true)
     * @Groups({"story:create", "story:read"})
     */
    private $title;

    /**
     * @ORM\Column(name="description", type="string", length=360, unique=false, nullable=true)
     * @Groups({"story:create", "story:read"})
     */
    private $description;

    /**
     * @ORM\Column(name="url_folder", type="string")
     * @Groups({"story:create", "story:read"})
     */
    private string $urlFolder = "";

    /**
     * @ORM\Column(name="url_icon", type="string", nullable=true)
     * @Groups({"story:create", "story:read"})
     */
    private $urlIcon;

    /**
     * @ORM\Column(name="url_stripe", type="string", nullable=true)
     * @Groups({"story:create", "story:read"})
     */
    private $urlStripe;

    /**
     * @ORM\Column(name="price", type="float", nullable=true)
     * @Groups({"story:create", "story:read"})
     */
    private $price;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="user_id", nullable=true, onDelete="CASCADE")
     * @ORM\Column(name="author", nullable=false)
     * @Groups({"story:create", "story:read"})
     */
    private $author;

    /**
     * @ORM\Column(name="nb_download", type="integer", nullable=true)
     * @Groups({"story:create", "story:read"})
     */
    private $nbDownload;


    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getUrlFolder(): string
    {
        return $this->urlFolder;
    }

    /**
     * @param string $urlFolder
     */
    public function setUrlFolder(string $urlFolder): void
    {
        $this->urlFolder = $urlFolder;
    }

    /**
     * @return mixed
     */
    public function getUrlIcon()
    {
        return $this->urlIcon;
    }

    /**
     * @param mixed $urlIcon
     */
    public function setUrlIcon($urlIcon): void
    {
        $this->urlIcon = $urlIcon;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price): void
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getNbDownload()
    {
        return $this->nbDownload;
    }

    /**
     * @param mixed $nbDownload
     */
    public function setNbDownload($nbDownload): void
    {
        $this->nbDownload = $nbDownload;
    }

    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param mixed $author
     */
    public function setAuthor(User $author): void
    {
        $this->author = $author;
    }

    /**
     * toString Handling Circular Reference
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->id;
    }

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
    public function getUrlStripe()
    {
        return $this->urlStripe;
    }

    /**
     * @param mixed $urlStripe
     */
    public function setUrlStripe($urlStripe): void
    {
        $this->urlStripe = $urlStripe;
    }

}
