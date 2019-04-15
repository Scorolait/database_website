--																		ENTITES
---------------------------------------------------------------------------------------------------------------------------------------------
---------------------------------------------------------------------------------------------------------------------------------------------
---------------------------------------------------------------------------------------------------------------------------------------------


CREATE TABLE employeur(
	noSiret integer,
	nom varchar(25) NOT NULL,
	adresse varchar(50) NOT NULL,
	tel char(10) NOT NULL,
	primary key(noSiret)
);


CREATE TABLE frais(
	annee_univ integer DEFAULT 0,
	formation varchar(25) DEFAULT '',
	tarifs integer NOT NULL,
	primary key(annee_univ, formation)
	);


CREATE TABLE module(
	codeMod integer,
	Libelle varchar(25) NOT NULL,
	Notemin char(2),
	primary key(codeMod)
);


CREATE TABLE correcteur(
	idCorr integer,
	nom varchar(25) NOT NULL,
	prenom varchar(25) NOT NULL,
	tel char(10) NOT NULL,
	adrEmail varchar(50),
	primary key(idCorr)

);


CREATE TABLE session_Exam(
	nomSession varchar(25),
	dateDebut date NOT NULL,
	dateFin date NOT NULL,
	heureDebut time NOT NULL, 
	heureFin time NOT NULL, 
	primary key(nomSession)
);


CREATE TABLE gardien(
	idGarde integer,
	nomGarde varchar(25) NOT NULL,
	prenomGarde varchar(25) NOT NULL,
	primary key (idGarde)
);


CREATE TABLE candidat(
	idEtud serial,
	nom varchar(25) NOT NULL,
	prenom varchar(25) NOT NULL,
	adrEmail varchar(50) NOT NULL,
	anneeEtud varchar(25),
	formation varchar(25),
	noSiret integer,
	annee_univ integer,

	CONSTRAINT candi_noSiret_fk FOREIGN KEY (noSiret) REFERENCES employeur(noSiret) 
	ON UPDATE CASCADE ON DELETE SET NULL,
	CONSTRAINT candi_annee_form_fk FOREIGN KEY (annee_univ, formation) REFERENCES frais(annee_univ, formation)
	ON UPDATE CASCADE ON DELETE RESTRICT,

	primary key(idEtud)
);


CREATE TABLE personnel_Admin(
	noAdmin integer,
	idEtud integer,

	CONSTRAINT perso_idEtud_fk FOREIGN KEY (idEtud) REFERENCES candidat(idEtud)
	ON UPDATE CASCADE ON DELETE CASCADE,

	primary key(noAdmin)
);


CREATE TABLE batiment(
	nomBat varchar(25),
	heureOuvert time NOT NULL,
	heureFerme time NOT NULL,
	idGarde integer NOT NULL,

	CONSTRAINT bat_idGard_fk FOREIGN KEY (idGarde) REFERENCES gardien(idGarde)
	ON UPDATE CASCADE ON DELETE RESTRICT,

	primary key(nomBat)
);


CREATE TABLE epreuve(
	codeEp integer,
	dateEp date NOT NULL,
	heureDebut time NOT NULL,
	heureFin time NOT NULL,
	salleEp varchar(10) NOT NULL,
	nomSession varchar(25) NOT NULL,
	nomBat varchar(25) NOT NULL,
	codeMod integer NOT NULL,

	CONSTRAINT ep_nomSession_fk FOREIGN KEY (nomSession) REFERENCES session_exam(nomSession)
	ON UPDATE RESTRICT ON DELETE RESTRICT,
	CONSTRAINT ep_nomBat_fk FOREIGN KEY (nomBat) REFERENCES batiment(nomBat)
	ON UPDATE RESTRICT ON DELETE RESTRICT,
	CONSTRAINT ep_codeMod_fk FOREIGN KEY (codeMod) REFERENCES module(codeMod)
	ON UPDATE RESTRICT ON DELETE RESTRICT,

	primary key(codeEp)
);


CREATE TABLE surveillant(
	idSurv integer,
	nom varchar(25) NOT NULL,
	prenom varchar(25) NOT NULL,
	tel char(10),
	salarie char(1) check (salarie IN ('o','n')) NOT NULL,
	codeEp integer,
	codeEp_resp char(1) check (codeEp_resp IN ('o','n')) NOT NULL,
	primary key(idSurv),

	CONSTRAINT surv_codeEp_fk FOREIGN KEY (codeEp) REFERENCES epreuve(codeEp)
	ON UPDATE CASCADE ON DELETE RESTRICT
);




--																		ASSOCIATION
---------------------------------------------------------------------------------------------------------------------------------------------
---------------------------------------------------------------------------------------------------------------------------------------------
---------------------------------------------------------------------------------------------------------------------------------------------



