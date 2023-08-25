<?php

/**
 * Author: Newton Pasqualini Filho - 2007-05-17
 * Descripition: Default Class to work with Images
 * Email: newtonpasqualini@gmail.com
 * 
 * GPL - General Public License
 * Report BUGs to developer e-mail, thanks
 */
class PQ_Image {

    /**
     * Image Resorce
     * @var object
     */
    var $imOriginal = null;

    /**
     * Image Resorce
     * @var string
     */
    var $im = null;

    /**
     * PATH of image file
     * @var string
     */
    var $filename;

    /**
     * New PATH of image, used if you want to modify the image and save in other file
     * @var string
     */
    var $filenameDst;

    /**
     * MIME Type of image
     * @var string
     */
    var $type;

    /**
     * Original Width of image
     * @var int
     */
    var $widthOriginal;

    /**
     * Original Height of image
     * @var int
     */
    var $heightOriginal;

    /**
     * Quality of JPEG's images
     * Default: 100
     * @var int
     */
    var $quality = 100;

    /**
     * New width of image
     * @var int
     */
    var $newWidth;

    /**
     * New height of image
     * @var int
     */
    var $newHeight;

    /**
     * Preserve aspect ratio
     * Default: true
     * @var boolean
     */
    var $preserveRatio = true;

    /**
     * Internal error messages
     * @var string
     */
    var $erro;

    /**
     * Debug (true/false)
     * @var boolean
     */
    var $debug;

    /**
     * MIME Types in array
     * @var array
     */
    var $suportedTypes = array('image/jpeg', 'image/pjpeg', 'image/jpg', 'image/gif', 'image/png');

    /**
     * Construct Class
     * @param string $filename
     * @param boolean $debug
     * @return PQ_Image
     */
    function PQ_Image($filename, $debug = false) {
        $this->debug = $debug;
        $this->TestWork();
        if ($filename == "") {
            $this->erro = "Faltou o argumento \$filename";
            $this->Debug();
        }
        $this->filename = $filename;
        $this->Open();
    }

    /**
     * Open Image and check compatibility
     */
    function Open($filename = null) {
        if (!is_null($filename))
            $this->filename = $filename;
        if (file_exists($this->filename)) {
            $this->type = $this->get_mime();
            if (!in_array($this->type, $this->suportedTypes)) {
                $this->erro = "File not suported {$this->type}";
                $this->Debug();
            } else {
                list($width, $height) = getimagesize($this->filename);
                $this->widthOriginal = $width;
                $this->heightOriginal = $height;
            }
            switch ($this->type) {
                case 'image/gif':
                    $this->imOriginal = imagecreatefromgif($this->filename);
                    break;
                case 'image/png':
                    $this->imOriginal = imagecreatefrompng($this->filename);
                    break;
                case 'image/jpg':
                case 'image/jpeg':
                case 'image/pjpeg':
                    $this->imOriginal = imagecreatefromjpeg($this->filename);
                    break;
                default:
                    $this->erro = "Formato de imagem não suportado.";
                    $this->Debug();
            }
            $this->im = $this->imOriginal;
            if (function_exists('imageantialias')) {
                imageantialias($this->im, true);
            }
        } else {
            $this->erro = "Can't Open $this->filename";
            $this->Debug();
        }
    }

    /**
     * Resize Image as Class Atributes
     */
    function Resize() {
        $this->Open($this->filename);
        if (!is_numeric($this->newHeight) and ! is_numeric($this->newWidth)) {
            $this->newHeight = $this->heightOriginal;
            $this->newWidth = $this->widthOriginal;
        }
        if (!is_numeric($this->newHeight) and is_numeric($this->newWidth) and $this->preserveRatio == true) {
            $this->newHeight = ($this->newWidth / $this->widthOriginal) * $this->heightOriginal;
        } elseif (!is_numeric($this->newWidth) and is_numeric($this->newHeight) and $this->preserveRatio == true) {
            $this->newWidth = ($this->newHeight / $this->heightOriginal) * $this->widthOriginal;
        } elseif (is_numeric($this->newHeight) and is_numeric($this->newWidth) and $this->preserveRatio == true) {
            $newHeight = ($this->newWidth / $this->widthOriginal) * $this->heightOriginal;
            $newWidth = ($this->newHeight / $this->heightOriginal) * $this->widthOriginal;
            if ($newHeight > $this->newHeight) {
                $newHeight = $this->newHeight;
                $newWidth = ($this->newHeight / $this->heightOriginal) * $this->widthOriginal;
            }
            if ($newWidth > $this->newWidth) {
                $newWidth = $this->newWidth;
                $newHeight = ($this->newWidth / $this->widthOriginal) * $this->heightOriginal;
            }
            $this->newHeight = $newHeight;
            $this->newWidth = $newWidth;
        }
        if (($this->newHeight < $this->heightOriginal) && ($this->newWidth < $this->widthOriginal)) {
            $this->im = imagecreatetruecolor($this->newWidth, $this->newHeight);
            if (function_exists('imageantialias')) {
                imageantialias($this->im, true);
            }
            if (!imagecopyresampled($this->im, $this->imOriginal, 0, 0, 0, 0, $this->newWidth, $this->newHeight, $this->widthOriginal, $this->heightOriginal)) {
                $this->erro = "Can't Resize.";
                $this->Debug();
            }
        }
    }

