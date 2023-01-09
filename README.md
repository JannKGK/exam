# exam
http://82.147.181.75/exam/

## SQL statements for creating the database and inserting example values

create database exam;

create table signees(
    email primary varchar(50) not null,
    fullname varchar(50) not null,
    exam_time datetime not null
);

create table exam_times(
    Time primary datetime not null
);

create table admins(
    Username primary varchar(50) not null,
    Password varchar(50) not null
);

insert into admins values('admin','password');

insert into exam_times('2023-02-14 06:00:00');

insert into signees('example@ex.com','John Doe','2023-02-14 06:00:00');
