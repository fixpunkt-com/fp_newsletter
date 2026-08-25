<?php

declare(strict_types=1);

namespace Fixpunkt\FpNewsletter\Updates;

#[\TYPO3\CMS\Core\Attribute\UpgradeWizard('fixpunktFpNewsletterCTypeMigration')]
final class FixpunktFpNewsletterCTypeMigration extends \TYPO3\CMS\Core\Upgrades\AbstractListTypeToCTypeUpdate
{
    public function getTitle(): string
    {
        return 'Migrate "Fixpunkt FpNewsletter" plugins to content elements.';
    }

    public function getDescription(): string
    {
        return 'The "Fixpunkt FpNewsletter" plugins are now registered as content element. Update migrates existing records and backend user permissions.';
    }

    /**
     * This must return an array containing the "list_type" to "CType" mapping
     *
     * @return array<string, string>
     */
    protected function getListTypeToCTypeMapping(): array
    {
        return [
            'fpnewsletter_new' =>'fpnewsletter_new',
            'fpnewsletter_form' =>'fpnewsletter_form',
            'fpnewsletter_subscribeext' =>'fpnewsletter_subscribeext',
            'fpnewsletter_verify' =>'fpnewsletter_verify',
            'fpnewsletter_editemail' =>'fpnewsletter_editemail',
            'fpnewsletter_edit' =>'fpnewsletter_edit',
            'fpnewsletter_unsubscribe' =>'fpnewsletter_unsubscribe',
            'fpnewsletter_unsubscribelux' =>'fpnewsletter_unsubscribelux',
            'fpnewsletter_unsubscribemail' =>'fpnewsletter_unsubscribemail',
            'fpnewsletter_verifyunsubscribe' =>'fpnewsletter_verifyunsubscribe',
            'fpnewsletter_resend' =>'fpnewsletter_resend',
            'fpnewsletter_list' =>'fpnewsletter_list'
        ];
    }
}
