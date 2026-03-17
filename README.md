# fp_newsletter

Version 9.1.0

The TYPO3 extension fp_newsletter is designed to provide a newsletter subscription and unsubscription service for the
table tt_address which can be used by the extension mail OR for the table fe_users which can be used by luxletter or mail.
Furthermore, it is designed to be compatible with the GDPR. A log is written about every action in a separate table.
Old log entries can be deleted by a scheduler task.
Supports Google reCaptcha v3 or a mathematical captcha.
And there is a widget for the dashboard available.
Available languages: english, german/deutsch, french/français and italian/italiano.

You find the documentation in the folder "Documentation" / at typo3.org:
https://docs.typo3.org/p/fixpunkt/fp-newsletter/master/en-us/

Es gibt auch eine deutsche Anleitung/Dokumentation zu dieser Erweiterung:
https://docs.typo3.org/p/fixpunkt/fp-newsletter/master/de-de/


Version 9.0.0:
- Breaking: PlugIns changed from list_type to CType. You need to execute the Upgrade Wizard to change your PlugIns.
- Deprecation fixes for PHP 8.4 and TYPO3 13.

Version 9.0.1:
- New home url: https://github.com/fixpunkt-com/fp_newsletter
- Math. captcha field is bigger now.

Version 9.0.5:
- Update script for permissions added.
- Bugfix: LocalizationUtility not found.
- Bugfix: error fixed when language-uid is -1.
- Documentation.

Version 9.1.0:
- Sender-name and sender-mail is now optional.