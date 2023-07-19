<?php

namespace Onetoweb\GlsFreight;

use Onetoweb\GlsFreight\Message\LabelResponse;
use Picqer\Barcode\{BarcodeGenerator, BarcodeGeneratorHTML};
use Twig\Loader\FilesystemLoader;
use Twig\{Environment, TwigFunction};
use Dompdf\{Dompdf, Options};

/**
 * Label Writer.
 */
class LabelWriter
{
    /**
     * SVG base 64 image tag
     */
    const SVG_IMG = '<img src="data:image/svg+xml;base64, %s" width="%d" height="%d" />';
    
    /**
     * @var LabelResponse
     */
    private $labelResponse;
    
    /**
     * @var Environment
     */
    private $twig;
    
    /**
     * @param LabelResponse $label
     */
    public function __construct(LabelResponse $labelResponse)
    {
        $this->labelResponse = $labelResponse;
        $this->setupTwig();
    }
    
    /**
     * @param string $barcode = null
     * @param string $type = BarcodeGenerator::TYPE_CODE_128_C
     * @param int $widthFactor = 3
     * @param int $height = 90
     * 
     * @return string
     */
    public static function generateBarcode(string $barcode = null, string $type = BarcodeGenerator::TYPE_CODE_128_C, int $widthFactor = 3, int $height = 90): string
    {
        if ($barcode) {
            return (new BarcodeGeneratorHTML())->getBarcode($barcode, $type, $widthFactor, $height);
        }
        
        return '';
    }
    
    /**
     * @param int $width = 100
     * @param int $height = 50
     * 
     * @return string
     */
    public function glsLogo(int $width = 100, int $height = 50): string
    {
        $filePath = __DIR__.'/../assets/img/gls_logo.svg';
        
        return sprintf(self::SVG_IMG, base64_encode(file_get_contents($filePath)), $width, $height);
    }
    
    /**
     * @return void
     */
    private function setupTwig(): void
    {
        // setup filesystem loader
        $loader = new FilesystemLoader([__DIR__.'/../templates', __DIR__.'/../assets']);
        
        // get twig environment
        $this->twig = new Environment($loader, [
            'strict_variables' => true
        ]);
        
        // add twig functions
        $this->twig->addFunction(new TwigFunction('generate_barcode', [$this, 'generateBarcode']));
        $this->twig->addFunction(new TwigFunction('gls_logo', [$this, 'glsLogo']));
    }
    
    /**
     * @return string
     */
    public function getHtml(): string
    {
        // generate html
        return $this->twig->render('label.html.twig', [
            'label' => $this->labelResponse
        ]);
    }
    
    /**
     * @return Dompdf
     */
    public function getDomPdf(): Dompdf
    {
        // build DomPdf options
        $options = (new Options())
            ->setIsRemoteEnabled(false)
            ->setFontDir(__DIR__ . '/../assets/fonts')
            ->setFontCache(__DIR__ . '/../var/cache')
            ->setDefaultFont('Swiss721CondensedBT')
        ;
        
        // create DomPdf
        $dompdf = new Dompdf($options);
        
        // render pdf
        $dompdf->loadHtml($this->getHtml());
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        
        return $dompdf;
    }
    
    /**
     * @return void
     */
    public function outputPdf(): void
    {
        header('Content-Type: application/pdf');
        
        echo $this->getDomPdf()->output();
        
        flush();
    }
    
    /**
     * @param string $filename
     * 
     * @return bool
     */
    public function savePdf(string $filename): bool
    {
        return (file_put_contents($filename, $this->getDomPdf()->output()) !== false);
    }
    
    /**
     * @return string
     */
    public function getBase64(): string
    {
        return base64_encode($this->getDomPdf()->output());
    }
}