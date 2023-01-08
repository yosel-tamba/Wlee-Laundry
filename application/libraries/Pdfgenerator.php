<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once 'dompdf-master/autoload.inc.php';

use Dompdf\Dompdf;
use Dompdf\Options;

class Pdfgenerator
{
    public function generate($html, $filename = '', $paper = '', $orientation = '', $stream = TRUE)
    {
        $options = new Options();
        $options->set('isRemoteEnable', TRUE);
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper($paper, $orientation);
        $dompdf->render();
        if ($stream) {
            $dompdf->stream($filename, array("Attachment" => 0));
        } else {
            return $dompdf->output();
        }
    }
}
