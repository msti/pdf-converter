<?php


use PHPUnit\Framework\TestCase;


class PDFConverterFactoryTest extends TestCase
{
    // Test dompdf instance is created
    public function testDomPdfConstructor()
    {
        $factory = new \msti\PDFConverter\PDFConverterFactory();
        $converter = $factory->getPDFConverter('dompdf');
        $this->assertInstanceOf('msti\PDFConverter\PDFConverterDomPdf', $converter);
    }

    // Test dompdf instance is created when non is defined
    public function testDomPdfConstructorDefault()
    {
        $factory = new \msti\PDFConverter\PDFConverterFactory();
        $converter = $factory->getPDFConverter('');
        $this->assertInstanceOf('msti\PDFConverter\PDFConverterDomPdf', $converter);
    }

    // Test html2pdf instance is created
    public function testHtml2PdfConstructor()
    {
        $factory = new \msti\PDFConverter\PDFConverterFactory();
        $converter = $factory->getPDFConverter('html2pdf');
        $this->assertInstanceOf('msti\PDFConverter\PDFConverterHtml2Pdf', $converter);
    }

}

