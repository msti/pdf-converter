<?php

namespace msti\PDFConverter;


/**
 * Factory class to instantiate a FPDI object.
 */
class PDFConverterFactory
{

    /**
     * @var \msti\PDFConverter\PDFConverterInterface;
     */
    private $PDFConverter;

    private $pdf_creators = [
        'dompdf' =>
            [
                'pdfconverter_class' => '\msti\PDFConverter\PDFConverterDomPdf',
                'class' => '\Dompdf\Dompdf'
            ],
        'html2pdf' =>
            [
                'pdfconverter_class' => '\msti\PDFConverter\PDFConverterHtml2Pdf',
                'class' => '\Spipu\Html2Pdf\Html2Pdf'
            ],
    ];

    /**
     * @param $creator
     *  can be one of:
     *    dompdf
     *    html2pdf
     * @return \msti\PDFConverter\PDFConverterInterface
     */
    public function getPDFConverter($creator)
    {
        $pdf_creators = $this->pdf_creators;
        $creator = $this->getDefaultPdfCretor($creator);

        // Instantiate the creator requested
        if (isset($pdf_creators[$creator]) && class_exists($pdf_creators[$creator]['class'])) {
            $this->PDFConverter = new $pdf_creators[$creator]['pdfconverter_class']();
        } // Else instantiate any creator available
        else {
            foreach ($pdf_creators as $key => $pdf_creator_class) {
                if (class_exists($pdf_creator_class['class'])) {
                    $this->PDFConverter = new $pdf_creator_class['class']();
                    break;
                }
            }
        }
        return $this->PDFConverter;
    }


    private function getDefaultPdfCretor($creator)
    {
        // Make default pdf creator the dompdf
        if ($creator === null || $creator === '') {
            $creator = 'dompdf';
        }
        return $creator;
    }

}
