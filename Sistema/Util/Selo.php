<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 27/11/17
 * Time: 16:22
 */

namespace Sistema\Util;

class Selo
{
    protected $img;
    protected $font;
    protected $result;

    public function __construct($img = 'selo.png', $font = 'MyriadPro-Regular.otf')
    {
        $this->img = __DIR__ . '/../views/img/' . $img;
        $this->font = __DIR__ . '/../views/font/' . $font;
    }

    public function processar($oid, $data = 'now')
    {
        $result = imagecreatefrompng($this->img);

        $branco = imagecolorallocate( $result, 255, 255, 255 );

        imagerectangle( $result, 208, 0, 208, 75, $branco );
        imagerectangle( $result, 199, 0, 208, 0, $branco );
        imagerectangle( $result, 0, 0, 8, 0, $branco );

        $data_hora = new \DateTime($data);
        $data_hora = $data_hora->format('d/m/Y H:i:s');

        $rect = imagettfbbox(14,0,$this->font,$oid);
        $length= $rect[2];
        $image_left_x = ((209-$length) /2 );
        $blue = imagecolorallocate($result, 11, 43, 89);
        $black = imagecolorallocate($result, 0, 0, 0);
        imagettftext($result, 14, 0, $image_left_x, 102, $blue, $this->font, $oid);

        imagettftext($result, 10, 0, 10, 125, $black, $this->font, $data_hora);

        $this->result = $result;
    }

    public function salvar($nome_arquivo)
    {
        imagepng($this->result, $nome_arquivo);
    }

    public function obterResultado()
    {
        ob_start();
        imagepng($this->result);

        return ob_get_clean();
    }
}