<?php

namespace msti\PDFConverter;

class PDFConverterAbstract implements PDFConverterInterface
{

    /**
     * The path to save the file
     * @var string
     */
    private $path;

    /**
     * The name of the output file
     * @var string
     */
    private $fileName;

    /**
     * The PDF papersize
     * @var string
     */
    private $paperSize;

    /**
     * The PDF orientation
     * @var string
     */
    private $paperOrientation;

    /**
     * The default configuration array
     * @var array
     */
    protected $vars = [
        'orientation' => 'portrait',
        'papersize' => 'A4',
        'path' => '/tmp',
        'filename' => '',
    ];

    protected function setVars(array $vars)
    {

        // merge and replace default values
        $vars = array_merge($this->vars, $vars);

        $this->setPaperOrientation($vars['orientation']);
        $this->setPaperSize($vars['papersize']);
        $this->setFileName($vars['filename']);
        $this->setPath($vars['path']);
    }

    /**
     * @inheritDoc
     */
    public function generate(string $contents, array $vars = [])
    {
    }

    /**
     * Used for Unit Testing
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param string $path
     */
    private function setPath(string $path)
    {
        $this->path = $path;
    }

    /**
     * @return string
     */
    public function getFileName()
    {
        return $this->fileName;
    }

    /**
     * /**
     * @param string $fileName
     */
    private function setFileName(string $fileName)
    {
        $this->fileName = $fileName ?: uniqid() . '.pdf';
    }

    /**
     * @return string
     */
    public function getPaperSize()
    {
        return $this->paperSize;
    }

    /**
     * @param $paperSize
     */
    private function setPaperSize($paperSize)
    {
        $this->paperSize = $paperSize;
    }

    /**
     * @return string
     */
    public function getPaperOrientation()
    {
        return $this->paperOrientation;
    }

    /**
     * @param string $paperOrientation
     */
    private function setPaperOrientation(string $paperOrientation)
    {
        $this->paperOrientation = $paperOrientation;
    }

}