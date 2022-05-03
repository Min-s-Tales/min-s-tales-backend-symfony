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
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(name="title", type="string", length=180, nullable=false, unique=true)
     * @Groups({"story:create", "story:read"})
     */
    private $title;

    /**
     * @ORM\Column(name="description", type="string", length=180, unique=false, nullable=true)
     * @Groups({"story:create", "story:read"})
     */
    private $description;

    /**
     * @ORM\Column(name="url_folder", type="json")
     * @Groups({"story:create", "story:read"})
     */
    private array $urlFolder = [];

    /**
     * @ORM\Column(name="url_icon", type="string", nullable=true)
     * @Groups({"story:create", "story:read"})
     */
    private $urlIcon;

    /**
     * @ORM\Column(name="price", type="float", nullable=true)
     * @Groups({"story:create", "story:read"})
     */
    private $price;

    /**
     * @ORM\Column(name="id_autor", type="integer", nullable=false)
     * @Groups({"story:create", "story:read"})
     */
    private $idAutor;

    /**
     * @ORM\Column(name="nb_download", type="integer", nullable=true)
     * @Groups({"story:create", "story:read"})
     */
    private $nbDownload;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

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
     * @return array
     */
    public function getUrlFolder(): array
    {
        return $this->urlFolder;
    }

    /**
     * @param array $urlFolder
     */
    public function setUrlFolder(array $urlFolder): void
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
    public function getIdAutor()
    {
        return $this->idAutor;
    }

    /**
     * @param mixed $idAutor
     */
    public function setIdAutor($idAutor): void
    {
        $this->idAutor = $idAutor;
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


}
