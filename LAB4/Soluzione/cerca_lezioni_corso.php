<html>
<head>
<title>Lezioni corso</title>
</head>

<body>

<?php

/* CONTROLLO E LETTURA PARAMETRI */
if (! isset ( $_REQUEST ["codice_corso"] ))
	die ( "Errore: inserire tutti i dati richiesti" );

$cod_corso = $_REQUEST ["codice_corso"];

/* CONNESSIONE AL DB */

$con = @mysqli_connect ( 'localhost', 'root', '', 'PALESTRA' );

if (mysqli_connect_errno ()) {
	echo "Failed to connect to MySQL: " . mysqli_connect_error ();
}

$sql = "SELECT Giorno, OraInizio, Durata, Sala, Nome, Cognome
FROM PROGRAMMA P, ISTRUTTORE I
WHERE P.CodFisc=I.CodFisc
AND CodC='$cod_corso'";

/* ESECUZIONE QUERY */

$result = mysqli_query ( $con, $sql );
if (! $result)
	die ( 'Query error: ' . mysqli_error ( $con ) );

/* VISUALIZZAZIONE RISULTATI */

if (mysqli_num_rows ( $result ) > 0) {
	
	echo "<h2>Lezioni in programma per il corso $cod_corso</h2>";
	echo "</br>";
	
	echo "<table border=1 cellpadding=10>";
	echo "<tr> <th> Giorno </th>  <th>  Ora inizio  </th> <th>  Durata  </th>  <th>  Sala  </th>
 <th>  Nome istruttore  </th>  <th>  Cognome istruttore  </th></tr>";
	
	while ( $row = mysqli_fetch_row ( $result ) ) {
		echo "<tr>";
		echo "<td>$row[0]</td><td>$row[1]</td><td>$row[2]</td><td>$row[3]</td><td>$row[4]</td><td>$row[5]</td>";
		echo "</tr>";
	}
	echo "</table>";
} else {
	echo "<h4> Non è stata trovata nessuna lezione per il cordo $cod_corso. </h4>";
}

?>

</br>
	<form method="get" action="form_punto1.php">
		<input type="submit" value="Effettua un'altra ricerca">
	</form>

</body>
</html>
