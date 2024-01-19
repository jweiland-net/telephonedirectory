# TYPO3 Extension `telephonedirectory`

[![Latest Stable Version](https://poser.pugx.org/jweiland/telephonedirectory/v/stable.svg)](https://packagist.org/packages/jweiland/telephonedirectory)
[![TYPO3 10.4](https://img.shields.io/badge/TYPO3-10.4-green.svg)](https://get.typo3.org/version/10)
[![TYPO3 11.5](https://img.shields.io/badge/TYPO3-11.5-green.svg)](https://get.typo3.org/version/11)
[![License](http://poser.pugx.org/jweiland/telephonedirectory/license)](https://packagist.org/packages/jweiland/telephonedirectory)
[![Total Downloads](https://poser.pugx.org/jweiland/telephonedirectory/downloads.svg)](https://packagist.org/packages/jweiland/telephonedirectory)
[![Monthly Downloads](https://poser.pugx.org/jweiland/telephonedirectory/d/monthly)](https://packagist.org/packages/jweiland/telephonedirectory)
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
