.. include:: /Includes.rst.txt


.. _installation:

============
Installation
============

Installation Type
=================

Composer
--------

You can install `telephonedirectory` with following shell command:

.. code-block:: bash

   composer req jweiland/telephonedirectory

Extensionmanager
----------------

If you want to install `telephonedirectory` traditionally with Extensionmanager,
follow these steps:

#. Visit ExtensionManager

#. Switch over to `Get Extensions`

#. Search for `telephonedirectory`

#. Install extension

DEV Version (GIT)
-----------------

You can install the latest DEV Version with following GIT command:

.. code-block:: bash

   git clone https://github.com/jweiland-net/telephonedirectory.git

Scheduler Task
==============

You should add the Scheduler Task *Send Mail to Employee* which should be
executed each day. It will inform the registered employees to re-check
all their data after one year. If employee does not update his record
its record will be set to hidden one month later.
