/*
Projet: Centre Medical
Noms: MILROY Ashley
	  RAVENDRAN Preanthy
Groupe: TP10
*/




DROP TABLE IF EXISTS patient CASCADE;
DROP TABLE IF EXISTS service CASCADE;
DROP TABLE IF EXISTS sejour CASCADE;
DROP TABLE IF EXISTS ayant_droit CASCADE;
DROP TABLE IF EXISTS bien CASCADE;
DROP TABLE IF EXISTS effet CASCADE;
DROP TABLE IF EXISTS bijou CASCADE;
DROP TABLE IF EXISTS chequier CASCADE;
DROP TABLE IF EXISTS liquidite CASCADE;
DROP TABLE IF EXISTS objet_bancaire CASCADE;
DROP TABLE IF EXISTS avoir CASCADE;
DROP TABLE IF EXISTS occuper CASCADE;



---
--- Create table Patient
---

CREATE TABLE patient (
	IPU serial PRIMARY KEY,
	nom varchar(25) NOT NULL,
	prenom varchar(25) NOT NULL,
	adresse varchar(100) NOT NULL,
	mail varchar(100) UNIQUE NOT NULL,
	mdp text NOT NULL
);

---
--- Create table Ayant_droit
---

CREATE TABLE ayant_droit (
	id_AD serial PRIMARY KEY,
	nom varchar(25) NOT NULL,
	prenom varchar(25) NOT NULL,
	date_naissance date,
	lieu_naissance varchar(25), 
	lien varchar(25),
	tel varchar(10) UNIQUE,
	IPU int
);

---
--- Create table Service
---

CREATE TABLE service (
	num_ser serial PRIMARY KEY,
	nom varchar(25) NOT NULL
);


---
--- Create table Sejour
---

CREATE TABLE sejour (
	num_sej serial PRIMARY KEY,
	date_deb date NOT NULL,
	date_fin date,
	IPU int
);


---
--- Create table Bien
---

CREATE TABLE bien (
	id_bien serial PRIMARY KEY,
	description text,
	num_sej int
);

---
--- Create table Effet
---

CREATE TABLE effet (
	id_effet serial PRIMARY KEY,
	type varchar(25),
	id_bien int
);

---
--- Create table Bijou
---

CREATE TABLE bijou (
	id_bijou serial PRIMARY KEY,
	estimation_max numeric(6,2) NOT NULL,
	estimation_min numeric(6,2) NOT NULL,
	type varchar(25),
	id_bien int,
	CONSTRAINT trancheEstimation CHECK(estimation_min < estimation_max)
);


---
--- Create table Chequier
---

CREATE TABLE chequier (
	num_chequier serial PRIMARY KEY,
	nom_banque varchar(30),
	num_dernier_ch varchar(10) NOT NULL,
	id_bien int,
	CONSTRAINT UniqueDern_ch UNIQUE (num_dernier_ch)
);


---
--- Create table Liquidite
---

CREATE TABLE liquidite (
	id_liquide serial PRIMARY KEY,
	montant numeric(6,2) CHECK(montant > 0),
	devise varchar(10),
	id_bien int
);


---
--- Create table Objet_bancaire
---

CREATE TABLE objet_bancaire (
	id_bancaire serial PRIMARY KEY,
	nom_banque varchar(30),
	num_carte varchar(19) UNIQUE,
	id_bien int
);


---
--- Create table Avoir
---

CREATE TABLE avoir (
	num_sej int PRIMARY KEY,
	etat varchar(15) NOT NULL,
	dateA date,
	CONSTRAINT check_etat CHECK(etat = 'conscient' OR etat = 'inconscient' OR etat = 'mort')
);


---
--- Create table Occuper
---

CREATE TABLE occuper (
	num_sej int,
	num_ser int,
	dateO date,
	num_lit int NOT NULL,
	CONSTRAINT Uniquenum_lit UNIQUE (num_lit),
	PRIMARY KEY (num_sej, num_ser, dateO)
);




