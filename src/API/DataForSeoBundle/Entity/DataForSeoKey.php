<?php

namespace App\API\DataForSeoBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class DataForSeoKey
 * @package App\Entity
 * @ORM\Entity(repositoryClass="App\API\DataForSeoBundle\Repository\DataForSeoKeyRepository")
 */
class DataForSeoKey
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $keyId;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $keyValue;

    /**
     * @ORM\OneToMany(targetEntity="App\API\DataForSeoBundle\Entity\DataForSeoRankTask", mappedBy="key")
     */
    private $rankTask;

    /**
     * DataForSeoKey constructor.
     * @param int $keyId
     * @param string $keyValue
     */
    public function __construct(int $keyId, string $keyValue)
    {
        $this->rankTask = new ArrayCollection();
        $this->setKeyId($keyId)
            ->setKeyValue($keyValue);
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getKeyId(): int
    {
        return $this->keyId;
    }

    /**
     * @param int $keyId
     * @return DataForSeoKey
     */
    public function setKeyId(int $keyId): DataForSeoKey
    {
        $this->keyId = $keyId;
        return $this;
    }

    /**
     * @return string
     */
    public function getKeyValue(): string
    {
        return $this->keyValue;
    }

    /**
     * @param string $keyValue
     * @return DataForSeoKey
     */
    public function setKeyValue(string $keyValue): DataForSeoKey
    {
        $this->keyValue = $keyValue;
        return $this;
    }

}
