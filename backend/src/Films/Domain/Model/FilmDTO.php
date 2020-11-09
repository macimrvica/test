<?php declare(strict_types=1);


namespace App\Films\Domain\Model;

use App\Common\Domain\CreationDate;

final class FilmDTO
{
    private string $title;
    private string $url;
    private string $created;
    private string $director;
    private string $producer;
    private string $releaseDate;
    private string $openingCrawl;
    private int $episodeId;

    public static function fromArray(array $data): self
    {
        $dto = new static();

        $dto->title = $data['title'];
        $dto->url = $data['url'];
        $dto->created = CreationDate::fromString($data['created'])->asString();
        $dto->director = $data['director'];
        $dto->producer = $data['producer'];
        $dto->releaseDate = $data['release_date'];
        $dto->openingCrawl = $data['opening_crawl'];
        $dto->episodeId = $data['episode_id'];

        return $dto;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getCreated(): string
    {
        return $this->created;
    }

    public function getDirector(): string
    {
        return $this->director;
    }

    public function getProducer(): string
    {
        return $this->producer;
    }

    public function getReleaseDate(): string
    {
        return $this->releaseDate;
    }

    public function getOpeningCrawl(): string
    {
        return $this->openingCrawl;
    }

    public function getEpisodeId(): int
    {
        return $this->episodeId;
    }
}
