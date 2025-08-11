<?php

declare(strict_types=1);

namespace Fixpunkt\FpNewsletter\Updates;

use TYPO3\CMS\Core\Database\Connection;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Database\Query\Restriction\DeletedRestriction;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Install\Attribute\UpgradeWizard;
use TYPO3\CMS\Install\Updates\DatabaseUpdatedPrerequisite;
use TYPO3\CMS\Install\Updates\UpgradeWizardInterface;

#[UpgradeWizard('fpNewsletterPluginPermissionUpdater')]
class PluginPermissionUpdater implements UpgradeWizardInterface
{
    public function getTitle(): string
    {
        return 'EXT:fp_newsletter: Migrate plugin permissions';
    }

    public function getDescription(): string
    {
        $description = 'This update wizard updates all permissions and allows **all** fp_newsletter plugins instead of the previous single plugin.';
        return $description . (' Count of affected groups: ' . count($this->getMigrationRecords()));
    }

    public function getPrerequisites(): array
    {
        return [
            DatabaseUpdatedPrerequisite::class,
        ];
    }

    public function updateNecessary(): bool
    {
        return $this->checkIfWizardIsRequired();
    }

    public function executeUpdate(): bool
    {
        return $this->performMigration();
    }

    public function checkIfWizardIsRequired(): bool
    {
        return count($this->getMigrationRecords()) > 0;
    }

    public function performMigration(): bool
    {
        $records = $this->getMigrationRecords();

        foreach ($records as $record) {
            $this->updateRow($record);
        }

        return true;
    }

    protected function getMigrationRecords(): array
    {
        $connectionPool = GeneralUtility::makeInstance(ConnectionPool::class);
        $queryBuilder = $connectionPool->getQueryBuilderForTable('be_groups');
        $queryBuilder->getRestrictions()->removeAll()->add(GeneralUtility::makeInstance(DeletedRestriction::class));

        return $queryBuilder
            ->select('uid', 'explicit_allowdeny')
            ->from('be_groups')
            ->where(
                $queryBuilder->expr()->like(
                    'explicit_allowdeny',
                    $queryBuilder->createNamedParameter('%' . $queryBuilder->escapeLikeWildcards('tt_content:list_type:fpnewsletter_') . '%')
                )
            )
            ->executeQuery()
            ->fetchAllAssociative();
    }

    protected function updateRow(array $row): void
    {
        $newList = str_replace('tt_content:list_type:fpnewsletter_', 'tt_content:CType:fpnewsletter_', $row['explicit_allowdeny']);
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('be_groups');
        $queryBuilder->update('be_groups')
            ->set('explicit_allowdeny', $newList)
            ->where(
                $queryBuilder->expr()->in(
                    'uid',
                    $queryBuilder->createNamedParameter($row['uid'], Connection::PARAM_INT)
                )
            )
            ->executeStatement();
    }
}
