<?php

namespace App\API\DataForSeoBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\API\DataForSeoBundle\Repository\DataForSeoLocationRepository")
 */
class DataForSeoLocation
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
    private $locId;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $locName;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $locNameCanonical;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $locType;

    /**
     * @ORM\OneToMany(targetEntity="App\API\DataForSeoBundle\Entity\DataForSeoRankTask", mappedBy="loc")
     */
    private $rankTask;

    /**
     * DataForSeoLocation constructor.
     * @param int $locId
     * @param string $locName
     * @param string $locNameCanonical
     * @param string $locType
     */
    public function __construct(int $locId, string $locName, string $locNameCanonical, string $locType)
    {
        $this->rankTask = new ArrayCollection();
        $this->setLocId($locId)
            ->setLocName($locName)
            ->setLocNameCanonical($locNameCanonical)
            ->setLocType($locType);
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getLocId(): int
    {
        return $this->locId;
    }

    /**
     * @param int $locId
     * @return DataForSeoLocation
     */
    public function setLocId(int $locId): DataForSeoLocation
    {
        $this->locId = $locId;
        return $this;
    }

    /**
     * @return string
     */
    public function getLocName(): string
    {
        return $this->locName;
    }

    /**
     * @param string $locName
     * @return DataForSeoLocation
     */
    public function setLocName(string $locName): DataForSeoLocation
    {
        $this->locName = $locName;
        return $this;
    }

    /**
     * @return string
     */
    public function getLocNameCanonical(): string
    {
        return $this->locNameCanonical;
    }

    /**
     * @param string $locNameCanonical
     * @return DataForSeoLocation
     */
    public function setLocNameCanonical(string $locNameCanonical): DataForSeoLocation
    {
        $this->locNameCanonical = $locNameCanonical;
        return $this;
    }

    /**
     * @return string
     */
    public function getLocType(): string
    {

        return $this->locType;
    }

    /**
     * @param string $locType
     * @return DataForSeoLocation
     */
    public function setLocType(string $locType): DataForSeoLocation
    {
        $this->locType = $locType;
        return $this;
    }
}
