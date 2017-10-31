# PHPgs

This package provides PHP Wrapper for **GhostScript**.
It also provides a simple tool for **PDF** pages splitting / merging.

## Installation

```bash
composer require webit/phpgs=^1.0
```

## Usage

### Executor

For general purpose use ***Executor*** as a generic wrapper for the Ghost Script

```php
use Webit\PHPgs\ExecutorBuilder;
use Webit\PHPgs\Input;
use Webit\PHPgs\Output;
use Webit\PHPgs\Options\Options;
use Webit\PHPgs\Options\Device;

/** @var \Webit\PHPgs\Executor $executor */
$executor = ExecutorBuilder::create()->setGhostScriptBin('/path/to/the/binary/of/gs')->build();

$input = Input::singleFile('/path/to/your/input_file');
$output = Output::create('/path/to/your/tempdir/output.pdf');

// Please note Options class is immutable (every change creates a new instance)
$options = Options::create(Device::pdfWrite())
            // set predefined options (see Options class for all predefined options)
            ->withNoTransparency()
            ->useCropBox()
            ->useCIEColor()
            // change any option you need
            ->withOption('-dWhatever', 'value of whatever');
            
$executor->execute($input, $output, $options);

```

### PdfManipulator

***PdfManipulator*** provides simplified interface for PDF splitting / merging

#### Merging

```php
use Webit\PHPgs\Pdf\PdfManipulator;

$pdfManipulator = new PdfManipulator($executor);

$input = Input::multipleFiles(
    array(
        'one.pdf',
        'two.pdf',
        'three.pdf'
    )
);

$output = Output::create('/temp-dir/random-5322/output.pdf');

$customOptions = Options::create(); // optional

$pdfManipulator->merge($input, $output, $customOptions);

``` 

#### Splitting pages

```php
use Webit\PHPgs\Pdf\PdfManipulator;

$pdfManipulator = new PdfManipulator($executor);

$input = Input::singleFile('multipage.pdf');

// multi page output
$output = Output::create('/temp-dir/random-12322/output-%d.pdf');

// single page output
// $output = Output::create('/temp-dir/random-12322/output.pdf');

$customOptions = Options::create(); // optional

// splitting pages from 5 to 10
$pdfManipulator->split($input, $output, 5, 10, $customOptions);
// produces output-5.pdf, output-6.pdf, ...

// splitting pages from 5 to the last page
$pdfManipulator->split($input, $output, 5, null, $customOptions);
// produces output-5.pdf, output-6.pdf, ...

// splitting pages from 1 to 10
$pdfManipulator->split($input, $output, null, 10, $customOptions);
// produces output-1.pdf, output-2.pdf, ..., output-10.pdf

``` 

**Note:** To make sure multi-page splitting will work properly, an output ***always*** must refer to an ***empty*** directory. 

## Tests

```bash
docker-compose run --rm php5 ./vendor/bin/phpunit tests/Pdf/PdfManipulatorIntegrationTest.php
```
