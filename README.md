## About

This library allows you to use different PDF converter backends for producing pdf files. Currently supports [dompdf](https://github.com/dompdf/dompdf) and [html2pdf](https://github.com/spipu/html2pdf).

## Installation

> composer require msti/pdf-converter

Also, at least one of dompdf or html2pdf is required:

> composer require dompdf/dompdf

or

> composer require spipu/html2pdf




## Usage

````
$vars = [
    'orientation' => 'landscape',
    'papersize' => 'A4',
    'path' => '/tmp',
    'filename' => 'pdf-converter.pdf'
];

$contents = '<strong>hello there</strong>';

$filename = new PDFConverterFactory()->getPDFConverter('html2pdf')->generate($contents, $vars);
````

