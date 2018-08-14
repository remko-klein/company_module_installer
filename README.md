# Company Module Installer
A sample for a composer plugin to install Drupal modules in a custom directory.
For example you can use this module to install company wide modules into a specific
directory like '<drupal>/modules/company' instead of '<drupal>/modules/custom'.

## Installation
Add this repo to the list of repositories in your composer.json file:

```
  "repositories": [
    {
      "type": "vcs",
      "url": "https://github.com/remko79/company_module_installer.git"
    }
  ]
```

Then install it: `composer require remko79/company_module_installer`.

## Configuration
The configuration is available in `src/custom_modules.json`:
```json
{
  "company-d8module": {
    "path": "web/modules/company/",
    "prefix": "d8modules/"
  },
  "company-d7module": {
    "path": "sites/all/modules/company/",
    "prefix": "d7modules/"
  }
}
```

Every package which has composer type `company-d8module` will be matched
and installed in directory `web/modules/company`.
 
Note: We've been grouping our company
wide modules for each Drupal version in our GitLab, so Drupal 8 modules require
a group (and naming prefix) of `d8modules/`.

## Example composer.json module file
```json
{
  "name": "d8modules/common",
  "description": "Common - Drupal 8 module",
  "type": "company-d8module",
  "license": "proprietary",
  "require": {
  }
}
```

Now after installing this module, composer will install this module 
in the `web/modules/company` directory instead of in the vendor directory.