<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<title>Programmazione</title>
<body>



<?php

/* CONTROLLO E LETTURA PARAMETRI*/

if( !isset($_REQUEST["codfisc"]) or
    !isset($_REQUEST["giorno"]) or
    !isset($_REQUEST["orainizio"]) or
    !isset($_REQUEST["durata"]) or
    !isset($_REQUEST["codc"]) or
    !isset($_REQUEST["sala"])) 
  die("Errore: inserire tutti i dati richiesti");

$codfisc = $_REQUEST["codfisc"];
$giorno = $_REQUEST["giorno"];
echo ("$giorno � il giorno");
$con = mysqli_connect('localhost','root','','palestra');

if (mysqli_connect_errno())
{
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
mysqli_set_charset($con,"utf8");

if($giorno!="Luned�" and $giorno!="Marted�" and $giorno!="Mercoled�" and $giorno!="Gioved�" and $giorno!="Venerd�")
   die("Errore: Il giorno specificato non � valido");

$orainizio = $_REQUEST["orainizio"];
$durata = $_REQUEST["durata"];

if ($durata>60)
  die("Errore: Le lezioni non possono durare pi� di 60 minuti");

$codc = $_REQUEST["codc"];

$sala = $_REQUEST["sala"];


/* CONNESSIONE AL DB*/



/* ESECUZIONE QUERY PER LA VERIFICA DELLA CONDIZIONE DA VERIFICARE E POI INSERIMENTO LEZIONE.
  Fanno parte di una singola transazione  */
// Imposto a FALSE l'autocommit e inizio la transazione
mysqli_query($con,"SET autocommit=0;");
mysqli_query($con,"START TRANSACTION;");

/* ESECUZIONE QUERY */
$sql  = "SELECT count(*)
FROM programma 
where CodC='$codc' and Giorno='$giorno'";

$result = mysqli_query($con,$sql);

if( !$result )
  die('Query error: ' . mysqli_error($con));


// Test sul numero di lezioni del corso nel giorno indicato
$row = mysqli_fetch_row($result);
if ($row[0]>1) {
    echo "Non � consentito inserire due lezioni per lo stesso corso nello stesso giorno";
    mysqli_query($con,"ROLLBACK;");
}
else
{  // Inserimento nuova lezione
  if(mysqli_query($con,"INSERT INTO Programma (CodFisc,Giorno,OraInizio,Durata,CodC,Sala) 
                      VALUES ('$codfisc','$giorno','$orainizio','$durata','$codc','$sala');"))
  {
    mysqli_query($con,"COMMIT;");
    echo "La lezione � stata inserita nel programma dei corsi.";
  }
  else   
  {
    echo "Non � stato possibile inserire i dati perch� si � verificato un errore: ". mysqli_error($con);
    mysqli_query($con,"ROLLBACK;");
  }
}

mysqli_close($con);

?>

</br>
	<form method="get" action="form2.php">
		<input type="submit" value="Effettua un altro inserimento">
	</form>


</body>
</html>
