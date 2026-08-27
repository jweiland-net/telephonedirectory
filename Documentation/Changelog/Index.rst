..  include:: /Includes.rst.txt


..  _changelog:

==========
Change log
==========

Version 4.1.1
=============

*   [SECURITY] `EmployeeController::updateAction()` did not validate the HMAC secret
    that protects an employee's edit link, allowing anyone who could guess or
    enumerate an employee UID to overwrite that employee's data without ever
    having received a valid edit link. The hash is now validated in
    `updateAction()` as well as in `editAction()`.

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
