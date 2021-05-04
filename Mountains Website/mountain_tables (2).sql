drop table if exists review;
drop table if exists mount_category;
drop table if exists mountain;

create table mountain (
	id int not null,
	name varchar(50) not null,
    photo varchar(100),
	primary key (id)
);

create table mount_category (
	id int not null auto_increment,
	mountain int not null,
	category varchar(30) not null,
	seriousness varchar(3) not null,
	constraint foreign key fk_mount_cat (mount) references mountain(id),
	primary key (id)
);

create table review ( 
	id int not null,
    mountain int not null,
    email varchar(100),
    name varchar(50),
    difficulty int,
    comments varchar(255),

    constraint foreign key fk_review_mount (mount) references mountain(id),
    primary key (id)
);

insert into mountain (id,name) values (1,'Kilimanjaro');
insert into mountain (id,name) values (2,'Everest');
insert into mountain (id,name) values (3,'K2');
insert into mountain (id,name) values (4,'Elbert');
insert into mountain (id,name) values (5,'Olympus');
insert into mountain (id,name) values (6,'Appalachian');

insert into mount_category (mountain,category,seriousness) values (1,'scrambling','I');
insert into mount_category (mountain,category,seriousness) values (1,'traditional','I');
insert into mount_category (mountain,category,seriousness) values (1,'traditional','II');
insert into mount_category (mountain,category,seriousness) values (2,'mountaineering','IV');
insert into mount_category (mountain,category,seriousness) values (2,'belaying','V');
insert into mount_category (mountain,category,seriousness) values (2,'mountaineering','VI');
insert into mount_category (mountain,category,seriousness) values (2,'ice climbing','VII');

insert into review (id,mountain,email,name,difficulty,comments) values (1,1,'nono@gmail.com','Not Me',1,'Quiet easy and enjoyable');
insert into review (id,mountain,email,name,difficulty,comments) values (2,1,'nini@hotmail.qa','Ahmed',2,'Depending on the route, it could be very easy or a bit challenging');
insert into review (id,mountain,email,name,difficulty,comments) values (3,2,'fifi@email.com','Mr. Canvas',6,'Very difficult, damn near killed me');
insert into review (id,mountain,email,name,difficulty,comments) values (4,1,'yesyes@gmail.com','Its Me',1,'Very fun activity specially with friends');
insert into review (id,mountain,email,name,difficulty,comments) values (5,1,'mikhaelle@gmail.com','Mikhaelle',3,'I am new to climbing and i found this very difficult');
insert into review (id,mountain,email,name,difficulty,comments) values (6,2,'luisya@gmail.com','Luis',4,'Goos challange');		
insert into review (id,mountain,email,name,difficulty,comments) values (7,3,'seejay@gmail.com','Seejay',6,'what the hell is even that?');
insert into review (id,mountain,email,name,difficulty,comments) values (8,3,'athallah@gmail.com','Athallalala',1,'EZ. i could do that with y eyes closed.');
insert into review (id,mountain,email,name,difficulty,comments) values (9,4,'turki@gmail.com','Turki',2,'so i went with a friend, and they sliipped. Be careful. Easy for me though');
insert into review (id,mountain,email,name,difficulty,comments) values (10,4,'ddychill@gmail.com','Ddy',5,'Chill.');
insert into review (id,mountain,email,name,difficulty,comments) values (11,5,'olympian@gmail.com','Olympian',8,'This mountain may be in my name, but it was hard ngl.');
insert into review (id,mountain,email,name,difficulty,comments) values (12,5,'john@gmail.com','John',7,'I flew.');
insert into review (id,mountain,email,name,difficulty,comments) values (13,6,'molly@gmail.com','Molly',4,'Got really HiGh (in the mountain ofc)');
insert into review (id,mountain,email,name,difficulty,comments) values (14,6,'krak@gmail.com','Krak',10,'Head. I cracked my head. I slipped and fell. VERY HARD. I DO NOT RECOMMEND.');
insert into review (id,mountain,email,name,difficulty,comments) values (15,6,'book@gmail.com','Book',2,'It was a challange because I am new to this, but I enjoyed the view and the breeze.');


insert into mount_category (mountain,category,seriousness) values (3,'scrambling','I');
insert into mount_category (mountain,category,seriousness) values (3,'scrambling','II');
insert into mount_category (mountain,category,seriousness) values (3,'traditional','V');
insert into mount_category (mountain,category,seriousness) values (4,'traditional','III');
insert into mount_category (mountain,category,seriousness) values (4,'mountaineering','IV');
insert into mount_category (mountain,category,seriousness) values (4,'mountaineering','VII');
insert into mount_category (mountain,category,seriousness) values (5,'mountaineering','VII');
insert into mount_category (mountain,category,seriousness) values (5,'belaying','I');
insert into mount_category (mountain,category,seriousness) values (5,'belaying','VI');
insert into mount_category (mountain,category,seriousness) values (6,'belaying','V');
insert into mount_category (mountain,category,seriousness) values (6,'ice climbing','II');
insert into mount_category (mountain,category,seriousness) values (6,'ice climbing','III');


