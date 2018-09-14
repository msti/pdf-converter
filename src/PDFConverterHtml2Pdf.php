<?php

namespace msti\PDFConverter;

use Spipu\Html2Pdf\Html2Pdf;


class PDFConverterHtml2Pdf extends PDFConverterAbstract
{

    private $language;

    /**
     * @param string $contents
     * @param array $vars
     * @return string
     * @throws \Spipu\Html2Pdf\Exception\Html2PdfException
     */
    public function generate(string $contents, array $vars = [])
    {
        // Sets the internal variables to the $vars array
        $this->setVars($vars);

        // Get the configurations
        $orientation = $this->getPaperOrientation();
        $size = $this->getPaperSize();
        $lang = $this->getLang();
        $filename = $this->getPath() . '/' . $this->getFileName();

        $html2pdf = new Html2Pdf($orientation, $size, $lang);
        $html2pdf->writeHTML($contents);
        $html2pdf->output($filename, 'F');

        return $filename;
    }

    /**
     * Translate the orientation to the format used by the html2pdf library
     * @param array $vars
     */
    protected function setVars(array $vars)
    {
        if (isset($vars['orientation']) && $vars['orientation'] == 'landscape') {
            $vars['orientation'] = 'L';
        } else {
            $vars['orientation'] = 'P';
        }
        $lang = isset($vars['language']) ? $vars['language'] : 'en';
        $this->setLang($lang);

        parent::setVars($vars);
    }

    /**
     * @return mixed
     */
    public function getLang()
    {
        return $this->language;
    }

    /**
     * @param mixed $language
     */
    private function setLang($language)
    {
        $this->language = $language;
    }
}