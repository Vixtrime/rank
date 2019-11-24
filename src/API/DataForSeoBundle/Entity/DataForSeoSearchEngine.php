<?php


namespace App\API\DataForSeoBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
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

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $language;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $localization;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $countryName;

    /**
     * @ORM\OneToMany(targetEntity="App\API\DataForSeoBundle\Entity\DataForSeoRankTask", mappedBy="se")
     */
    private $rankTask;

    /**
     * DataForSeoSearchEngine constructor.
     * @param int $seId
     * @param string $name
     * @param string $language
     * @param string $localization
     * @param string $countryName
     */
    public function __construct(int $seId, string $name, string $language, string $localization, string $countryName)
    {
        $this->rankTask = new ArrayCollection();
        $this->setSeId($seId)
            ->setName($name)
            ->setLanguage($language)
            ->setLocalization($localization)
            ->setCountryName($countryName);
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

    /**
     * @return string
     */
    public function getLanguage(): string
    {
        return $this->language;
    }

    /**
     * @param string $language
     * @return DataForSeoSearchEngine
     */
    public function setLanguage(string $language): DataForSeoSearchEngine
    {
        $this->language = $language;
        return $this;
    }

    /**
     * @return string
     */
    public function getLocalization(): string
    {
        return $this->localization;
    }

    /**
     * @param string $localization
     * @return DataForSeoSearchEngine
     */
    public function setLocalization(string $localization): DataForSeoSearchEngine
    {
        $this->localization = $localization;
        return $this;
    }

    /**
     * @return string
     */
    public function getCountryName(): string
    {
        return $this->countryName;
    }

    /**
     * @param string $countryName
     * @return DataForSeoSearchEngine
     */
    public function setCountryName(string $countryName): DataForSeoSearchEngine
    {
        $this->countryName = $countryName;
        return $this;
    }
}
