<?php
//exit;

set_time_limit(999999999);
ini_set('max_execution_time', 30000);  //sec
	
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
header('Content-Type: text/html; charset=utf-8');
//ini_set('mbstring.internal_encoding','UTF-8');
header('Content-Type: text/html; charset=UTF-8');

mb_internal_encoding('UTF-8');
mb_http_output('UTF-8');
mb_http_input('UTF-8');
mb_regex_encoding('UTF-8');

//---------el haslejuk a bemeno parametereket eleje

if (!empty($_POST)) {
    foreach ($_POST as $post => $value) {
        $_POST[$post] = addslashes($_POST[$post]);
    }
}
if (!empty($_PUT)) {
    foreach ($_PUT as $put => $value) {
        $_PUT[$put] = addslashes($_PUT[$put]);
    }
}
if (!empty($_GET)) {
    foreach ($_GET as $get => $value) {
        $_GET[$get] = addslashes($_GET[$get]);
    }
}
if (!empty($_REQUEST)) {
    foreach ($_REQUEST as $key => $value) {
        $_REQUEST[$key] = addslashes($_REQUEST[$key]);
    }
}
//---------el haslejuk a bemeno parametereket vege

require_once(dirname(__FILE__) . '/phpmailer-6.1.1/Exception.php');
require_once(dirname(__FILE__) . '/phpmailer-6.1.1/OAuth.php');
require_once(dirname(__FILE__) . '/phpmailer-6.1.1/PHPMailer.php');
require_once(dirname(__FILE__) . '/phpmailer-6.1.1/POP3.php');
require_once(dirname(__FILE__) . '/phpmailer-6.1.1/SMTP.php');

//echo "<h1>PHPMailer levelkuldes teszt</h1>";



/*CONFIG*/
/*CONFIG*/
/*CONFIG*/
/*CONFIG*/

echo memory_get_usage() . '<br>';
//include("class.phpmailer.php");

//ini_set('memory_limit', '200M');



$host     = 'localhost';
$user     = 'root';
$pswd     = '';
$database = 'emails';


$connect = mysqli_connect($host, $user, $pswd, $database);

mysqli_query($connect, 'set names utf8');
mysqli_select_db($connect, $database);



$sleeptime = 3;  //3 a jo
$runtime   = 0;
$testcount = 100;

$testemail = 'balazs_idavidofficial@gmail.com';



function getRandElementFromArray($array){
	return $array[array_rand($array, 1)];
}

/*CONFIG*/
/*CONFIG*/
/*CONFIG*/ 
/*CONFIG*/
/*CONFIG*/



/*MONDAT VARIACIOK*/
/*MONDAT VARIACIOK*/
/*MONDAT VARIACIOK*/
/*MONDAT VARIACIOK*/
/*MONDAT VARIACIOK*/
/*MONDAT VARIACIOK*/




//echo getRandElementFromArray($mailData['sender']);



$fromemail[0][] = 'kuldo@gmail.com';


$kuldo[0][] = 'Andras Molnar'; 
$kuldo[0][] = 'Andreas M.';

$targy[0][] = 'Buy advertising space';
$targy[0][] = 'Banner interface rental';
$targy[0][] = 'Banner advertising space rental';





$mondat[0][] = 'Welcome!';
$mondat[0][] = 'Dear Operator!';
$mondat[0][] = 'Dear website owner!';

$mondat[1][] = 'test1';
$mondat[1][] = 'test2';
$mondat[1][] = 'test3';
$mondat[1][] = 'test4';

$mondat[2][] = 'test1';
$mondat[2][] = 'test2';
$mondat[2][] = 'test3';
$mondat[2][] = 'test4';


$mondat[3][] = ' www valami com';


/*MONDAT VARIACIOK*/
/*MONDAT VARIACIOK*/
/*MONDAT VARIACIOK*/
/*MONDAT VARIACIOK*/
/*MONDAT VARIACIOK*/
/*MONDAT VARIACIOK*/




