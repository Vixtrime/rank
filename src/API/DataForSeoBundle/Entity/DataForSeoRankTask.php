<?php


namespace App\API\DataForSeoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class DataForSeoRankTask
 * @package App\API\DataForSeoBundle\Entity
 * @ORM\Entity(repositoryClass="")
 */
class DataForSeoRankTask
{
    /**
     * @var int
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var int
     * @ORM\Column(type="bigint")
     */
    private $apiId;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $token;

    /**
     * @var int
     * @ORM\Column(type="smallint")
     */
    private $priority;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $site;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    private $resultSeCheckUrl;

    /**
     * @var int
     * @ORM\Column(type="bigint", nullable=true)
     */
    private $resultsCount;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    private $resultSnippet;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    private $resultExtra;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    private $resultTitle;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    private $resultUrl;

    /**
     * @var int
     * @ORM\Column(type="integer", nullable=true)
     */
    private $resultPosition;


    /**
     * @var int
     * @ORM\Column(type="smallint")
     */
    private $status;

    /**
     * @var DataForSeoSearchEngine
     * @ORM\ManyToOne(targetEntity="App\API\DataForSeoBundle\Entity\DataForSeoSearchEngine", inversedBy="rankTask")
     */
    private $se;

    /**
     * @var DataForSeoLocation
     * @ORM\ManyToOne(targetEntity="App\API\DataForSeoBundle\Entity\DataForSeoLocation", inversedBy="rankTask")
     */
    private $loc;

    /**
     * @var DataForSeoKey
     * @ORM\ManyToOne(targetEntity="App\API\DataForSeoBundle\Entity\DataForSeoKey", inversedBy="rankTask")
     */
    private $key;

    /**
     * DataForSeoRankTask constructor.
     * @param string $token
     * @param int $priority
     * @param string $site
     * @param DataForSeoSearchEngine $se
     * @param DataForSeoLocation $loc
     */
    public function __construct(string $token, int $priority, string $site, DataForSeoSearchEngine $se, DataForSeoLocation $loc)
    {
        $this->setToken($token)
            ->setPriority($priority)
            ->setSite($site)
            ->setSe($se)
            ->setLoc($loc);
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @param string $token
     * @return DataForSeoRankTask
     */
    public function setToken(string $token): DataForSeoRankTask
    {
        $this->token = $token;
        return $this;
    }

    /**
     * @return DataForSeoSearchEngine
     */
    public function getSe(): DataForSeoSearchEngine
    {
        return $this->se;
    }

    /**
     * @param DataForSeoSearchEngine $se
     * @return DataForSeoRankTask
     */
    public function setSe(DataForSeoSearchEngine $se): DataForSeoRankTask
    {
        $this->se = $se;
        return $this;
    }

    /**
     * @return DataForSeoLocation
     */
    public function getLoc(): DataForSeoLocation
    {
        return $this->loc;
    }

    /**
     * @param DataForSeoLocation $loc
     * @return DataForSeoRankTask
     */
    public function setLoc(DataForSeoLocation $loc): DataForSeoRankTask
    {
        $this->loc = $loc;
        return $this;
    }

    /**
     * @return int
     */
    public function getPriority(): int
    {
        return $this->priority;
    }

    /**
     * @param int $priority
     * @return DataForSeoRankTask
     */
    public function setPriority(int $priority): DataForSeoRankTask
    {
        $this->priority = $priority;
        return $this;
    }

    /**
     * @return string
     */
    public function getSite(): string
    {
        return $this->site;
    }

    /**
     * @param string $site
     * @return DataForSeoRankTask
     */
    public function setSite(string $site): DataForSeoRankTask
    {
        $this->site = $site;
        return $this;
    }

    /**
     * @return int
     */
    public function getApiId(): int
    {
        return $this->apiId;
    }

    /**
     * @param int $apiId
     * @return DataForSeoRankTask
     */
    public function setApiId(int $apiId): DataForSeoRankTask
    {
        $this->apiId = $apiId;
        return $this;
    }

    /**
     * @return DataForSeoKey
     */
    public function getKey(): DataForSeoKey
    {
        return $this->key;
    }

    /**
     * @param DataForSeoKey $key
     * @return DataForSeoRankTask
     */
    public function setKey(DataForSeoKey $key): DataForSeoRankTask
    {
        $this->key = $key;
        return $this;
    }

    /**
     * @return string
     */
    public function getResultSeCheckUrl(): string
    {
        return $this->resultSeCheckUrl;
    }

    /**
     * @param string $resultSeCheckUrl
     * @return DataForSeoRankTask
     */
    public function setResultSeCheckUrl(string $resultSeCheckUrl): DataForSeoRankTask
    {
        $this->resultSeCheckUrl = $resultSeCheckUrl;
        return $this;
    }

    /**
     * @return int
     */
    public function getResultsCount(): int
    {
        return $this->resultsCount;
    }

    /**
     * @param int $resultsCount
     * @return DataForSeoRankTask
     */
    public function setResultsCount(int $resultsCount): DataForSeoRankTask
    {
        $this->resultsCount = $resultsCount;
        return $this;
    }

    /**
     * @return string
     */
    public function getResultSnippet(): string
    {
        return $this->resultSnippet;
    }

    /**
     * @param string|null $resultSnippet
     * @return DataForSeoRankTask
     */
    public function setResultSnippet($resultSnippet): DataForSeoRankTask
    {
        $this->resultSnippet = $resultSnippet;
        return $this;
    }

    /**
     * @return string
     */
    public function getResultExtra(): string
    {
        return $this->resultExtra;
    }

    /**
     * @param string $resultExtra
     * @return DataForSeoRankTask
     */
    public function setResultExtra(string $resultExtra): DataForSeoRankTask
    {
        $this->resultExtra = $resultExtra;
        return $this;
    }

    /**
     * @return string
     */
    public function getResultTitle(): string
    {
        return $this->resultTitle;
    }

    /**
     * @param string|null $resultTitle
     * @return DataForSeoRankTask
     */
    public function setResultTitle($resultTitle): DataForSeoRankTask
    {
        $this->resultTitle = $resultTitle;
        return $this;
    }

    /**
     * @return string
     */
    public function getResultUrl(): string
    {
        return $this->resultUrl;
    }

    /**
     * @param string|null $resultUrl
     * @return DataForSeoRankTask
     */
    public function setResultUrl($resultUrl): DataForSeoRankTask
    {
        $this->resultUrl = $resultUrl;
        return $this;
    }

    /**
     * @return int
     */
    public function getResultPosition(): int
    {
        return $this->resultPosition;
    }

    /**
     * @param int|null $resultPosition
     * @return DataForSeoRankTask
     */
    public function setResultPosition($resultPosition): DataForSeoRankTask
    {
        $this->resultPosition = $resultPosition;
        return $this;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @param int $status
     * @return DataForSeoRankTask
     */
    public function setStatus(int $status): DataForSeoRankTask
    {
        $this->status = $status;
        return $this;
    }

}
