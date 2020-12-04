# TYPO3 Extension `telephonedirectory`

![Build Status](https://github.com/jweiland-net/telephonedirectory/workflows/CI/badge.svg)

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
