<html>
<head>
<title>Istruttori</title>
</head>

<body>
	<h3>Ricerca lezioni istruttori</h3>
	<form method="get" action="cerca_lezioni_docente.php">

		<table>
			<tr>
				<td>Cognome:</td>
				<td><select name="cognome">
	<?php
	/* CONNESSIONE AL DB */
	$con = @mysqli_connect ( 'localhost', 'root', '', 'PALESTRA' );
	
	if (mysqli_connect_errno ()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error ();
	}
	
	/* ESECUZIONE QUERY */
	$sql = "SELECT distinct Cognome
		FROM istruttore
		ORDER BY Cognome";
	
	$result = mysqli_query ( $con, $sql );
	
	if (! $result)
		die ( 'Query error: ' . mysqli_error () );
	
	/* VISUALIZZAZIONE RISULTATI */
	if (mysqli_num_rows ( $result ) > 0) {
		while ( $row = mysqli_fetch_row ( $result ) ) {
			echo "<option value=$row[0]>$row[0]</option>";
		}
	}
	
	?>
</select></td>
			</tr>

			<tr>
				<td>Giorno:</td>
				<td><select name="giorno">



	<?php
	/* CONNESSIONE AL DB */
	$con = @mysqli_connect ( 'localhost', 'root', '', 'PALESTRA' );
	
	if (mysqli_connect_errno ()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error ();
	}
	
	/* ESECUZIONE QUERY */
	$sql = "SELECT distinct Giorno
		FROM programma
		ORDER BY Giorno";
	
	$result = mysqli_query ( $con, $sql );
	
	if (! $result)
		die ( 'Query error: ' . mysqli_error () );
	
	/* VISUALIZZAZIONE RISULTATI */
	if (mysqli_num_rows ( $result ) > 0) {
		while ( $row = mysqli_fetch_row ( $result ) ) {
			echo "<option value=$row[0]>$row[0]</option>";
		}
	}
	
	?>
				</select></td>
			</tr>

		</table>

		<p>
			<input type="submit" value="Cerca">
	
	</form>
</body>
</html>


