<html>
<head>
<title>Lezioni istruttore</title>
</head>

<body>

<?php

/* CONTROLLO E LETTURA PARAMETRI */
if (! isset ( $_REQUEST ["cognome"] ) or ! isset ( $_REQUEST ["giorno"] ))
	die ( "Errore: inserire tutti i dati richiesti" );

$cognome = $_REQUEST ["cognome"];
$giorno = $_REQUEST ["giorno"];

/* CONNESSIONE AL DB */

$con = @mysqli_connect ( 'localhost', 'root', '', 'PALESTRA' );

if (mysqli_connect_errno ()) {
	echo "Failed to connect to MySQL: " . mysqli_connect_error ();
}

$sql = "SELECT Giorno, OraInizio, Durata, Sala, C.Nome, C.Livello, I.CodFisc, I.Nome, I.Cognome
FROM programma P, istruttore I, Corsi C
WHERE p.CodFisc=i.CodFisc AND C.CodC=P.Codc
AND I.Cognome = '$cognome' AND P.Giorno = '$giorno'
ORDER BY I.CodFisc, C.Nome";

/* ESECUZIONE QUERY */

$result = mysqli_query ( $con, $sql );

if (! $result)
	die ( 'Query error: ' . mysqli_error ( $con ) );

/* VISUALIZZAZIONE RISULTATI */

if (mysqli_num_rows ( $result ) > 0) {
	
	echo "<h2>Lezioni in programma</h2>";
	echo "<p>";
	
	echo "<h4>Le lezioni in programma per l'istruttore $cognome nel giorno $giorno sono le seguenti. </h4>";
	echo "</br>";
	
	echo "<table border=1 cellpadding=10>";
	echo "<tr> <th> Giorno </th>  <th>  Ora inizio  </th> <th>  Durata  </th>  <th> Sala </th> <th>  Nome corso </th>
 <th>  Livello  </th>  <th>  CodFisc Istruttore  </th><th>  Nome Istruttore  </th> <th>  Cognome Istruttore  </th></tr>";
	
	while ( $row = mysqli_fetch_row ( $result ) ) {
		echo "<tr>";
		echo "<td>$row[0]</td><td>$row[1]</td><td>$row[2]</td><td>$row[3]</td><td>$row[4]</td><td>$row[5]</td><td>$row[6]</td><td>$row[7]</td><td>$row[8]</td>";
		echo "</tr>";
	}
	echo "</table>";
} else {
	echo "<h4> Non è stata trovata nessuna lezione per l'istruttore $cognome nel giorno $giorno. </h4>";
}

?>

</br>
	<form method="get" action="form_punto2.php">
		<input type="submit" value="Effettua un'altra ricerca">
	</form>


</body>
</html>
