<?php

namespace msti\PDFConverter;

use Dompdf\Dompdf;

class PDFConverterDomPdf extends PDFConverterAbstract
{

    private $compress;

    /**
     * @param string $contents
     * @param array $vars
     * @return string
     */
    public function generate(string $contents, array $vars = [])
    {

        // Sets the internal variables to the $vars array
        $this->setVars($vars);

        // Get the configurations
        $orientation = $this->getPaperOrientation();
        $size = $this->getPaperSize();
        $filename = $this->getPath() . '/' . $this->getFileName();

        // instantiate and use the dompdf class
        $dompdf = new Dompdf();
        $dompdf->loadHtml($contents);
        $dompdf->setPaper($size, $orientation);

        // Render the HTML as PDF
        $dompdf->render();

        $fileContent = $dompdf->output(['compress' => $this->getCompress()]);
        file_put_contents($filename, $fileContent);

        return $filename;
    }

    /**
     * @inheritdoc
     */
    protected function setVars(array $vars)
    {
        $compress = isset($vars['compress']) ? $vars['compress'] : 1;
        $this->setCompress($compress);
        parent::setVars($vars);
    }

    /**
     * @param mixed $compress
     */
    private function setCompress($compress)
    {
        $this->compress = $compress;
    }

    /**
     * @return mixed
     */
    public function getCompress()
    {
        return $this->compress;
    }

}