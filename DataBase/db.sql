CREATE DATABASE schedulepal;

USE schedulepal;

CREATE TABLE fakultas (
  id_fakultas int NOT NULL primary key auto_increment,
  nama_fakultas varchar(50) NOT NULL
);

CREATE TABLE users (
  NIM bigint NOT NULL,
  username varchar(20) NOT NULL,
  fakultas int NOT NULL,
  password varchar(255) NOT NULL,
  role enum('user','admin') NOT NULL DEFAULT 'user',
  PRIMARY KEY (NIM),
  FOREIGN KEY (fakultas) REFERENCES fakultas(id_fakultas) ON DELETE CASCADE
);

CREATE TABLE schedule (
  id_acara int NOT NULL primary key auto_increment,
  judul_acara varchar(50) NOT NULL,
  deskripsi varchar(255) NOT NULL,
  waktu time NOT NULL,
  tanggal date NOT NULL,
  lokasi varchar(255) NOT NULL,
  status enum('Diterima','Ditolak','Tunggu'),
  NIM bigint NULL,
  fakultas int not null,
  FOREIGN KEY (fakultas) REFERENCES fakultas(id_fakultas) ON DELETE CASCADE,
  FOREIGN KEY (NIM) REFERENCES users(NIM) ON DELETE CASCADE ON UPDATE CASCADE
);
