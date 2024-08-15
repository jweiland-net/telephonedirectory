<?php

declare(strict_types=1);

/*
 * This file is part of the package jweiland/telephonedirectory.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace JWeiland\Telephonedirectory\Event;

use TYPO3\CMS\Extbase\Domain\Model\FileReference;

/**
 * Use this event, if you want to add further checks for uploaded images of telephonedirectory frontend form
 */
class PostCheckFileReferenceEvent
{
    /**
     * Array containing the original source (all files of $_FILES) of the request
     * just before PropertyMapping (UploadMultipleFilesConverter) will start
     *
     * @var array<string, mixed> $source
     */
    protected array $source;

    /**
     * Array key of the currently looped file
     */
    protected int $key = 0;

    /**
     * We check, if for current looped uploaded file a file record in DB
     * exists. If not, this value is null.
     */
    protected ?FileReference $alreadyPersistedImage;

    /**
     * This is the value of the currently looped uploaded file.
     * It contains one file out of $_FILES
     *
     * @var array<string, mixed> $uploadedFile
     */
    protected array $uploadedFile = [];

    /**
     * @param array<string, mixed> $source
     * @param array<string, mixed> $uploadedFile
     */
    public function __construct(
        array $source,
        int $key,
        ?FileReference $alreadyPersistedImage,
        array $uploadedFile,
    ) {
        $this->source = $source;
        $this->key = $key;
        $this->alreadyPersistedImage = $alreadyPersistedImage;
        $this->uploadedFile = $uploadedFile;
    }

    /**
     * @return array<string, mixed>
     */
    public function getSource(): array
    {
        return $this->source;
    }

    public function getKey(): int
    {
        return $this->key;
    }

    public function getAlreadyPersistedImage(): ?FileReference
    {
        return $this->alreadyPersistedImage;
    }

    /**
     * @return array<string, mixed>
     */
    public function getUploadedFile(): array
    {
        return $this->uploadedFile;
    }
}
