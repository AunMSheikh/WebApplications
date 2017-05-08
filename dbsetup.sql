create table appuser ( 
    username varchar(20) primary key, 
    password varchar(20), 
    otherinfo varchar(20) 
); 

select * from appuser; 

insert into appuser (username, password) values('arnold', 'spiderman', 'something'); 
insert into appuser (username, password) values('jane', 'wonderwoman', 'another thing'); 

select * from appuser; 

select otherinfo 
from appuser 
where username='arnold'; 

select * 
from appuser 
where username='arnold' and password='zzzz'; 

select count(*)
 from appuser 
where username='arnold' and password='spiderman'; 

create table regclasses (
    instructor varchar(20) references appuser (username), 
    class varchar(20) not null unique,
    constraint classes primary key (class)
);

create table studentclasses (
    student varchar(20) references appuser (username), 
    class varchar(20) references regclasses(class),
    constraint studentin primary key (class, student)
);

alter table appuser drop column otherinfo;
alter table appuser add column email varchar(80);
alter table appuser add column "type" varchar(10);
alter table appuser add column "First Name" varchar(80);
alter table appuser add column "Last Name" varchar(80);

create table currentclass(
    class varchar(20) references regclasses(class),
    numberofstudents int not null default 0,
    -- add to every time a student enrolls. 
    getIt int, 
    dontGetIt int
 );

insert into regclasses (instructor, class) values('arnold', 'csc309');
insert into currentclass (class, numberofstudents) values('csc309', 19); 
