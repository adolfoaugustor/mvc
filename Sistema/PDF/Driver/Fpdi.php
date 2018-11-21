<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 19/02/18
 * Time: 12:39
 */

namespace Sistema\PDF\Driver;

use setasign\Fpdi\Fpdi as FpdiCore;

class Fpdi extends FpdiCore
{
    const OUTPUT_INLINE = 'I';
    const OUTPUT_DOWNLOAD = 'D' ;
    const OUTPUT_SAVE = 'F';
    const OUTPUT_STRING = 'S';

    protected $angle = 0;

    protected function Rotate($angle, $x = -1, $y = -1)
    {
        $x = $x == -1 ? $this->x : $x;
        $y = $y == -1 ? $this->y : $y;

        $this->angle == 0 ?: $this->_out('Q');
        $this->angle = $angle;

        if ($angle != 0) {
            $angle *= M_PI/180;
            $cos = cos($angle);
            $sin = sin($angle);
            $cosX = $x * $this->k;
            $cosY = ($this->h - $y) * $this->k;

            $out = sprintf(
                'q %.5F %.5F %.5F %.5F %.2F %.2F cm 1 0 0 1 %.2F %.2F cm',
                $cos, $sin, -$sin, $cos, $cosX, $cosY, -$cosX, -$cosY
            );

            $this->_out($out);
        }
    }

    protected function _endpage()
    {
        if ($this->angle != 0) {
            $this->angle = 0;
            $this->_out('Q');
        }

        parent::_endpage();
    }

    public function RotatedText($x,$y,$txt,$angle)
    {
        // Rotação na origem
        $this->Rotate($angle,$x,$y);
        $this->Text($x,$y,$txt);
        $this->Rotate(0);
    }

    public function RotatedImage($file,$x,$y,$w,$h,$angle)
    {
        // Imagem rotacionada no canto superior esquerdo
        $this->Rotate($angle,$x,$y);
        $this->Image($file,$x,$y,$w,$h);
        $this->Rotate(0);
    }

    public function _escape($s)
    {
        $s = parent::_escape($s);
        return utf8_decode($s);
    }
}