    /**
     * Merge Image how start $x, start $y, end $x_end, end $y_end
     * @param int $x
     * @param int $y
     * @param int $width
     * @param int $heigth
     */
    function Crop($x, $y, $x_end, $y_end) {
        $width = $x_end - $x;
        $heigth = $y_end - $y;
        $im = imagecreatetruecolor($width, $heigth);
        if (!imagecopyresampled($im, $this->im, 0, 0, $x, $y, $width, $heigth, $width, $heigth)) {
            $this->erro = "Can't Merge.";
            $this->Debug();
        } else {
            $this->im = imagecreatetruecolor($width, $heigth);
            imagecopy($this->im, $im, 0, 0, 0, 0, $width, $heigth);
        }
        imagedestroy($im);
    }

    /**
     * Save image as is or as $filename
     * @param string $filename
     */
    function SaveAs($filename = null) {
        if (!is_null($filename))
            $this->filenameDst = $filename;
        if ($this->filenameDst == "") {
            $this->filenameDst = $this->filename;
        }
        switch ($this->type) {
            case 'image/gif':
                imagegif($this->im, $this->filenameDst);
                break;
            case 'image/png':
                imagepng($this->im, $this->filenameDst);
                break;
            case 'image/jpg':
            case 'image/jpeg':
            case 'image/pjpeg':
                imagejpeg($this->im, $this->filenameDst, $this->quality);
                break;
        }
    }

    /**
     * Show Image as worked in the Class
     */
    function ShowImage() {
        ob_clean();
        header("Content-type: $this->type");
        $im = $this->im;
        switch ($this->type) {
            case 'image/gif':
                imagegif($im);
                break;
            case 'image/png':
                imagepng($im);
                break;
            case 'image/jpg':
            case 'image/jpeg':
            case 'image/pjpeg':
                imagejpeg($im, null, $this->quality);
                break;
        }
        ob_flush();
        $this->Destroy();
    }

    /**
     * Apply Zoom on image as percentage
     * @param float $percentage
     */
    function Zoom($percentage) {
        if ($percentage < 1) {
            $this->erro = "The Zoom must be at last 0 (ZERO).";
            $this->Debug();
        } else {
            $preserveRatio = $this->preserveRatio;
            $this->preserveRatio = true;
            if (is_numeric($this->newHeight) and is_numeric($this->newWidth)) {
                $this->newHeight = ($percentage / 100) * $this->newHeight;
                $this->newWidth = ($percentage / 100) * $this->newWidth;
            } else {
                $this->newHeight = ($percentage / 100) * $this->heightOriginal;
                $this->newWidth = ($percentage / 100) * $this->widthOriginal;
            }
            $this->Resize();
            $this->preserveRatio = $preserveRatio;
        }
    }

    /**
     * Rotate the image to $angle argument
     * @param int $angle
     */
    function Rotate($angle) {
        $this->im = imagerotate($this->im, $angle, 0);
    }

    /**
     * Destroy images on Class
     */
    function Destroy() {
        @imagedestroy($this->im);
        @imagedestroy($this->imOriginal);
    }

    /**
     * Show errors message
     */
    function Debug() {
        if ($this->debug == true) {
            die("PQ_Image Class ERROR: " . $this->erro);
        }
    }

    /**
     * Test the working
     */
    function TestWork() {
        $functions = array(
            'getimagesize',
            'imagecreatetruecolor',
            'imagejpeg',
            'imagecreatefromjpeg',
            'imagegif',
            'imagecreatefromgif',
            'imagepng',
            'imagecreatefrompng',
            'imagerotate',
            'imagecopy',
            'imagecopyresampled',
            'imagedestroy'
        );
        foreach ($functions as $function) {
            if (!function_exists($function)) {
                $this->erro .= "\"$function()\" not found and is required.<br />\n";
            }
        }
        if ($this->erro != "") {
            $this->Debug();
        }
    }

    function get_mime($filename = null) {
        if (is_null($filename)) {
            $filename = $this->filename;
        }
        if (function_exists('mime_content_type')) {
            return mime_content_type($filename);
        } else {
            $ext = end(explode(".", $filename));
            switch (strtolower($ext)) {
                case "js": return "application/javascript";
                case "json": return "application/json";
                case "jpg": case "jpeg": case "jpe": return "image/jpg";
                case "png": case "gif": return "image/" . strtolower($ext);
                case "css": return "text/css";
                case "xml": return "application/xml";
                case "html": case "htm": case "php": return "text/html";
                default: return trim($ext);
            }
        }
    }

}

/*
  Using
  <?
  $filename = 'picture.jpg';
  $image = new PQ_Image($Diretorio . $filename, true);
  $image->preserveRatio = true;
  $image->newWidth = 300;
  $image->newHeight = 300;
  $image->Resize();
  $image->SaveAs();
  $image->ShowImage();
  $image->Destroy();
  ?>
 */
?>