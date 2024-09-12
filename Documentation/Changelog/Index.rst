..  include:: /Includes.rst.txt


..  _changelog:

==========
Change log
==========

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