ALTER TABLE ONLY ayant_droit
    ADD CONSTRAINT AD_patient_fkey FOREIGN KEY (IPU) REFERENCES patient(IPU) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE ONLY bien
    ADD CONSTRAINT bien_sejour_fkey FOREIGN KEY (num_sej) REFERENCES sejour(num_sej) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE ONLY effet
    ADD CONSTRAINT effet_bien_fkey FOREIGN KEY (id_bien) REFERENCES bien(id_bien) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE ONLY bijou
    ADD CONSTRAINT bijou_bien_fkey FOREIGN KEY (id_bien) REFERENCES bien(id_bien) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE ONLY chequier
    ADD CONSTRAINT chequier_bien_fkey FOREIGN KEY (id_bien) REFERENCES bien(id_bien) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE ONLY liquidite
    ADD CONSTRAINT liquidite_bien_fkey FOREIGN KEY (id_bien) REFERENCES bien(id_bien) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE ONLY objet_bancaire
    ADD CONSTRAINT objet_bancaire_bien_fkey FOREIGN KEY (id_bien) REFERENCES bien(id_bien) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE ONLY avoir
    ADD CONSTRAINT avoir_sejour_fkey FOREIGN KEY (num_sej) REFERENCES sejour(num_sej) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE ONLY occuper
    ADD CONSTRAINT occuper_sejour_fkey FOREIGN KEY (num_sej) REFERENCES sejour(num_sej) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE ONLY occuper
    ADD CONSTRAINT occuper_service_fkey FOREIGN KEY (num_ser) REFERENCES service(num_ser) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE ONLY sejour
    ADD CONSTRAINT sejour_patient_fkey FOREIGN KEY (IPU) REFERENCES patient(IPU) ON DELETE CASCADE ON UPDATE CASCADE;






--
-- Data for Table: Patient
--

INSERT INTO patient(nom, prenom, adresse, mail, mdp) VALUES('Dupont', 'Arnaud', '21 Rue Jacques Prevert, Paris', 'Arnaud.Dupont@gmail.com', md5('ADPAT01'));
INSERT INTO patient(nom, prenom, adresse, mail, mdp) VALUES('Leroy', 'Pierre', '13 Avenue Foch, Saint-Denis', 'Pierre.Leroy@free.fr', md5('PLPAT02'));
INSERT INTO patient(nom, prenom, adresse, mail, mdp) VALUES('Fontaine', 'Luc', '23 Avenue Victor Hugo, Mantes-la-Jolie', 'Luc.Fontaine@hotmail.fr', md5('LFPAT03'));
INSERT INTO patient(nom, prenom, adresse, mail, mdp) VALUES('Courtet', 'Jacques','23 Rue Louis Eterlet, Paris', 'Jacques.Courtet@gmail.com', md5('JCPAT04'));
INSERT INTO patient(nom, prenom, adresse, mail, mdp) VALUES('Dupont', 'Arnaud', '21 Rue Boulevard des Foch, Lognes', 'Arnaud.Dupont@yahoo.com', md5('ADPAT05'));
INSERT INTO patient(nom, prenom, adresse, mail, mdp) VALUES('Ducrocq', 'Laurent', '15 Rue de la Belle Ile, Champs-sur-Marne', 'Laurent.Ducrocq@gmail.com', md5('LDPAT06'));


--
-- Data for Table: Ayant_droit
--

INSERT INTO ayant_droit(nom, prenom, date_naissance, lieu_naissance, lien, tel, IPU) VALUES('Dupond', 'Louis', '24/01/1961', 'Savigny-le-Temple', 'père', '0678451202', 1);
INSERT INTO ayant_droit(nom, prenom, lien, tel, IPU) VALUES('Leroy', 'Marie', 'épouse', '0712455623', 2);
INSERT INTO ayant_droit(nom, prenom, lieu_naissance, tel, IPU) VALUES('Ducrocq', 'Raymond', 'Gagny', '0748150262', 3);
INSERT INTO ayant_droit(nom, prenom, date_naissance, lieu_naissance, tel, IPU) VALUES('Rafael', 'Didier', '30/06/1961', 'Roissy-en-Brie', '0636251485', 4);
INSERT INTO ayant_droit(nom, prenom, date_naissance, lien, IPU) VALUES('Lefevre', 'Arianne', '05/05/1988', 'belle-soeur', 5);


--
-- Data for Table: Service
--

INSERT INTO service(nom) VALUES('Urgence');
INSERT INTO service(nom) VALUES('Anesthésiologie');
INSERT INTO service(nom) VALUES('Dermatologie');
INSERT INTO service(nom) VALUES('Diététique');
INSERT INTO service(nom) VALUES('Cardiologie');
INSERT INTO service(nom) VALUES('Pédiatrie');


--
-- Data for Table: Sejour
--

INSERT INTO sejour(date_deb, date_fin, IPU) VALUES('14/09/2017', '15/09/2017', 2);
INSERT INTO sejour(date_deb, date_fin, IPU) VALUES('26/10/2018', '01/04/2018', 1);
INSERT INTO sejour(date_deb, date_fin, IPU) VALUES('14/12/2018', '14/12/2018', 1);
INSERT INTO sejour(date_deb, date_fin, IPU) VALUES('07/08/2017', '23/09/2017', 4);
INSERT INTO sejour(date_deb, date_fin, IPU) VALUES('21/07/2019', '30/07/2019', 5);


--
-- Data for Table: Bien
--

