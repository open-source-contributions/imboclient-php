<?php declare(strict_types=1);
namespace ImboClient\Response;

use ImboClient\Utils;
use Psr\Http\Message\ResponseInterface;

class DeletedImage extends ApiResponse
{
    private string $imageIdentifier;

    public function __construct(string $imageIdentifier)
    {
        $this->imageIdentifier = $imageIdentifier;
    }

    public static function fromHttpResponse(ResponseInterface $response): self
    {
        /** @var array{imageIdentifier:string} */
        $body = Utils::convertResponseToArray($response);
        $deletedImage = new self($body['imageIdentifier']);
        return $deletedImage->withResponse($response);
    }

    public function getImageIdentifier(): string
    {
        return $this->imageIdentifier;
    }

    protected function getArrayOffsets(): array
    {
        return [
            'imageIdentifier' => fn () => $this->getImageIdentifier(),
        ];
    }
}
