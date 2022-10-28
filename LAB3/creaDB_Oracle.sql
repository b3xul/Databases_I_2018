DROP TABLE PROGRAMMA;
DROP TABLE CORSI;
DROP TABLE ISTRUTTORE;

CREATE TABLE ISTRUTTORE
	(CodFisc CHAR (16) PRIMARY KEY,
	Nome VARCHAR (50),
	Cognome VARCHAR (50),
	DataNascita DATE,
	Email VARCHAR (50),
	Telefono VARCHAR (14));
	
CREATE TABLE CORSI
	(CodC CHAR (5) PRIMARY KEY,
	Nome VARCHAR (50),
	Tipo VARCHAR (50),
	Livello SMALLINT);

CREATE TABLE PROGRAMMA
	(CodFisc CHAR (16),
	Giorno VARCHAR (10),
	OrarioInizio DATE,
	Durata SMALLINT,
	CodC CHAR (5),
	Sala CHAR (2),
	PRIMARY KEY(CodFisc,Giorno,OrarioInizio),
	
	FOREIGN KEY(CodFisc)
		REFERENCES ISTRUTTORE(CodFisc),
	
	FOREIGN KEY(CodC)
		REFERENCES CORSI(CodC));