# exam
http://82.147.181.75/exam/

SQL statements for creating the database and inserting example values
create table signees(
    email primary varchar(50),
    fullname varchar(50),
    exam_time datetime
);

create table exam_times(
    Time datetime
);

create table admins(
    Username primary varchar(50),
    Password varchar(50)
);

insert into admins values('admin','password')

insert into exam_times('2023-02-14 06:00:00')

insert into signees('example@ex.com','John Doe','2023-02-14 06:00:00')