do {   // ciklus inditasa ha nem javascripttel ugrasztjuk
	sleep($sleeptime);
	
	// Phpmailer objektum peldany letrehozasa
	$phpmailer = new PHPMailer\PHPMailer\PHPMailer();


 
 
    set_time_limit(9999999);
	
	$isz = file_get_contents('isz.txt');  // elozo emial idje
	echo '<br>isz: ' . $isz . '<br>'; 
    
    // lekerjuk a kuldendo adatokat
   /* */$query = "
			SELECT *
			FROM emails_test
			WHERE
			sended = '0' 
			LIMIT 1

        ";
    
    //echo $query.'<hr>';
    $sql_result = mysqli_query($connect, $query);
    
    $result = array();
    while ($row = mysqli_fetch_array($sql_result)) {
        $result[] = $row;
    }
//print_r($result);
if (empty($result)) {
	die('the end');
}
//exit;
	
	file_put_contents('isz.txt', $result[0]['id']);  // geyel nagyobb mitn amit kiirtunk
	$log = file_get_contents('log.txt');


	try
	{
		// Hibakereses
		$phpmailer->SMTPDebug = 1;
		//SMTP::DEBUG_OFF (0): Disable debugging (you can also leave this out completely, 0 is the default).
		//SMTP::DEBUG_CLIENT (1): Output messages sent by the client.
		//SMTP::DEBUG_SERVER (2): as 1, plus responses received from the server (this is the most useful setting).
		//SMTP::DEBUG_CONNECTION (3): as 2, plus more information about the initial connection - this level can help diagnose STARTTLS failures.
		//SMTP::DEBUG_LOWLEVEL (4): as 3, plus even lower-level information, very verbose, don't use for debugging SMTP, only low-level problems.

		// Karakterkodolas beallitasa
		$phpmailer->CharSet = 'UTF-8';

		// Level formatumanak beallitasa
		$phpmailer->isHTML(true);

		// Fealdo
		$phpmailer->setFrom($fromemail[0][rand(0, count($fromemail[0]) - 1)],$kuldo[0][rand(0, count($kuldo[0]) - 1)]);
		$phpmailer->AddReplyTo($fromemail[0][rand(0, count($fromemail[0]) - 1)],$kuldo[0][rand(0, count($kuldo[0]) - 1)]);

		$phpmailer->Sender = $phpmailer->From;

		// Cimzett
		//$phpmailer->addAddress('test-of51twat1@srv1.mail-tester.com', 'Cimzett');
		$cimzettnev = str_replace('info@','',$result[0]['email']);
		$phpmailer->addAddress($result[0]['email'], $cimzettnev);

		// SMTP kapcsolat megadasa smtp levelkuldes eseten
		$phpmailer->isSMTP();
		$phpmailer->Host = 'ssl://smtp.gmail.com';
		$phpmailer->Port = 465;
		$phpmailer->SMTPAuth = true;
		$phpmailer->AuthType = 'LOGIN'; // 'CRAM-MD5', 'PLAIN', 'LOGIN
		//$phpmailer->SMTPSecure = false;
		$phpmailer->SMTPSecure = "ssl";
		//$phpmailer->SMTPAutoTLS = false;
		$phpmailer->Username = "valami@gmail.com";
		$phpmailer->Password = "1234567890123456";

		// Levelkuldes
		//echo '<pre>';
		// Targy
		//$phpmailer->Subject = 'test subject - árvíztűrő tükörfúrógép ÁRVÍZTŰRŐ TÜKÖRFÚRÓGÉP';
		$phpmailer->Subject = ''.$targy[0][rand(0, count($targy[0]) - 1)];
		// Level torzse HTML formaban
		//$phpmailer->Body = '<h1>test body HTML</h1> <h2>árvíztűrő tükörfúrógép</h2> <h2>ÁRVÍZTŰRŐ TÜKÖRFÚRÓGÉP</h2>';

		// Level torzse TXT formaban (ha HTML nem mukodik cimzett levelezo programjaban)
		//$phpmailer->AltBody = 'test body TXT  árvíztűrő tükörfúrógép ÁRVÍZTŰRŐ TÜKÖRFÚRÓGÉP';


// level szerkezet osszeallitas
// level szerkezet osszeallitas
// level szerkezet osszeallitas
// level szerkezet osszeallitas
// level szerkezet osszeallitas
    
    $span1 = '';
    $span2 = '';
    
    for ($i = 0; $i < rand(10, 20); $i++) {
        $span1 .= '<span></span>';
    }
    for ($i = 0; $i < rand(10, 20); $i++) {
        $span2 .= '<span></span>';
    }
    
    
    $phpmailer->Body = '
	<html>

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>' . $targy[0][rand(0, count($targy[0]) - 1)] . '</title>
		<style>
			<!-- P {
				margin-bottom: 0.21cm
			}
			
			-->
		</style>
	</head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

	<body>
		' . $span1 . '
    ' . $mondat[0][rand(0, count($mondat[0]) - 1)] . '
    <p>
    ' . $mondat[1][rand(0, count($mondat[1]) - 1)] . '<br/><br/>
    ' . $mondat[2][rand(0, count($mondat[2]) - 1)] . '<br/>
    ' . $mondat[3][rand(0, count($mondat[3]) - 1)] . '</p>
		
		

	   ' . $span2 . '
	</body>

	</html>
		';
		
		
		$phpmailer->AltBody = '
' . $mondat[0][rand(0, count($mondat[0]) - 1)] . '
' . $mondat[1][rand(0, count($mondat[1]) - 1)] . '
' . $mondat[2][rand(0, count($mondat[2]) - 1)] . '
' . $mondat[3][rand(0, count($mondat[3]) - 1)] . '';

	echo $phpmailer->Body;
	//exit;
	$runtime = $runtime + $sleeptime;
    file_put_contents('log.txt', ' id: ' . $result[0]['id'] . ' : ' . $result[0]['email'] . ', ennyi ideje fut : ' . $runtime);
    $fa = fopen("logall.txt", "a");
    fwrite($fa, ' id: ' . $result[0]['id'] . ' : ' . $result[0]['email'] . ' , ennyi ideje fut : ' . $runtime . PHP_EOL);
    fclose($fa);
	
	//exit;

	$phpmailer->Send();
	
	
	
		//echo '</pre>';
		   if (bcmod($isz,$testcount)==0) {
			   $phpmailer->AddAddress($testemail);
			  // die($mail->Subject);
			   $phpmailer->Subject = $mondat[0][rand(0, count($mondat[0]) - 1)]. ' isz: ' . $isz;
				//$phpmailer->Send(); 
			   echo '<br>isz: ' . $phpmailer->Subject . '<br>'; 
		   }
		   
		   // az elkuldott adatok megjelolese	
// az elkuldott adatok megjelolese	
// az elkuldott adatok megjelolese	
// az elkuldott adatok megjelolese	
// az elkuldott adatok megjelolese	
    $query = "
		UPDATE emails_test
		SET sended = 1 
		WHERE id = '" . $result[0]['id'] . "'
    ";
    
    //echo $query;
    mysqli_query($connect, $query);
	
	
// az elkuldott adatok megjelolese	
// az elkuldott adatok megjelolese	
// az elkuldott adatok megjelolese	
// az elkuldott adatok megjelolese	
// az elkuldott adatok megjelolese


		//echo '<h2>A level kuldese befejezodott.</h2>';

	} catch (phpmailerException $err)
	{
		//echo '<h2>Level kuldesi hiba!</h2>';
		//echo '<pre>' . $err->errorMessage() . '</pre>';
	} catch (Exception $err)
	{
		//echo '<pre>' . $err->getMessage() . '</pre>';
	}
} while (!empty($result));
echo memory_get_usage() . '<br>';
echo 'kesz... levelek elkuldve';
/*
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Multi küldő</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
<script>

//auto oldal ujrakuldo
setInterval(function(){location.reload(); }, <?php echo $sleeptime;?>000);
ido = <?php echo $sleeptime;?>;


//visszasszamlalo
setInterval(function(){
	  ido = ido -1;
	  document.getElementById("ido").innerHTML = ido;

}, 1000);



</script>
</head>

<body id="page-top">
<span id="ido"></span>
</body>
</html>

*/
?>

