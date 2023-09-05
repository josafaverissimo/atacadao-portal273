USE internal_system;

drop table if exists units_phones;
drop table if exists units;
drop table if exists printers;
drop table if exists reports;
drop table if exists reports_categories;
DROP table IF EXISTS links;
drop table if exists links_categories;
DROP TABLE IF EXISTS birthday_people;

CREATE TABLE birthday_people(
                                id int(11) unsigned auto_increment primary key,
                                name varchar(100) not null,
                                birthday date not null
);

create table links_categories(
                                 id int(11) unsigned auto_increment primary key,
                                 name varchar(30)
);

CREATE TABLE links(
                      id int(11) unsigned auto_increment primary key,
                      name varchar(100) not null,
                      url varchar(300) not null,
                      targetBlank boolean not null default 1,
                      linkCategoryId int(11) unsigned not null,
                      foreign key (linkCategoryId) references links_categories(id)
);

create table reports_categories (
                                    id int(11) unsigned auto_increment primary key,
                                    name varchar(100) not null
);

create table reports(
                        id int(11) unsigned auto_increment primary key,
                        name varchar(100) not null,
                        description varchar(200) not null,
                        url varchar(300) not null,
                        reportCategoryId int(11) unsigned not null,
                        foreign key (reportCategoryId) references reports_categories(id)
);

create table printers(
                         id int(11) unsigned auto_increment primary key,
                         name varchar(20) not null,
                         image varchar(50) not null,
                         currentPrints int(11) not null default 0,
                         lastDayPrints int(11) not null default 0
);

create table units(
                      id int(11) unsigned auto_increment primary key,
                      name varchar(100) not null,
                      unitNumber smallint not null
);

create table units_phones(
                             id int(11) unsigned auto_increment primary key,
                             phoneNumber varchar(20) not null,
                             sector varchar(30) not null,
                             owner varchar(30) not null,
                             unitId int(11) unsigned,
                             foreign key (unitId) references units(id)
);
































