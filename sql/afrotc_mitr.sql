create table cadet
(
  firstName    varchar(255)  null,
  `rank`       varchar(25)   null,
  rin          int           not null
    primary key,
  primaryEmail varchar(100)  null,
  primaryPhone bigint(15)    not null,
  password     varchar(255)  null,
  bio          text          null,
  flight       varchar(20)   not null,
  position     varchar(100)  null,
  groupMe      varchar(50)   not null,
  AFGoals      text          null,
  awards       text          null,
  lastName     varchar(255)  not null,
  PGoals       text          not null,
  rfid         int(10)       null,
  major        varchar(100)  null,
  question     varchar(255)  null,
  answer       text          null,
  loginattempt int default 0 not null
)
  collate = ascii_bin;

create table announcement
(
  title     varchar(255)                        not null,
  subject   varchar(255)                        not null,
  body      mediumtext                          not null,
  createdBy int(10)                             not null,
  uid       int auto_increment
    primary key,
  date      timestamp default CURRENT_TIMESTAMP not null,
  constraint user_fk
    foreign key (createdBy) references cadet (rin)
      on update cascade on delete cascade
)
  collate = ascii_bin;

create table acknowledge_posts
(
  rin                  int(10)                             not null,
  announcement_id      int                                 not null,
  time                 timestamp default CURRENT_TIMESTAMP not null,
  acknowledge_posts_id int auto_increment
    primary key,
  constraint acknowledge_posts_announcement_fk
    foreign key (announcement_id) references announcement (uid)
      on update cascade on delete cascade,
  constraint acknowledge_posts_cadet_fk
    foreign key (rin) references cadet (rin)
      on update cascade on delete cascade
)
  charset = utf8;

create table cadetEvent
(
  name    varchar(255)         null,
  date    datetime             null,
  eventID int auto_increment
    primary key,
  pt      tinyint(1) default 0 null,
  llab    tinyint(1) default 0 null
)
  collate = ascii_bin;

create table attendance
(
  rin             int                                  not null,
  eventid         int                                  not null,
  excused_absence tinyint(1) default 0                 null,
  time            timestamp  default CURRENT_TIMESTAMP not null,
  attendance_id   int auto_increment
    primary key,
  constraint attendance_cadetEvent_fk
    foreign key (eventid) references cadetEvent (eventid)
      on update cascade on delete cascade,
  constraint attendance_cadet_fk
    foreign key (rin) references cadet (rin)
      on update cascade on delete cascade
)
  collate = ascii_bin;

create table cadetGroup
(
  label       varchar(255) not null,
  id          int auto_increment
    primary key,
  description text         not null,
  constraint cadetGroup_label_uindex
    unique (label)
)
  collate = ascii_bin;

create table emails
(
  uid            int auto_increment
    primary key,
  day            date         not null,
  `to`           varchar(255) null,
  `from`         varchar(255) null,
  subject        mediumtext   null,
  message        longtext     null,
  title          varchar(255) null,
  announcementid int          not null,
  constraint emails_announcement_fk
    foreign key (announcementid) references announcement (uid)
      on update cascade on delete cascade
)
  charset = latin1;

create table groupMember
(
  groupID        int     not null,
  rin            int(10) not null,
  groupMember_id int auto_increment
    primary key,
  constraint groupMember_cadetGroup_fk
    foreign key (groupID) references cadetGroup (id)
      on update cascade on delete cascade,
  constraint groupMember_cadet_fk
    foreign key (rin) references cadet (rin)
      on update cascade on delete cascade
)
  collate = ascii_bin;

create table wiki
(
  name varchar(255) not null,
  body longtext     not null,
  id   int auto_increment
    primary key,
  constraint name
    unique (name)
)
  charset = latin1;


