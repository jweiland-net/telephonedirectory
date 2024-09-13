..  include:: /Includes.rst.txt


..  _upgrade:

=======
Upgrade
=======

If you update/upgrade `telephonedirectory` to a newer version, please read this
section carefully!

Upgrade to version 5.0.0
========================

The Telephonedirectory extension has been significantly updated in
version 5.0.0. This release includes several new features, bug fixes,
code optimizations, and improvements in testing. Here are the key highlights:

1. **Migration of mm record tables**:
    - We changed the relation of the table `tx_telephonedirectory_office_mm` to
 `department` and `subjectfield` changed to two new mm tables for better
 indexing and performance. So a new upgrade wizard introduced for migrating
 the old relations to this new tables `tx_telephonedirectory_domain_model_office_department_mm`
 and `tx_telephonedirectory_domain_model_office_department_mm`.

2. **Enhanced Flexibility with PSR-14 Events**:
    The extension now supports post and pre-processing using PSR-14 events,
providing greater flexibility and customization options.

3. **Glossary Integrated Mode**:
    - New configuration options have been added to enable glossary integrated
mode, enhancing the user experience and functionality.

This update makes the Telephonedirectory extension more robust, flexible,
and easier to maintain. The new features and optimizations will help users
achieve better performance and customization in their TYPO3 projects.

Upgrade to version 4.1.0
========================

As we have marked `storagePid` and `detailViewPid` in scheduler task as `int`
you have to delete the task and re-create it.

Upgrade to version 4.0.0
========================

We have migrated from ObjectManager to GeneralUtility::makeInstance. This has
effects to our task in scheduler module. Please remove task
`Send mail to employee` and re-create it with the same configuration.
