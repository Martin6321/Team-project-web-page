<?php
	$loggedOut_nav = array (
					array(
						stranka => 'index.php',
						nazov => $loc['nav']['domov'][$lang]
					),
					array(
						stranka => 'application.php',
						nazov => $loc['nav']['aplikacia'][$lang]
					),
					array(
						stranka => 'service.php',
						nazov => $loc['nav']['sluzba'][$lang]
					),
					array(
						stranka => 'actualities.php',
						nazov => $loc['nav']['aktuality'][$lang]
					),
					array(
						stranka => 'techReport.php',
						nazov => $loc['nav']['techSprava'][$lang]
					),
					array(
						stranka => 'contact.php',
						nazov => $loc['nav']['kontakt'][$lang]
					),
					array(
						stranka => 'login.php',
						nazov => $loc['nav']['prihlasenie'][$lang]
					)
				);
				
	$loggedIn_nav = array (
					array(
						stranka => 'index.php',
						nazov => $loc['nav']['domov'][$lang]
					),
					array(
						stranka => 'application.php',
						nazov => $loc['nav']['aplikacia'][$lang]
					),
					array(
						stranka => 'service.php',
						nazov => $loc['nav']['sluzba'][$lang]
					),
					array(
						stranka => 'actualities.php',
						nazov => $loc['nav']['aktuality'][$lang]
					),
					array(
						stranka => 'techReport.php',
						nazov => $loc['nav']['techSprava'][$lang]
					),
					array(
						stranka => 'contact.php',
						nazov => $loc['nav']['kontakt'][$lang]
					),
					array(
						stranka => array(
										array(
											stranka => 'addActuality.php',
											nazov => $loc['nav']['novaAkt'][$lang]
										),
										array(
											stranka => 'statistics.php',
											nazov => $loc['nav']['statistiky'][$lang]
										)
									),
						nazov => $loc['nav']['admin'][$lang]
					),
					array(
						stranka => 'logout.php',
						nazov => $loc['nav']['odhlasenie'][$lang]
					)
				);
	
	if (!$loggedIn) {
		$i = 0;
		$itemCnt = count($loggedOut_nav);
		foreach($loggedOut_nav as $item) {
			if(++$i === $itemCnt) {
				echo '<li><a href="'.$item[stranka].'"><i class="fa fa-sign-out"></i>&nbsp;&nbsp;'.$item[nazov].'</a></li>';
			} else {
				echo '<li><a href="'.$item[stranka].'">'.$item[nazov].'</a></li>';
			}
		}
	} else {
		$i = 0;
		$itemCnt = count($loggedIn_nav);
		for ($i=0; $i<$itemCnt; $i++) {
			if($i === $itemCnt-1) {
				echo '<li><a href="'.$loggedIn_nav[$i][stranka].'"><i class="fa fa-sign-in"></i>&nbsp;&nbsp;'.$loggedIn_nav[$i][nazov].'</a></li>';
			} else if ($i === $itemCnt-2) {
				echo '<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">'.$loggedIn_nav[$i][nazov].'<b class="caret"></b></a>
							<ul class="dropdown-menu">';
							for ($j=0; $j<count($loggedIn_nav[$i][stranka]); $j++) {
								echo '<li>
										<a href="'.$loggedIn_nav[$i][stranka][$j][stranka].'">'.$loggedIn_nav[$i][stranka][$j][nazov].'</a>
									</li>';
							}
				echo '</ul>
					</li>';
			} else {
				echo '<li><a href="'.$loggedIn_nav[$i][stranka].'">'.$loggedIn_nav[$i][nazov].'</a></li>';
			}
		}
	}
?>