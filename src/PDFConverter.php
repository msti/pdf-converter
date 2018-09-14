<?php

namespace msti\PDFConverter;

/**
 * Class PDFConverter.
 */
class PDFConverter
{

    /**
     * @var \msti\PDFConverter\PDFConverterFactory
     */
    protected $pdf_creator_factory;

    /**
     * Constructs a new PDFConverterFactory object.
     * @param \msti\PDFConverter\PDFConverterFactory $pdf_creator_factory
     */
    public function __construct(PDFConverterFactory $pdf_creator_factory = null)
    {
        $this->pdf_creator_factory = $pdf_creator_factory ?: new PDFConverterFactory();
    }

    /**
     * @param string $creator The name of one of the pdf generators. Currently dompdf or html2pdf. Leave blank to use any available.
     * @param string $contents The text to be printed in the PDF
     * @param array $vars Options to be sent to the PDF generator.
     * @return string The path of the PDF file
     */
    public function generate(string $creator, string $contents, array $vars)
    {
        $PDFConverter = $this->pdf_creator_factory->getPDFConverter($creator);
        $file = $PDFConverter->generate($contents, $vars);
        return $file;
    }


}
