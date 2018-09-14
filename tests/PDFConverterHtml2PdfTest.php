<?php


use msti\PDFConverter\PDFConverterFactory;
use PHPUnit\Framework\TestCase;


class PDFConverterHtml2PdfTest extends TestCase
{

    public function testPDFConverterHtml2PdfCreatePdf()
    {
        $factory = new PDFConverterFactory();
        $vars = [
            'language' => 'nl',
            'orientation' => 'landscape',
            'papersize' => 'A8',
            'path' => '/tmp',
            'filename' => uniqid() . '.pdf'
        ];
        /** @var msti\PDFConverter\PDFConverterHtml2Pdf $converter */
        $converter = $factory->getPDFConverter('html2pdf');
        $filename = $converter->generate('some test content.. bla bla', $vars);

        $this->assertEquals($vars['path'] . '/' . $vars['filename'], $filename);
        $this->assertFileExists($filename);
        $this->assertEquals($vars['language'], $converter->getLang());
        $this->assertEquals('L', $converter->getPaperOrientation());
        $this->assertEquals($vars['papersize'], $converter->getPaperSize());
    }

    public function testPDFConverterHtml2PdfCreatePdfPortrait()
    {
        $factory = new PDFConverterFactory();
        $vars = [
            'filename' => uniqid() . '.pdf'
        ];
        /** @var msti\PDFConverter\PDFConverterHtml2Pdf $converter */
        $converter = $factory->getPDFConverter('html2pdf');
        $filename = $converter->generate('some test content.. bla bla', $vars);
        // Check defaults
        $this->assertStringStartsWith('/tmp', $filename);
        $this->assertEquals('P', $converter->getPaperOrientation());
        $this->assertEquals('A4', $converter->getPaperSize());
    }
}