INSERT INTO bien(description, num_sej) VALUES('Liquidite d un montant de 07.50 dollar composé d un billet de 5 dollars et d un billet de 
deux dollars et d une piece de 50 centimes ', 1);
INSERT INTO bien(description, num_sej) VALUES('Le vetement est une jupe noir', 1);
INSERT INTO bien(description, num_sej) VALUES('Un collier Pendentif Solitaire de la marque SWAROVSKI', 3);
INSERT INTO bien(description, num_sej) VALUES('Un Bracelet Dinh Van Menottes R12 argent sur cordon', 2);
INSERT INTO bien(description, num_sej) VALUES('Cheque bancaire dun montant de 200 euros issue de l agence Crédit Agricole', 2);
INSERT INTO bien(description, num_sej) VALUES('Cheque bancaire dun montant de 500 euros issue de l agence BNP PARIBAS', 3);
INSERT INTO bien(description, num_sej) VALUES('Linge de toilette de blanc ', 4);
INSERT INTO bien(description, num_sej) VALUES('Cheque bancaire d un montant de 400 euros', 2);
INSERT INTO bien(description, num_sej) VALUES('Liquidite dun montant de 56.84 euros composé dun billet de 50 euros, d un billet de 5 euros
	, une piece de un euro, d une piece de 50 centimes, d une piece de 30 centimes et de deux piece de 2 centimes', 4);
INSERT INTO bien(description, num_sej) VALUES('Liquidité d un montant de 05.93', 2);
INSERT INTO bien(description, num_sej) VALUES('Montre Tommy Hilfiger', 4);
INSERT INTO bien(description, num_sej) VALUES('Carte bancaire de lagence BNP PARIBAS dont le numéro est 4970 1012 3456 7890', 4);
INSERT INTO bien(description, num_sej) VALUES('Carte bancaire  de lagence CREDIT AGRICOLE dont le numéro est 5440 4012 7512 8691', 1);



--
-- Data for Table: Effet
--

INSERT INTO effet(type, id_bien) VALUES('vetement', 2);
INSERT INTO effet(type, id_bien) VALUES('linge de toilette', 7);
--
-- Data for Table: Bijou
--

INSERT INTO bijou(estimation_min, estimation_max, type, id_bien) VALUES(45.00, 300.00, 'montre', 11);
INSERT INTO bijou(estimation_min, estimation_max, type, id_bien) VALUES(5.00, 40.00, 'collier', 3);
INSERT INTO bijou(estimation_min, estimation_max, type, id_bien) VALUES(2.00, 32.99, 'bracelet', 4);


--
-- Data for Table: Chequier
--

INSERT INTO chequier(nom_banque, num_dernier_ch, id_bien) VALUES('BNP Paribas', 308, 6);
INSERT INTO chequier(num_dernier_ch, id_bien) VALUES(107, 8);
INSERT INTO chequier(nom_banque, num_dernier_ch, id_bien) VALUES('Crédit Agricole', 1024, 5);


--
-- Data for Table: Liquidite
--

INSERT INTO liquidite(montant, devise, id_bien) VALUES(56.84, 'euro', 9);
INSERT INTO liquidite(montant, devise, id_bien) VALUES(09.50, 'dollar', 1);
INSERT INTO liquidite(montant, id_bien) VALUES(05.93, 10);



--
-- Data for Table: Objet_bancaire
--

INSERT INTO objet_bancaire(nom_banque, num_carte, id_bien) VALUES('BNP Paribas', '4970 1012 3456 7890', 12);
INSERT INTO objet_bancaire(nom_banque, num_carte, id_bien) VALUES('Crédit Mutuelle', '5440 4012 7512 8691', 13);


--
-- Data for Table: Avoir
--

INSERT INTO avoir(num_sej, etat, dateA) VALUES(1, 'conscient', '15/09/2017');
INSERT INTO avoir(num_sej, etat, dateA) VALUES(2, 'conscient', '01/04/2018');
INSERT INTO avoir(num_sej, etat, dateA) VALUES(3, 'mort', '23/09/2017');
INSERT INTO avoir(num_sej, etat, dateA) VALUES(4, 'inconscient', '21/07/2019');



--
-- Data for Table: Occuper
--

INSERT INTO occuper(num_sej, num_ser, dateO, num_lit) VALUES(1, 6, '20/08/2019',2);
INSERT INTO occuper(num_sej, num_ser, dateO, num_lit) VALUES(2, 5, '07/06/2017',3);
INSERT INTO occuper(num_sej, num_ser, dateO, num_lit) VALUES(4, 4, '22/11/2018',4);
INSERT INTO occuper(num_sej, num_ser, dateO, num_lit) VALUES(3, 2, '22/11/2018',6);


