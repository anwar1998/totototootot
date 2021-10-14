<?php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
//use Symfony\Bundle\FrameworkBundle\Controller\;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
//use JeroenDesloovere\VCard\VCard;
use League\Csv\Reader;
use Symfony\Component\HttpFoundation\Request;
//require 'vendor/autoload.php';
//use PhpOffice\PhpWord\PhpWord;
//use PhpOffice\PhpWord\IOFactory;
//require_once 'dompdf/autoload.inc.php';
//use jonasarts\Bundle\TCPDFBundle\TCPDF\TCPDF;
class CompagneController extends AbstractController
{
 // protected TCPDFController $tcpdf;

    /**
     * @Route("/api/compCont", name="compCont",methods={"POSt"})
     */
public function index(Request $req): Response
{

  echo 'holla';
  $csv_file_name = $req->request->get("data");
  $reader = Reader::createFromPath($csv_file_name);
  echo $reader;
  $i = 0;
  $k = 0;
  $contacts = [];
  $var=[];
  foreach ($reader as $index => $column) {
      if ($i === 0) {
        $size=sizeof($column);          
          $i++;
          continue;
      }
 }
    return $this->render('toto/index.html.twig', [
        'controller_name' => 'TotoController',
    ]);

}

}