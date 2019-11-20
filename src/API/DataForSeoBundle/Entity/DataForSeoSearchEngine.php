<?php


namespace App\API\DataForSeoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class DataForSeoSearchEngine
 * @package App\API\DataForSeoBundle\Entity
 * @ORM\Entity(repositoryClass="App\API\DataForSeoBundle\Repository\DataForSeoSearchEngineRepository")
 */
class DataForSeoSearchEngine
{
    /**
     * @var int
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue()
     */
    private $id;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $seId;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $name;

    public function __construct(int $seId, string $name)
    {
        $this->setSeId($seId)
            ->setName($name);
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getSeId(): int
    {
        return $this->seId;
    }

    /**
     * @param int $seId
     * @return DataForSeoSearchEngine
     */
    public function setSeId(int $seId): DataForSeoSearchEngine
    {
        $this->seId = $seId;
        return $this;
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
     * @return DataForSeoSearchEngine
     */
    public function setName(string $name): DataForSeoSearchEngine
    {
        $this->name = $name;
        return $this;
    }
}
