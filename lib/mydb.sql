DROP DATABASE IF EXISTS mydb;
CREATE DATABASE IF NOT EXISTS mydb;

USE mydb;

DROP TABLE IF EXISTS counter;
CREATE TABLE IF NOT EXISTS counter (
  rowid int(11) NOT NULL auto_increment,
  visited int(11) default '0',
  url char(255) default NULL,
  last_date char(30) default NULL,
  PRIMARY KEY  (rowid)
) ;

DROP TABLE IF EXISTS user;
CREATE TABLE IF NOT EXISTS user (
  rowid int(11) NOT NULL auto_increment,
  userid char(20) default NULL,
  password char(100) default NULL,
  name char(50) default NULL,
  address char(255) default NULL,
  tel char(50) default NULL,
  email char(100) default NULL,
  zip char(10) default NULL,
  user_level int(11) default '0',
  PRIMARY KEY  (rowid),
  KEY userid (userid)
) ;

DROP TABLE IF EXISTS guestbook;
CREATE TABLE IF NOT EXISTS guestbook (
  rowid int(11) NOT NULL auto_increment,
  name varchar(30) default NULL,
  email varchar(100) default NULL,
  url varchar(255) default NULL,
  content text,
  password varchar(50) default NULL,
  input_date varchar(30) default NULL,
  hostinfo varchar(30) default NULL,
  edit_date varchar(30) default NULL,
  PRIMARY KEY  (rowid)
);

DROP TABLE IF EXISTS board;
CREATE TABLE IF NOT EXISTS board (
  rowid int(11) NOT NULL auto_increment,
  groupnum int(11) default '1',
  stepnum int(11) default '0',
  depth int(11) default '0',
  name varchar(30) default NULL,
  userid varchar(30) default NULL,
  email varchar(100) default NULL,
  password varchar(50) default NULL,
  subject varchar(100) default NULL,
  content text,
  content_type varchar(10) default NULL,
  hostinfo varchar(30) default NULL,
  input_date varchar(30) default NULL,
  edit_date varchar(30) default NULL,
  filename text,
  access int(11) default '0',
  PRIMARY KEY  (rowid)
) ;
