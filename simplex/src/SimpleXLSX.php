<?php

namespace Shuchkin;

use SimpleXMLElement;

/**
 * SimpleXLSX php class
 * MS Excel 2007+ workbooks reader
 *
 * @category   SimpleXLSX
 * @package    SimpleXLSX
 * @copyright  Copyright (c) 2012 - 2022 SimpleXLSX (https://github.com/shuchkin/simplexlsx/)
 * @license    MIT
 */
class SimpleXLSX
{
    // Don't remove this string! Created by Sergey Shuchkin sergey.shuchkin@gmail.com
    public const CF = [ // Cell formats
        0 => 'General',
        1 => '0',
        2 => '0.00',
        3 => '#,##0',
        4 => '#,##0.00',
        9 => '0%',
        10 => '0.00%',
        11 => '0.00E+00',
        12 => '# ?/?',
        13 => '# ??/??',
        14 => 'mm-dd-yy',
        15 => 'd-mmm-yy',
        16 => 'd-mmm',
        17 => 'mmm-yy',
        18 => 'h:mm AM/PM',
        19 => 'h:mm:ss AM/PM',
        20 => 'h:mm',
        21 => 'h:mm:ss',
        22 => 'm/d/yy h:mm',

        37 => '#,##0 ;(#,##0)',
        38 => '#,##0 ;[Red](#,##0)',
        39 => '#,##0.00;(#,##0.00)',
        40 => '#,##0.00;[Red](#,##0.00)',

        44 => '_("$"* #,##0.00_);_("$"* \(#,##0.00\);_("$"* "-"??_);_(@_)',
        45 => 'mm:ss',
        46 => '[h]:mm:ss',
        47 => 'mmss.0',
        48 => '##0.0E+0',
        49 => '@',

        27 => '[$-404]e/m/d',
        30 => 'm/d/yy',
        36 => '[$-404]e/m/d',
        50 => '[$-404]e/m/d',
        57 => '[$-404]e/m/d',

        59 => 't0',
        60 => 't0.00',
        61 => 't#,##0',
        62 => 't#,##0.00',
        67 => 't0%',
        68 => 't0.00%',
        69 => 't# ?/?',
        70 => 't# ??/??',
    ];

    private $nf = []; // number formats
    private $cellFormats = []; // cellXfs
    private $datetimeFormat = 'Y-m-d H:i:s';
    private $debug;
    private $activeSheet = 0;
    private $rowsExReader;

    /* @var SimpleXMLElement[] $sheets */
    private $sheets;
    private $sheetFiles = [];
    private $sheetMetaData = [];
    private $sheetRels = [];
    // scheme
    private $styles;
    /* @var array[] $package */
    private $package;
    private $sharedstrings;
    private $date1904 = 0;

    public function __construct($filename = null, $is_data = null, $debug = null)
    {
        if ($debug !== null) {
            $this->debug = $debug;
        }
        if ($filename && $this->unzip($filename, $is_data)) {
            $this->parseEntries();
        }
    }

    // ... rest of the code ...
}
