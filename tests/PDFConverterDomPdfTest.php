<?php


use msti\PDFConverter\PDFConverterFactory;
use PHPUnit\Framework\TestCase;


class PDFConverterDomPdfTest extends TestCase
{

    public function testPDFConverterDomPdfCreatePdf()
    {
        $factory = new PDFConverterFactory();
        $vars = [
            'compress' => 0,
            'orientation' => 'landscape',
            'papersize' => 'A8',
            'path' => '/tmp',
            'filename' => uniqid() . '.pdf',
        ];
        /** @var msti\PDFConverter\PDFConverterDomPdf $converter */
        $converter = $factory->getPDFConverter('dompdf');
        $filename = $converter->generate('some test content.. bla bla', $vars);

        $this->assertEquals($vars['path'] . '/' . $vars['filename'], $filename);
        $this->assertFileExists($filename);
        $this->assertEquals($vars['compress'], $converter->getCompress());
        $this->assertEquals($vars['orientation'], $converter->getPaperOrientation());
        $this->assertEquals($vars['papersize'], $converter->getPaperSize());
    }

    public function testPDFConverterDomPdfCreatePdfDefaults()
    {
        $factory = new PDFConverterFactory();
        $vars = [
            'compress' => 1,
            'filename' => uniqid() . '.pdf'
        ];
        /** @var msti\PDFConverter\PDFConverterDomPdf $converter */
        $converter = $factory->getPDFConverter('dompdf');
        $filename = $converter->generate('some test content.. bla bla', $vars);
        // Check non-default compress value
        $this->assertEquals($vars['compress'], $converter->getCompress());
        // Check defaults
        $this->assertStringStartsWith('/tmp', $filename);
        $this->assertEquals('portrait', $converter->getPaperOrientation());
        $this->assertEquals('A4', $converter->getPaperSize());

    }

}

