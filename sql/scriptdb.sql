create database ProyectoFinal;
use ProyectoFinal;


create table usuarios(
	id int AUTO_INCREMENT,
	usuario varchar(15) unique,
	contrasena char(32),
	perfil char(5),
	PRIMARY KEY(id)
);

create table alumno(
	matricula char(10),
	nombre varchar(20),
	apellido_pat varchar(20),
	apellido_mat  varchar(20),
	PRIMARY KEY(matricula)
);

create table instructor(
	id int,
	nomina char(10) unique,
	correo varchar(30),
	PRIMARY KEY(id),
	FOREIGN KEY (id) references usuarios(id) on delete cascade
);

create table curso(
	clave char(6),
	nombre varchar(20),
	instructor int,
	password varchar(32),
	PRIMARY KEY(clave),
	FOREIGN KEY (instructor) references instructor(id)
);

create table sesion(
	num_sesion int,
	curso char(6),
	fecha date,
	hora_inicio time,
	hora_fin time,
	lugar varchar(20),
	PRIMARY KEY(num_sesion, curso),
	FOREIGN KEY (curso) references curso(clave) on delete cascade
);


create table inscripcion(
	matricula char(10),
	clave char(6),
	PRIMARY KEY(matricula, clave),
	FOREIGN KEY(matricula) references alumno(matricula) on delete cascade,
	FOREIGN KEY(clave) references curso(clave) on delete cascade
);

create table asistencias(
	matricula char(10),
	num_sesion int,
	curso char(6),
	asistencia boolean,
	PRIMARY KEY(matricula, num_sesion, curso),
	FOREIGN KEY(matricula) references alumno(matricula) on delete cascade,
	FOREIGN KEY(num_sesion, curso) references sesion(num_sesion, curso) on delete cascade
);




