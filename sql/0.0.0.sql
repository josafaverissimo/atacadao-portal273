USE internal_system;

drop table if exists is_users;
drop table if exists is_units_phones;
drop table if exists is_units;
drop table if exists is_printers;
drop table if exists is_reports;
drop table if exists is_reports_categories;
drop table if exists is_links;
drop table if exists is_links_categories;
drop table if exists is_birthday_people;

create table is_users
(
    id       int(11) unsigned auto_increment primary key,
    username varchar(255) not null,
    password varchar(255) not null
);

create table is_birthday_people
(
    id       int(11) unsigned auto_increment primary key,
    name     varchar(100) not null,
    birthday date         not null
);

create table is_links_categories
(
    id   int(11) unsigned auto_increment primary key,
    name varchar(30) unique not null
);

create table is_links
(
    id             int(11) unsigned auto_increment primary key,
    name           varchar(100)     not null,
    resource       varchar(300)     not null,
    linkCategoryId int(11) unsigned not null,
    foreign key (linkCategoryId) references is_links_categories (id)
);

create table is_reports_categories
(
    id   int(11) unsigned auto_increment primary key,
    name varchar(100) unique not null
);

create table is_reports
(
    id               int(11) unsigned auto_increment primary key,
    name             varchar(100)     not null,
    description      varchar(200)     not null,
    resource         varchar(300)     not null,
    reportCategoryId int(11) unsigned not null,
    foreign key (reportCategoryId) references is_reports_categories (id)
);

create table is_printers
(
    id            int(11) unsigned auto_increment primary key,
    name          varchar(20) not null,
    image         varchar(50) not null,
    ip            varchar(15) not null,
    currentPrints int(11)     not null default 0,
    lastDayPrints int(11)     not null default 0
);

create table is_units
(
    id       int(11) unsigned auto_increment primary key,
    name     varchar(100) unique not null,
    `number` smallint     not null
);

create table is_units_phones
(
    id       int(11) unsigned auto_increment primary key,
    `number` varchar(20) not null,
    sector   varchar(30) not null,
    owner    varchar(30) not null,
    unitId   int(11) unsigned,
    foreign key (unitId) references is_units (id)
);
