<?php

namespace Shuchkin;

use SimpleXMLElement;

class SimpleXLSXEx
{
    public static $IC = [
        0 => '000000',
        //...
        65 => 'FFFFFF',
    ];

    public static $CH = [
        0 => 'ANSI_CHARSET',
        //...
        255 => 'OEM_CHARSET'
    ];

    /**
     * @var SimpleXMLElement
     */
    private $xlsx;

    /**
     * @var array
     */
    private $themeColors;

    /**
     * @var array
     */
    private $fonts;

    /**
     * @var array
     */
    private $fills;

    /**
     * @var array
     */
    private $borders;

    /**
     * @var array
     */
    private $cellStyles;

    /**
     * @var array
     */
    private $css;

    /**
     * @var array
     */
    private $comments;

    /**
     * @var array
     */
    private $hyperlinks;

    /**
     * @var int
     */
    private $worksheetIndex;

    /**
     * SimpleXLSXEx constructor.
     * @param SimpleXMLElement $xlsx
     */
    public function __construct(SimpleXMLElement $xlsx)
    {
        $this->xlsx = $xlsx;
        $this->readThemeColors();
        $this->readFonts();
        $this->readFills();
        $this->readBorders();
        $this->readCellStyles();
        $this->readComments();
        $this->readHyperlinks();
    }

    //... (rest of the methods)

    /**
     * @param SimpleXMLElement|null $a
     * @param string $default
     * @return string
     */
    private function getColorValue(?SimpleXMLElement $a = null, string $default = ''): string
    {
        //... (rest of the method)
    }

    /**
     * @return void
     */
    private function readHyperlinks(): void
    {
        //... (rest of the method)
    }
}
