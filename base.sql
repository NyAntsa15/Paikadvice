create database hackaton;
	use hackaton;
	create table Agri(
		idAgri int  primary key auto_increment,
		Nom varchar(200) not null,
		Prenom varchar(200) not null,
		date_de_naissance date, 
		Region varchar(50) not null,
		Numero_de_telephone varchar(20),
		email varchar(100) not null unique,
		mot_de_passe varchar(200) not null,
		nom_image varchar(200),
		ClePrive int not null
		);

	create table Vulg(
		idVulg int  primary key auto_increment,
		Nom varchar(200) not null,
		Prenom varchar(200) not null,
		date_de_naissance date, 
		Adresse_de_travail varchar(200) not null,
		Region varchar(50) not null,
		Date_formation date not null,
		Lieu_formation varchar(100) not null,
		Specialite varchar(50) not null,
		Qualification varchar(50) not null,
		Numero_de_telephone varchar(20) ,
		email varchar(100) not null unique,
		mot_de_passe varchar(200) not null,
		Experience varchar(10) not null,
		nom_image varchar(200),
		horaire varchar(30) not null,
		ClePrive int not null
		);

	create table Message(
		idMessage int  primary key auto_increment,
		Texte text not null,
		idCategorieE int not null,
		idCategorieR int not null,
		idEnvoyeur int not null,
		idRecepteur int not null,
		heure_envoi datetime not null,
		heure_vu datetime default null
		);

	create table Forum(
		idForum int  primary key auto_increment,
		idLanceur int not null,
		HeureLancement datetime not null,
		Texte text not null,
		idCategorie int not null
		);

	create table Reponse_Forum(
		idReponse int primary key auto_increment,
		idForum int not null,
		Heure_Reponse datetime not null,
		idRepondeur int not null,
		Texte text not null,
		idCategorie int not null
		);

	create table Journal(
		idJournal int  primary key auto_increment,
		idEnvoyeur int not null,
		date_envoi datetime not null,
		texte text not null,
		nom_image varchar(100)
		);

	create table Plan(
		idTache int  primary key auto_increment,
		idEnvoyeur int not null,
		date_planification date not null,
		texte text not null,
		idTypeTache int not null
		);

	create table TypeTache(
		idTypeTache int  primary key auto_increment,
		TypeTache varchar(50) not null
		);

	create table Decouvertes(
		idDecouverte int  primary key auto_increment,
		nom_multimedia varchar(100),
		Texte_description text not null,
		idEnvoyeur int not null
		);

	create table Feedback(
		idFeedback int  primary key auto_increment,
		idEnvoyeur int not null,
		idRecepteur int not null,
		type_feedback int not null,
		description text not null
		);

	create table Categorie(
		idCategorie int  primary key auto_increment,
		nom varchar(50) not null
		);
	
	create table Region(
		idRegion int primary key auto_increment,
		nom varchar(20) not null
	);

	create table Memoire(
		i int not null
	);

	alter table Message
	add foreign key(idCategorieE)references Categorie(idCategorie);

	alter table Message
	add foreign key(idCategorieR)references Categorie(idCategorie);

	alter table Message 
	add foreign key(idEnvoyeur)references Agri(idAgri);

	alter table Message 
	add foreign key(idEnvoyeur)references Vulg(idVulg);

	alter table Message 
	add foreign key(idRecepteur)references Agri(idAgri);

	alter table Message 
	add foreign key(idRecepteur)references Vulg(idVulg);

	alter table Forum 
	add foreign key(idLanceur)references Vulg(idVulg);

	alter table Forum 
	add foreign key(idLanceur)references Agri(idAgri);

	alter table Reponse_Forum 
	add foreign key(idForum)references Forum(idForum);

	alter table Reponse_Forum 
	add foreign key(idRepondeur)references Vulg(idVulg);

	alter table Reponse_Forum 
	add foreign key(idRepondeur)references Agri(idAgri);

	alter table Journal
	add foreign key(idEnvoyeur)references Vulg(idVulg);

	alter table Plan
	add foreign key(idEnvoyeur)references Vulg(idVulg);

	alter table Plan
	add foreign key(idTypeTache)references TypeTache(idTypeTache);

	alter table Decouvertes
	add foreign key(idEnvoyeur)references Vulg(idVulg);

	alter table Feedback
	add foreign key(idEnvoyeur)references Agri(idAgri);

	alter table Feedback
	add foreign key(idRecepteur)references Vulg(idVulg);

	insert into TypeTache (TypeTache) values('Forum');

	insert into TypeTache (TypeTache) values('Rendez-vous');

	insert into TypeTache (TypeTache) values('Publication');

	insert into Categorie (nom) values ('Agriculteur');

	insert into Categorie (nom) values ('Vulgarisateur');

	insert into Region(nom) values ('Diana');
	insert into Region(nom) values ('Sava');
	insert into Region(nom) values ('Itasy');
	insert into Region(nom) values ('Analamanga');
	insert into Region(nom) values ('Vakinankaratra');
	insert into Region(nom) values ('Bongolava');
	insert into Region(nom) values ('Sofia');
	insert into Region(nom) values ('Boeny');
	insert into Region(nom) values ('Betsiboka');
	insert into Region(nom) values ('Melaky');
	insert into Region(nom) values ('Alaotra-Mangoro');
	insert into Region(nom) values ('Atsinanana');
	insert into Region(nom) values ('Analanjirofo');
	insert into Region(nom) values ('Amoron i Mania');
	insert into Region(nom) values ('Haute Matsiatra');
	insert into Region(nom) values ('Vatovavy');
	insert into Region(nom) values ('Fitovinany');
	insert into Region(nom) values ('Atsimo-Atsinanana');
	insert into Region(nom) values ('Ihorombe');
	insert into Region(nom) values ('Menabe');
	insert into Region(nom) values ('Atsimo-Andrefana');
	insert into Region(nom) values ('Androy');
	insert into Region(nom) values ('Anôsy');

	insert into Memoire values ('1');





