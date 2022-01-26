<?php

declare(strict_types=1);

/*
 * This file is part of the package jweiland/telephonedirectory.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace JWeiland\Telephonedirectory\Updater;

/**
 * Migrate subjectfield field to subjectfields field in office table
 */
class SubjectFieldToSubjectFieldsUpdater extends AbstractSingleFieldToMmUpdater
{
    public function getIdentifier(): string
    {
        return 'telephonedirectoryUpdateSubjectFieldToSubjectFields';
    }

    public function getTitle(): string
    {
        return '[telephonedirectory] Update subjectfield to subjectfields field';
    }

    public function getDescription(): string
    {
        return 'Migrate existing subjectfields from the single subjectfield field to the subjectfields field which allows usage of multiple subjectfields';
    }

    protected function getTableName(): string
    {
        return 'tx_telephonedirectory_domain_model_office';
    }

    protected function getMmTableName(): string
    {
        return 'tx_telephonedirectory_office_mm';
    }

    protected function getOldFieldName(): string
    {
        return 'subject_field';
    }

    protected function getNewFieldName(): string
    {
        return 'subject_fields';
    }
}
