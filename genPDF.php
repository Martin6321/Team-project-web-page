<?php
	$urlDemo = false;
	if(isset($_POST['submit'])){
		require 'fpdf/fpdf.php';
	
		$DOM = new DOMDocument;
		$DOM->loadHTMLFile("service.php");
		
		$text = $DOM->getElementById('text')->nodeValue;
		//$text = $element->item($i)->nodeValue;
		$text = mb_convert_encoding($text, "windows-1252", "auto");
		
		$pdf = new FPDF();
		$pdf->AddPage();
		$pdf->SetFont('Arial','',12);
		$pdf->SetMargins(10.0,10.0, 10.0);
		
		$date = date(DATE_RFC2822);
		$text = "$date"."\n\n"."$text";
		//$text = iconv('UTF-8', 'windows-1252', $text);
		$pdf->Write(5, "$text");
		$pdf->Output('I',"navod.pdf", true);
	}
	else if(isset($_POST['submit2'])){
			//Only need to include the MOBI file, all other files are included automatically
			require("mobi_lib/MOBIClass/MOBI.php");
		
			if($urlDemo){
			//Set the url (note that this file isn't created for eBook viewing, it's just
			//to demonstrate that you can give (almost) any news article and get it working on
			//your eBook reader)
			$url = "http://147.175.98.216/projekt/index.php";
			$recognize = false;
		
			//Create the mobi object
			$mobi = new MOBI();
		
			//Find and set the content handler
			$content = null;
		
			if($recognize){				//Pass through to right handler
				$content = RecognizeURL::GetContentHandler($url);
			}
		
			if($content == null){		//If handler not found or if the recognition was turned off
				$content = new OnlineArticle($url);
			}
		
			$mobi->setContentProvider($content);
		
			//Get title and make it a 12 character long filename
			$title = $mobi->getTitle();
			if($title === false) $title = "file";
			$title = urlencode(str_replace(" ", "_", strtolower(substr($title, 0, 14))));
		
			//Send the mobi file as download
			$mobi->download($title.".mobi");
			die;
		}else{
			$DOM = new DOMDocument;
			$DOM->loadHTMLFile("service.php");
			
			$text = $DOM->getElementById('text')->nodeValue;
			//$text = iconv('UTF-8', 'windows-1252', $text);
			
			//Create the mobi object
			$mobi = new MOBI();
			
			$content = new MOBIFile();
			
			$content->set("title", "Návod služby");
			$content->set("author", "Tím13");
			
			$content->appendParagraph("");
			$content->appendChapterTitle("Návod");
			
			$content->appendParagraph("$text");
		
			$mobi->setContentProvider($content);
		
			//Get title and make it a 12 character long filename
			$title = $mobi->getTitle();
			if($title === false) $title = "file";
			$title = urlencode(str_replace(" ", "_", strtolower(substr($title, 0, 14))));
		
			//Send the mobi file as download
			$mobi->download($title.".mobi");
			die;
			}
		}
?>