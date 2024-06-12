# TYPO3 Extension `telephonedirectory`

[![Packagist][packagist-logo-stable]][extension-packagist-url]
[![Latest Stable Version][extension-build-shield]][extension-ter-url]
[![License][LICENSE_BADGE]][extension-packagist-url]
[![Total Downloads][extension-downloads-badge]][extension-packagist-url]
[![Monthly Downloads][extension-monthly-downloads]][extension-packagist-url]
[![TYPO3 12.4][TYPO3-shield]][TYPO3-12-url]

![Build Status](https://github.com/jweiland-net/telephonedirectory/actions/workflows/ci.yml/badge.svg)

With `telephonedirectory` you can organize your contact persons and buildings.

## 1 Features

* Create and manage employees

## 2 Usage

### 2.1 Installation

#### Installation using Composer

The recommended way to install the extension is using Composer.

Run the following command within your Composer based TYPO3 project:

```
composer require jweiland/telephonedirectory
```

#### Installation as extension from TYPO3 Extension Repository (TER)

Download and install `telephonedirectory` with the extension manager module.

### 2.2 Minimal setup

1) Include the static TypoScript of the extension.
2) Create employee and other records on a sysfolder.
3) Add telephonedirectory plugin on a page and select at least the sysfolder as startingpoint.

<!-- MARKDOWN LINKS & IMAGES -->

[extension-build-shield]: https://poser.pugx.org/jweiland/telephonedirectory/v/stable.svg?style=for-the-badge

[extension-downloads-badge]: https://poser.pugx.org/jweiland/telephonedirectory/d/total.svg?style=for-the-badge

[extension-monthly-downloads]: https://poser.pugx.org/jweiland/telephonedirectory/d/monthly?style=for-the-badge

[extension-ter-url]: https://extensions.typo3.org/extension/telephonedirectory/

[extension-packagist-url]: https://packagist.org/packages/jweiland/telephonedirectory/

[packagist-logo-stable]: https://img.shields.io/badge/--grey.svg?style=for-the-badge&logo=packagist&logoColor=white

[TYPO3-12-url]: https://get.typo3.org/version/12

[TYPO3-shield]: https://img.shields.io/badge/TYPO3-12.4-green.svg?style=for-the-badge&logo=typo3

[LICENSE_BADGE]: http://poser.pugx.org/jweiland/telephonedirectory/license?style=for-the-badge
