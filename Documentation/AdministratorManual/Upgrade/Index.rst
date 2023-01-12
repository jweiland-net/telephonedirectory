.. include:: /Includes.rst.txt


.. _upgrade:

=======
Upgrade
=======

If you update/upgrade `telephonedirectory` to a newer version, please read this
section carefully!

Upgrade to version 4.0.0
========================

We have migrated from ObjectManager to GeneralUtility::makeInstance. This has
effects to our task in scheduler module. Please remove task
`Send mail to employee` and re-create it with the same configuration.
