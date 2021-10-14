<?php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use League\Csv\Reader;
use Symfony\Component\HttpFoundation\Request;
use Dompdf\Dompdf;
//use Tcpdf\TCPDF;
use Fpdf\Fpdf;
use Mpdf\Mpdf;

use Qipsius\TCPDFBundle\Controller\TCPDFController;
use Symfony\Component\DependencyInjection\ContainerInterface as Container;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Shared\Html;
use App\Repository\CourrierRepository;
//require 'vendor/autoload.php';

//use PhpOffice\PhpWord\PhpWord;
//use PhpOffice\PhpWord\IOFactory;
//require_once 'dompdf/autoload.inc.php';
//use jonasarts\Bundle\TCPDFBundle\TCPDF\TCPDF;
class PubliPostageController extends AbstractController
{
 // protected TCPDFController $tcpdf;

    /**
     * @Route("/api/publipostage", name="publipostage",methods={"POSt"})
     */
public function index(Request $req,CourrierRepository $courrier,Container $container): Response
{
  $pdf = new Fpdf();
  //$pdf = $this->get("white_october.tcpdf")->create('vertical', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
 
  
  $langue = $req->request->get("langue");
  $this->doothat($req);
//$this->doothat2($req);
//echo "papa";
return $this->render('toto/index.html.twig', [
    'controller_name' => 'TotoController',
]);
    }
    public  function doothat(Request $req){
      $rowNo = 1;
     // echo 'hi';
       $titre = $req->request->get("titre");
       $objet = $req->request->get("objet");
       $entet = $req->request->get("entet");
       $pied = $req->request->get("pied");
       $logo = $req->request->get("logo");
       //get posiotion of variable
       $positionnom = $req->request->get("positionnom");
       $positionprenom = $req->request->get("positionprenom");
       $positionage = $req->request->get("positionage");
       $positionadress = $req->request->get("positionadress");
       $positionnumber = $req->request->get("positionnumber");
       $positiongestion = $req->request->get("positiongestion");
       $positionnumerodossier = $req->request->get("positionnumerodossier");
       $positionemail = $req->request->get("positionemail");

      //$logo = base64_decode($logo);
       $content = $req->request->get("content");
       $content2 = strip_tags($content);
       $content1 = htmlspecialchars($content,ENT_HTML5);
       $content3 = html_entity_decode($content,ENT_HTML5);
       $content4 = html_entity_decode($content,ENT_HTML401 ,'UTF-8');
       $filecsv = $req->request->get("nomfilecsv");
       $csv_file_name =  $filecsv;
       //echo $csv_file_name;
      // $prenonm="anouar";
      // $content = str_replace('prenom',  $prenonm, $content);
       $content="
       <!DOCTYPE html>
<html>
<style>

</style>
<head>
  <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
  <meta name=Generator content='Microsoft Word 15 (filtered)'>
</div> 
<div align='center'>".$entet."
</div> 
  </head>
            <body>
                 <div  align='right' >
                    <img src=".$logo." width='100' height='60'  >
                   
                </p>
            <div>
               
                <br>
                <p  align='right' >
                <strong> [#Nom#]  </strong> <br>
                <strong> [#Prenom#]  </strong><br>
                <strong> [#Adress#]  </strong><br>
               </p>
                <strong></strong>
                <p>
                 <strong> rabat  le : [#Date#] 
                </p>
                <p>
                    <strong></strong>
                </p>
            ".$content."</body>
            <br><br><br><br><br><br><br><br><br>
            <footer style='background-color: #FFF;
            bottom: 0px;
            width: 400px;
            position: absolute; bottom: 0;'
            text-align: center;>
    <div>
    ".$pied."
    </div>
<footer>
            ";
           // $mpdf = new Mpdf(['mode' => 'utf-8', 'format' => [200, 300]]);
            //$mpdf->AddPage("P");
            //$mpdf->autoScriptToLang = true;
            //$mpdf->autoLangToFont = true;
            //$mpdf->WriteHTML($content,\Mpdf\HTMLParserMode::HTML_BODY);
            //$mpdf->Output("../public/myPDlklk.pdf","F");
        /***** END CONFIG */
        // Initialize CSV reader
        $reader = Reader::createFromPath($csv_file_name);
        //echo $reader;
        $i = 0;
        $k = 0;
        $contacts = [];
        $var=[];
        foreach ($reader as $index => $column) {
            if ($i === 0) {
              $size=sizeof($column);          
           foreach( $column as  $c){
           echo $c;
           if ($c==="Nom" && $positionnom==100){
             echo'nom okk';
            $positionnom=$k;
           }
           if ($c==="Prenom" &&  $positionprenom==100){
            $positionprenom=$k;
           }
           if ($c==="Age" && $positionage==100){
            $positionage=$k;
           }
           if ($c==="Adresse" && $positionadress==100){
            $positionadress=$k;
           }
           if ($c==="Email" && $positionemail==100){
            $positionemail=$k;
           }
           if ($c==="Number" && $positionnumber==100){
            $positionnumber=$k;
            echo " NUmber oki".$positionnumber;
           }
           if ($c=="NumGest" && $positiongestion==100){
            $positiongestion=$k;
           }

           $k++;
           }
                $i++;
                continue;
            }

            $dompdf = new Dompdf();
            if($positionnom!=100){$firstname = $column[$positionnom];}
            else{$firstname=""; }
            if($positionprenom!=100){$lastname = $column[$positionprenom]; }
            else $lastname="";
            if($positionage!=100){$age = $column[$positionage];}
            else $age="";
            if($positiongestion!=100){$gestion = $column[$positiongestion];}
            else $gestion="";
            if($positionnumerodossier!=100){ $numerodossier = $column[$positionnumerodossier];}
            else $numerodossier="";
            if($positionadress!=100){$adress = $column[$positionadress]; }
            else $adress="";
            if($positionnumber!=100){$number = $column[$positionnumber]; }
            else $number="";
            if($positionemail!=100){$email = $column[$positionemail]; }
            else $email="";
                    /*   $lastname = $column[1];
                        $firstname = $column[0];
                          $age = $column[2];
                        $adress = $column[3];
                        $email = $column[4];
                        $number = $column[5];*/
            $additional = '';
          //  echo  $lastname;
            /*$html = $this->renderView('toto/courrier.html', [
                'title' => "Welcome to our PDF Test".$i,
                'nom' => $lastname ,
                'prenom' =>  $firstname,
                'age' => $age,
                'number' => $number,
                'adress' => $adress,
                'email' =>  $email,
                'date' =>date('d F Y'),
                'titre' => $titre,
                'objet' =>$objet,
                'content'  => $content,
                'content1' => $content1,
                'content2' => $content2,
                'content3' => $content3,
                'content4' => $content4,
                'pied'  => $pied,
                'entet' => $entet,
                'logo'  => $logo,
            ]);*/
            $date =date('d F Y');
            $content = str_replace('[#Prenom#]',   $firstname, $content);
            $content = str_replace('[#Nom#]',   $lastname, $content);
            $content = str_replace('[#Email#]',   $email, $content);
            $content = str_replace('[#Date#]',   $date, $content);
            $content = str_replace('[#Adress#]',   $adress, $content);
            $content = str_replace('[#Number#]',   $number, $content);
            $mpdf = new Mpdf(['mode' => 'utf-8', 'format' => [200, 300]]);
            $mpdf->AddPage("P");
            $mpdf->autoScriptToLang = true;
            $mpdf->autoLangToFont = true;
            $mpdf->WriteHTML($content,\Mpdf\HTMLParserMode::HTML_BODY);
            $mpdf->Output("../public/courriersPDF/".$number."__". $i.".pdf","F");
            //$html = mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8');
            //$html=mb_convert_encoding($html, 'UTF-8',
            //mb_detect_encoding($html, 'UTF-8, ISO-8859-1', true));
            //  $dompdf->
           /* $dompdf->loadHtml($content,"UTF-8");
            // $dompdf->load_html($chain, 'UTF-8');
            //$dompdf->set_paper('a4', 'portrait'); // change these if you need to
            $dompdf->render();
            // $dompdf->render();
            $output = $dompdf->output();
            $publicDirectory = '../public';
            $pdfFilepath =  $publicDirectory . '/mypdf'.$i.'.pdf';
            file_put_contents($pdfFilepath, $output);*/
        $i++;
       }
        return new Response("The PDF file has been succesfully generated !");
        //$str_contacts = implode("", $contacts);

       // file_put_contents($vcf_file_name, $str_contacts);

    }
    
    public  function doothat2(Request $req){
      $titre = $req->request->get("titre");
      $objet = $req->request->get("objet");
      $entet = $req->request->get("entet");
      $pied = $req->request->get("pied");
      $logo = $req->request->get("logo");
      $date =date('d F Y');
      $find = strpos($logo, ';base64,');
      if ($find !== false) { $logo= substr($logo, $find + 8); } 
      $content = $req->request->get("content");
      $content2 = strip_tags($content);
      $filecsv = $req->request->get("nomfilecsv");
      $csv_file_name =  $filecsv;
      $reader = Reader::createFromPath($csv_file_name);
      echo $reader;
      $i = 0;
      $contacts = [];
      foreach ($reader as $index => $column) {
        if ($i === 0) {
            $i++;
            continue;
        }
        $lastname = $column[1];
        $firstname = $column[0];
        $age = $column[2];
        $adress = $column[3];
        $email = $column[4];
        $number = $column[5];
        $additional = '';
  $phpWord = new PhpWord();
  $section = $phpWord->addSection();
 // $logo = $req->request->get("logo");
  //console.log( $logo );
 
   //$section->addImage(base64_decode($file_contents));

  $section->addImage(
    base64_decode($logo),
    array(
        'width'         => 100,
        'height'        =>70,
        'marginTop'     => -1,
        'marginLeft'    => -1,
        'align'=>'right',

        'wrappingStyle' => 'behind'
    )
);
  $html = '<p align="center">'.$entet.'</p>';
$html .= '<h2 style="align: center">centered title</h2>';
$html .= '<p>           
<strong>Nom_Client:'. $lastname .'</strong>
<strong> </strong>
</p>';
$html .='<p> 
<strong>Prenom_Client:'.$firstname.'</strong></p> 
<strong></strong><p> 
<strong>Email: '.$email.'</strong></p> 
';
$html .= '<p>
<strong> rabat  le : '.$date.'
</p>';
$html .= '<p align="right">
<strong>{{nom}}</strong>
<strong>:</strong>
<strong><u>مرجعــــــــــي</u></strong>
<strong><u></u></strong>
</p> ';
$html .= '<p style="margin-top: 40pt;" align="center">araabb</p>';
$html .= ' <p align="right" >رسالــة إنــــذار</p>  ';
$html .= ' <p align="right" >سيــــــــدي (تي)، </p>  ';
$html .= ' <p align="right" > '.$content2.' </p>  ';
$html .= '<p style="margin-top: 240pt;" align="center">pied de page</p>';
$html .= '<p style="display: none">This is hidden text</p>';
  // Adding Text element to the Section having font styled by default...
  Html::addHtml($section, $html, false, false);
  //$objWriter = IOFactory::createWriter($phpWord, 'Word2007');
  // Create a temporal file in the system
  $fileName = 'koko'.$i.'.docx';
  $temp_file = tempnam("../public/courriers", $fileName);
  // Write in the temporal filepath
  $phpWord->save($temp_file);
        }
      return new Response("The PDF file has been succesfully generated !");
      //$str_contacts = implode("", $contacts);

     // file_put_contents($vcf_file_name, $str_contacts);

  }


}


