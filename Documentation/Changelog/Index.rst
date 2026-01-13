..  include:: /Includes.rst.txt


..  _changelog:

==========
Change log
==========

Version 6.1.1
=============

*   [BUGFIX] Temporary fix for frontend file upload with old TypeConverter

Version 6.1.0
=============

*   [REFACTORING] Migrated from legacy InjectTraits to modern Constructor Injection with PHP 8.2 readonly properties for all controllers and services.
*   [REFACTORING] Refactored TemplateRenderingService and EmployeeNotificationService to enforce Single Responsibility and strict typing.
*   [REFACTORING] Added redirectToEmployee helper to AbstractController to centralize internal navigation.
*   [TASK] Introduced ExtConf service to manage extension settings, eliminating "magic strings" and global array access.
*   [TASK] Added additionalSecretForHashGeneration to ext_conf_template.txt and ExtConf.xlf for administrative control over security salts.
*   [TASK] Integrated PSR-3 Logger into EmployeeController for professional error tracking.
*   [TASK] Updated German translations in de.locallang.xlf and corrected malformed XLIFF structures.
*   [BUGFIX] Added defensive checks in initializeUpdateAction to prevent fatal errors during property mapping.
*   [BUGFIX] Corrected redundant logic in the EmployeeNotificationService dispatch process.

Version 6.0.4
=============

*   [TASK] Updated wizard title with [extension] name format

Version 6.0.3
=============

*   [BUGFIX] Issue while trying to insert a duplicate record has been fixed

Version 6.0.2
=============

*   [BUGFIX] TCA Migrations for tables done

Version 6.0.1
=============

*   Update testing directory

Version 6.0.0
=============

*   Compatibility adjustments for TYPO3 13 LTS
*   Dropped support for older TYPO3 versions
*   Replaced StandaloneView usage with modern alternatives based on ViewInterface and ViewFactoryData
*   Migrated from deprecated Hashing Utility to HashService
*   Moved TypoScript configuration to the SiteConfiguration folder for better flexibility
*   Converted all list_type plugins to CType elements, including a migration wizard for existing tt_content records
*   Replaced all deprecated method calls with updated TYPO3 Core API functions

Version 5.0.0
=============

*   Numerous bug fixes to improve stability and reliability.
*   Various code optimizations for enhanced performance and maintainability.
*   Adoption of the TYPO3 Testing Framework for improved testing practices.
*   Enhanced flexibility with post and pre-processing using PSR-14 events.
*   New configuration options added for glossary integrated mode.
*   Removed deprecated API calls and functions.
*   Change mm relations of different properties in one mm table to different.

Version 4.1.0
=============

*   Remove all extbase stuff from scheduler task
*   Remove TSFE and ContentObjectRenderer from scheduler task
*   Add factory to retrieve employee as plain array with all sub-properties
*   Replace deprecated authToken with HashService
*   Use correct indents in html files
*   Use Site router to build URLs for frontend

Version 4.0.1
=============

*   Add module_sys_dmail_category to employee

Version 4.0.0
=============

*   Remove TYPO3 9 compatibility
*   Add TYPO3 11 compatibility
*   Add strict types to UnitTest files

Version 3.0.0
=============

Breaking
--------

*   getImage now returns an ObjectStorage use getFirstImage instead to retrieve employee image (firstImage instead of image in fluid)

Changes
-------

*   Now compatible with TYPO3 9.5 and 10.4
*   Remove TYPO3 8 compatibility
