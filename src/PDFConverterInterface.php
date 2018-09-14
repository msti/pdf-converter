<?php

namespace msti\PDFConverter;


interface PDFConverterInterface
{

    /**
     * Use this method to generate the PDF with the library of your choice
     *
     * @param string $contents
     * @param array $vars
     * @return string
     */
    public function generate(string $contents, array $vars);

}