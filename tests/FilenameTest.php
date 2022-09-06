<?php

namespace Alexmac\FilenameHelper\Tests;

use Alexmac\FilenameHelper\Filename;
use DateTime;

test('Appends string to filename', function () {
    $filename = Filename::create('test')
        ->append('suffix');

    expect((string) $filename)->toEqual('test_suffix');
});

test('Prepends string to filename', function () {
    $filename = Filename::create('test')
        ->prepend('prefix');

    expect((string) $filename)->toEqual('prefix_test');
});

test('Sets date on filename', function () {
    $filename = Filename::create('test')
        ->setDate(new DateTime('06-09-2022'));

    expect((string) $filename)->toEqual('2022_09_06_test');
});

test('Sets custom separator on filename', function () {
    $filename = Filename::create('test')
        ->setSeparator('-')
        ->setDate(new DateTime('06-09-2022'))
        ->append('suffix');

    expect((string) $filename)->toEqual('2022-09-06-test-suffix');
});

test('Sets extension on filename', function () {
    $filename = Filename::create('test')
        ->setExtension('csv');

    expect((string) $filename)->toEqual('test.csv');
});

test('Serializes filename as JSON', function () {
    $filename = Filename::create('test');
    expect(json_encode($filename))->toEqual('"test"');
});

test('Readme example is correct', function () {
    $filename = Filename::create('data-export')
        ->append('tenant-name')
        ->setDate(new DateTime)
        ->setSeparator('-')
        ->setExtension('csv');

    expect((string) $filename)->toEqual('2022-09-06-data-export-tenant-name.csv');
});
