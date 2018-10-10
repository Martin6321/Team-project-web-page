<?php
	session_start();
	
	if(isset($_GET['lang']) && ($_GET['lang'] == 'en' || $_GET['lang'] == 'sk')) {
		$_SESSION['lang'] = $_GET['lang'];
	} 
	if(!isset($_SESSION['lang'])) {
		$_SESSION['lang'] = 'sk';
	}
	
	$lang = 0;
	if ($_SESSION['lang'] == 'en') {
		$lang = 1;
	}
	
	
	$loc = array (
					'page' => array(
									'title' => array('Tím 13', 'Team 13'),
									'mobileTitle' => array('Prepnúť navigáciu', 'Toggle Navigation'),
									'footer' => array('Webové Technológie 2', 'Web Technologies 2')
								),
					'nav' => array(
									'domov' => array('Domov', 'Home'),
									'sluzba' => array('Služba', 'Service'),
									'aplikacia' => array('Aplikácia', 'Application'),
									'aktuality' => array('Aktuality', 'Actualities'),
									'techSprava' => array('Technická správa', 'Technical report'),
									'kontakt' => array('Kontakt', 'Contact'),
									'statistiky' => array('Štatistiky', 'Statistics'),
									'prihlasenie' => array('Prihlásenie', 'Login'),
									'odhlasenie' => array('Odhlásenie', 'Logout'),
									'admin' => array('Administrátor', 'Administrator'),
									'novaAkt' => array('Pridať aktualitu', 'Add actuality')
								),
					'index' => array(
									'nadpis' => array('Vitajte na webstránke tímu 13!', 'Welcome to the team 13 website!')
								),
					'login' => array(
									'prihlasenie' => array('Prihlásenie administrátora', 'Administrator login'),
									'meno' => array('Meno', 'Login'),
									'heslo' => array('Heslo', 'Password'),
									'zmazatTl' => array('Zmazať', 'Reset'),
									'prihlasitTl' => array('Prihlásiť', 'Login')
								),
					'aktual' => array(
									'newsletter' => array('Odber noviniek', 'Newsletter feed'),
									'pridany' => array('Pridané:', 'Added:'),
									'prihlasitTl' => array('Prihlásiť sa', 'Subscribe'),
									'zrusitTl' => array('Zrušiť odber', 'Cancel feed'),
									'pred' => array('Späť', 'Previous'),
									'nasl' => array('Ďalej', 'Next')
								),
					'ulohy' => array(
									'ulohy' => array('Úlohy na projekte:', 'Project tasks:'),
									'obsah' => array('Obsahová náplň webu', 'Web page content'),
									'admin' => array('Administrátorský prístup', 'Administrator access'),
									'lokalizacia' => array('Lokalizácia', 'Localization'),
									'statistiky' => array('Štatistiky návštevnosti', 'Visitor statistics'),
									'aktuality' => array('Tvorba aktualít', 'Atricle generating'),
									'sluzba' => array('SOAP služba', 'SOAP service'),
									'graf' => array('Vykreslovanie grafov', 'Graph visualisation'),
									'novinky' => array('Rozposielanie aktualít', 'Newsletter feed'),
									'generovanie' => array('Generovanie PDF / e-book', 'PDF / e-book generating'),
								),
					'novaAkt' => array(
									'sk' => array('Článok v slovenčine', 'Article in slovak'),
									'en' => array('Článok v angličtine', 'Article in english'),
									'nadpis' => array('Nadpis:', 'Heading:'),
									'text' => array('Text:', 'Text:'),
									'odoslatTl' => array('Odoslať', 'Send')
								),
					'aplikacia' => array(
									'grafFun' => array('Graf funkcie', 'Graph of function'),
									'grafDer' => array('Graf derivácie', 'Graph of derivative'),
									'funkcia' => array('Funkcia:', 'Function:'),
									'osX' => array('os X', 'X axis'),
									'osY' => array('os Y', 'Y axis'),
									'rozsahX' => array('Rozsah osi X:', 'X axis range:'),
									'rozsahY' => array('Rozsah osi Y:', 'Y axis range:'),
									'startTl' => array('Spustiť výpočet', 'Start calculation'),
									'stopTl' => array('Zastaviť výpočet', 'Stop calculation'),
									'exportTl' => array('Exportovať do .csv', 'Export to .csv')
								),
					'statis' => array(
									'grafy' => array('Grafy návštevnosti', 'Visit rate graphs'),
									'mapa' => array('Mapa návštev', 'Map of visitors'),
									'navstevy' => array('Návštevy podľa IP adresy', 'Visits by IP address'),
									'tab1' => array('Vizualizácia', 'Visualisation'),
									'tab2' => array('Dáta', 'Data'),
									'staty' => array('Návštevy podľa štátov', 'Visits by country'),
									'mesta' => array('Návštevy podľa miest', 'Visits by city'),
									'stat' => array('Štát', 'Country'),
									'mesto' => array('Mesto', 'City')
								),
					'techRep' => array(
									'autori' => array('Autori:', 'Authors:'),
									'adresa' => array('Adresa zadania:', 'Project address:'),
									'instal' => array('Dodatočná inštalácia:', 'Additional installation:'),
									'struktura' => array('Štruktúra a popis stránky:', 'Website structure:'),
									'dovodInstal' => array('Dôvod inštalácie:', 'Reason of installation:'),
									'octaveInstal' => array('Inštalácia softvéru Octave:', 'Octave software installation:')
								),
					'sluzba' => array(
									/*
									'umiestnenie' => array('Umiestnenie:', 'Location:'),
									'operacie' => array('Operácie:', 'Operations:'),
									'param' => array('Každá operácia má 4 vstupné parametre:', 'Every operation contains 4 parameters:'),
									'format' => array('Výsledok operácií je vrátený v JSON formáte:', 'The result of any operation is returned in JSON format:'),
									'priklad' => array('Príklad použitia služby v PHP:', 'Concrete example of using service in PHP:'),
									*/
									'pdfTl' => array('Genetrovať PDF', 'Generate PDF'),
									'ebookTl' => array('Generovať e-book', 'Generate e-book')
								)
				);
	
?>