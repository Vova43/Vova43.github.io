<?php
class CaptchaGenerator {
	private $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZабвгдеёжзийклмнопрстуфхцчшщъыьэюяАБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯ';
	private $characterEncoding = 'UTF-8';
	private $code = '';
	private $lengthCode = 6;
    private $fontSize = 0;
	private $font = '/mipgost.ttf';
    private $imageFileName = '';
	private $image = null;
	private $addNoise = false;
	private $noiseLevel = 10;

    public function __construct($lengthCode = 6, $fontSize = 10, $addNoise = false, $noiseLevel = 10) {
        $this->lengthCode = $lengthCode;
		$this->fontSize = $fontSize;
		$this->addNoise = $addNoise;
		$this->noiseLevel= $noiseLevel;
		$this->font = __DIR__ . '/GOST_A.TTF';
		//header('Content-Type: text/html; charset=utf-8');
    }

    private function generateRandomCode($length) {
		//$code = '';
        //for ($i = 0; $i < $length; $i++) {
        //    $code .= $this->characters[rand(0, strlen($this->characters) - 1)];
        //}
		$code = '';
		$charactersLength = mb_strlen($this->characters, $this->characterEncoding) - 1;
    
		for ($i = 0; $i < $length; $i++) {
			$randomIndex = rand(0, $charactersLength);
			$code .= mb_substr($this->characters, $randomIndex, 1, $this->characterEncoding);
		}
        return $code;
    }

    public function generateImage() {
		$this->code = $this->generateRandomCode($this->lengthCode);
		//$this->code = '123укеqwerty'
		
		$textBoundingBox = imagettfbbox($this->fontSize, 0, $this->font, $this->code);
		$imageWidth = abs($textBoundingBox[4] - $textBoundingBox[0]) + 2;

        $this->image = imagecreatetruecolor($imageWidth, ($this->fontSize+2));
		imagesavealpha($this->image, true);
        $bgColor = imagecolorallocatealpha($this->image, 0, 0, 0, 127);
        $textColor = imagecolorallocate($this->image, 0, 0, 0);
        imagefill($this->image, 0, 0, $bgColor);
		imagettftext($this->image, $this->fontSize, 0, 0, $this->fontSize, $textColor, $this->font, $this->code);

		if ($this->addNoise){
			$this->addNoise($this->image, $this->noiseLevel);
		}

        $this->imageFileName = 'captcha.png';
        imagepng($this->image, $this->imageFileName);

        return $this->imageFileName;
    }

    public function getCaptchaCode() {
        return $this->code;
    }
	
	public function getCaptchaImage() {
        return $this->image;
    }
	
	public function destroyCaptchaImage() {
        imagedestroy($image);
    }
	
    public function getImageFileName() {
        return $this->imageFileName;
    }
	
	public function addNoise(&$image, $noiseLevel = 50) {
		$imageWidth = imagesx($image);
		$imageHeight = imagesy($image);

		// Добавляем случайные точки
		for ($i = 0; $i < $noiseLevel; $i++) {
			$x = mt_rand(0, $imageWidth - 1);
			$y = mt_rand(0, $imageHeight - 1);
			$noiseColor = imagecolorallocate($image, mt_rand(0, 255), mt_rand(0, 255), mt_rand(0, 255));
			imagesetpixel($image, $x, $y, $noiseColor);
		}

		// Добавляем случайные линии
		for ($i = 0; $i < $noiseLevel / 2; $i++) {
			$x1 = mt_rand(0, $imageWidth - 1);
			$y1 = mt_rand(0, $imageHeight - 1);
			$x2 = mt_rand(0, $imageWidth - 1);
			$y2 = mt_rand(0, $imageHeight - 1);
			$noiseColor = imagecolorallocate($image, mt_rand(0, 255), mt_rand(0, 255), mt_rand(0, 255));
			imageline($image, $x1, $y1, $x2, $y2, $noiseColor);
		}
	}
}