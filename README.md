# FilenameHelper

A naive helper utility for dynamically creating filenames with a builder-like interface.

## Usage

```php

use Alexmac\FilenameHelper\Filename;

$filename = Filename::create('data-export')
    ->append('tenant-name')
    ->setDate(new DateTime)
    ->setSeparator('-')
    ->setExtension('csv');

echo $filename; // 2022-09-06-data-export-tenant-name.csv

```
