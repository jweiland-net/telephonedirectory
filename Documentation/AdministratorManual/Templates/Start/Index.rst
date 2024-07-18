..  include:: /Includes.rst.txt


..  _changeTemplates:

============================
Changing & editing templates
============================

EXT:telephonedirectory is using fluid as template engine. If you are using fluid
already, you might skip this section.

This documentation won't bring you all information about fluid but only the
most important things you need for using it. You can get
more information in books like the one of `Jochen Rau und Sebastian
Kurfürst <http://www.amazon.de/Zukunftssichere-TYPO3-Extensions-mit-
Extbase-Fluid/dp/3897219654/>`_ or online, e.g. at
`http://wiki.typo3.org/Fluid <http://wiki.tpyo3.org/Fluid>`_ or many
other sites.

Changing paths of the template
==============================

You should never edit the original templates of an extension as those changes
will vanish if you upgrade the extension. As any extbase based extension,
you can find the templates in the directory ``Resources/Private/``.

If you want to change a template, copy the desired files to the directory
where you store the templates. This can be a directory in ``EXT:sitepackage``.
Multiple fallbacks can be defined which makes it far easier to customize the
templates.

..  code-block:: typoscript

    plugin.tx_telephonedirectory {
      view {
        templateRootPaths >
        templateRootPaths {
          0 = EXT:telephonedirectory/Resources/Private/Templates/
          1 = EXT:sitepackage/Resources/Private/ext/telephonedirectory/Templates/
        }
        partialRootPaths >
        partialRootPaths {
          0 = EXT:telephonedirectory/Resources/Private/Partials/
          1 = EXT:sitepackage/Resources/Private/ext/telephonedirectory/Partials/
        }
        layoutRootPaths >
        layoutRootPaths {
          0 = EXT:telephonedirectory/Resources/Private/Layouts/
          1 = EXT:sitepackage/Resources/Private/ext/telephonedirectory/Layouts/
        }
      }
    }

Change the templates using TypoScript constants
===============================================

You can use the following TypoScript in the **constants** to change
the paths

..  code-block:: typoscript

    plugin.tx_telephonedirectory {
      view {
        templateRootPath = EXT:sitepackage/Resources/Private/ext/telephonedirectory/Templates/
        partialRootPath = EXT:sitepackage/Resources/Private/ext/telephonedirectory/Partials/
        layoutRootPath = EXT:sitepackage/Resources/Private/ext/telephonedirectory/Layouts/
      }
    }