CREATE TABLE obtenir(
	idEtud integer NOT NULL,
	codeMod integer NOT NULL,
	primary key (idEtud, codeMod),

	CONSTRAINT obtenir_idEtud_fk FOREIGN KEY (idEtud) REFERENCES candidat(idEtud)
	ON UPDATE RESTRICT ON DELETE RESTRICT,
	CONSTRAINT obtenir_codeMod_fk FOREIGN KEY (codeMod) REFERENCES module(codeMod)
	ON UPDATE RESTRICT ON DELETE RESTRICT
);


CREATE TABLE convoquer(
	idEtud integer NOT NULL,
	codeEp integer NOT NULL,
	idCorr integer NOT NULL,
	note char(2),
	justificatif char(1) check (justificatif in ('o','n')),
	primary key (idEtud, codeEp, idCorr),

	CONSTRAINT convoquer_idEtud_fk FOREIGN KEY (idEtud) REFERENCES candidat(idEtud)
	ON UPDATE RESTRICT ON DELETE RESTRICT,
	CONSTRAINT convoquer_codeEp_fk FOREIGN KEY (codeEp) REFERENCES epreuve(codeEp)
	ON UPDATE RESTRICT ON DELETE RESTRICT,
	CONSTRAINT convoquer_idCorr_fk FOREIGN KEY (idCorr) REFERENCES correcteur(idCorr)
	ON UPDATE CASCADE ON DELETE RESTRICT
);



-- JEU DE DONNEES DE TEST --

INSERT INTO employeur values
(1, 'GREGORIO', '10 rue de la Liberte 99123 VILLENOUVELLE', '0720255547'),
(2, 'MARTIN', '52 rue des Jonquilles 99123 VILLENOUVELLE', '0126559207'),
(3, 'BERNARD', '44 rue des Facteurs 87160 ARNAC', '0940556507'),
(4, 'THOMAS', '23 rue de la Bastille 75012 PARIS', '0625254409');

INSERT INTO frais values
(0, '', 50),
(1, 'SM', 0),
(1, 'LMI', 0),
(3, 'MITIC', 15);

INSERT INTO module values
(1, 'AP2', 10),
(2, 'SUITES', 10),
(3, 'ALGEBRE', 10);

INSERT INTO correcteur values
(1, 'LAURENT', 'Leroy', '0620154507', 'Laurent-Leroy@gmail.fr'),
(2, 'ROUX', 'David', '0725354608', 'Roux-David@gmail.fr'),
(3, 'MICHEL', 'Lefebvre', '0795612014', NULL);

INSERT INTO session_exam values
('Janvier 2016', '2016/01/06', '2016/01/15', '08:30:00', '16:30:00'),
('Juin 2016', '2016/06/07', '2016/06/18', '08:30:00', '16:30:00'); 

INSERT INTO gardien values
(1, 'MOREL', 'Fournier'),
(2, 'BONNET', 'Dupont');

INSERT INTO candidat(nom, prenom, adrEmail, anneeEtud, formation, noSiret, annee_univ) values
('FONTAINE', 'Rousseau', 'Fontaine-Rousseau@gmail.fr', 'L2', 'MITIC', NULL, 3), 
('VINCENT',  'Muller', 'Vincent-Muller@gmail.fr', 'SM1', 'SM', 1, 1),  
('LEFEVRE', 'Faure', 'Lefevre-Faure@gmail.fr', NULL, '', 2, 0),
('ANDRE',  'Mercier', 'Andre-Mercier@gmail.fr', 'L3', 'LMI', 3, 1);


INSERT INTO personnel_Admin values 
(1, 1),
(2, 4);

INSERT INTO batiment values 
('COPERNIC A', '08:30:00',  '16:30:00', 1),
('COPERNIC B', '09:30:00',  '18:30:00', 2);


INSERT INTO epreuve values
(1, '2016/01/06', '08:30:00', '10:30:00', 'A3017', 'Janvier 2016', 'COPERNIC A', 1),
(2, '2016/06/08', '08:30:00', '10:30:00', 'B3017', 'Juin 2016', 'COPERNIC B', 2);


INSERT INTO surveillant values 
(1, 'LORIE', 'Hugo', '0664152517', 'o', 1, 'o'),
(2, 'FREGO', 'Amaie', '0764162611', 'n', 2, 'o'),
(3, 'RAGGU', 'Alloy', '0784166511', 'n', 2, 'n');

INSERT INTO obtenir values 
(1, 2),
(1, 3),
(2, 3);

INSERT INTO convoquer values
(1, 1, 2, 10),
(2, 1, 1, NULL);