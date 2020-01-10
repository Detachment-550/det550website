create table alumni
(
    id         int auto_increment
        primary key,
    `rank`     varchar(255)                        not null,
    updated_at timestamp                           null,
    created_at timestamp default CURRENT_TIMESTAMP not null,
    email      varchar(255)                        not null,
    first_name varchar(255)                        not null,
    last_name  varchar(255)                        not null,
    phone      varchar(20)                         null,
    major      varchar(255)                        not null,
    position   varchar(255)                        not null,
    image      varchar(255)                        null
)
    charset = latin1;

create table attendance_memo
(
    id                      int auto_increment
        primary key,
    user_id                 int unsigned                        not null,
    event_id                int                                 not null,
    attendance_memo_type_id int                                 not null,
    approved                tinyint(1)                          null,
    created_at              timestamp default CURRENT_TIMESTAMP not null,
    updated_at              timestamp                           null,
    attachment              varchar(255)                        not null,
    memo_for_id             int unsigned                        null,
    comments                text                                null,
    constraint unique_user_event
        unique (user_id, event_id)
)
    charset = latin1;

create index excuse_cadetEvent_eventID_fk
    on attendance_memo (event_id);

create index excuse_excuse_type_excuse_type_id_fk
    on attendance_memo (attendance_memo_type_id);

create index excuse_users_id_fk
    on attendance_memo (user_id);

create index memo_for_users_fk
    on attendance_memo (memo_for_id);

create table attendance_memo_type
(
    id          int auto_increment
        primary key,
    label       varchar(255)                        not null,
    description text                                null,
    created_at  timestamp default CURRENT_TIMESTAMP not null,
    updated_at  timestamp                           null,
    constraint excuse_type_label_uindex
        unique (label)
)
    charset = latin1;

create table `groups`
(
    id          mediumint unsigned auto_increment
        primary key,
    name        varchar(20)  not null,
    description varchar(100) not null
)
    charset = utf8;

create table login_attempts
(
    id         int(11) unsigned auto_increment
        primary key,
    ip_address varchar(45)      not null,
    login      varchar(100)     not null,
    time       int(11) unsigned null
)
    charset = utf8;

create table users
(
    id                          int(11) unsigned auto_increment
        primary key,
    ip_address                  varchar(45)          not null,
    username                    varchar(100)         null,
    password                    varchar(255)         not null,
    email                       varchar(254)         not null,
    activation_selector         varchar(255)         null,
    activation_code             varchar(255)         null,
    forgotten_password_selector varchar(255)         null,
    forgotten_password_code     varchar(255)         null,
    forgotten_password_time     int(11) unsigned     null,
    remember_selector           varchar(255)         null,
    remember_code               varchar(255)         null,
    created_on                  int(11) unsigned     not null,
    last_login                  int(11) unsigned     null,
    active                      tinyint(1) unsigned  null,
    first_name                  varchar(50)          null,
    last_name                   varchar(50)          null,
    class                       varchar(100)         not null,
    phone                       varchar(20)          null,
    rfid                        int(10)              null,
    major                       varchar(100)         null,
    question                    varchar(255)         not null,
    answer                      varchar(255)         not null,
    bio                         text                 null,
    afgoals                     text                 null,
    goals                       text                 null,
    flight                      varchar(20)          null,
    `rank`                      varchar(100)         null,
    position                    varchar(255)         null,
    awards                      text                 null,
    groupme                     varchar(50)          null,
    image                       varchar(255)         null,
    crosstown_exclusion         tinyint(1) default 0 null,
    constraint uc_activation_selector
        unique (activation_selector),
    constraint uc_email
        unique (email),
    constraint uc_forgotten_password_selector
        unique (forgotten_password_selector),
    constraint uc_remember_selector
        unique (remember_selector),
    constraint users_rfid_uindex
        unique (rfid)
)
    charset = utf8;

create table announcement
(
    title         varchar(255)                        not null,
    subject       varchar(255)                        not null,
    body          mediumtext                          not null,
    created_by_id int(11) unsigned                    not null,
    id            int auto_increment
        primary key,
    created_at    timestamp default CURRENT_TIMESTAMP not null,
    updated_at    timestamp                           null,
    constraint announcement_users_id_fk
        foreign key (created_by_id) references users (id)
)
    collate = ascii_bin;

create table acknowledge_post
(
    user            int(11) unsigned                    not null,
    announcement_id int                                 not null,
    created_at      timestamp default CURRENT_TIMESTAMP not null,
    id              int auto_increment
        primary key,
    updated_at      timestamp                           null,
    constraint acknowledge_posts_announcement_fk
        foreign key (announcement_id) references announcement (id)
            on update cascade on delete cascade,
    constraint acknowledge_posts_users_id_fk
        foreign key (user) references users (id)
)
    charset = utf8;

create index acknowledge_posts_cadet_fk
    on acknowledge_post (user);

create index user_fk
    on announcement (created_by_id);

create table announcement_group
(
    id              int auto_increment
        primary key,
    announcement_id int                                 not null,
    group_id        mediumint unsigned                  not null,
    created_at      timestamp default CURRENT_TIMESTAMP not null,
    updated_at      timestamp                           null,
    constraint announcement_fk
        foreign key (announcement_id) references announcement (id),
    constraint group_fk
        foreign key (group_id) references `groups` (id)
)
    charset = latin1;

create table event
(
    name                varchar(255)                         null,
    date                datetime                             null,
    id                  int auto_increment
        primary key,
    pt                  tinyint(1) default 0                 null,
    crosstown_exclusion tinyint(1) default 0                 null,
    llab                tinyint(1) default 0                 null,
    created_at          timestamp  default CURRENT_TIMESTAMP not null,
    created_by_id       int(11) unsigned                     not null,
    updated_at          timestamp                            null,
    constraint cadetEvent_users_id_fk
        foreign key (created_by_id) references users (id)
)
    collate = ascii_bin;

create table attendance
(
    user_id         int(11) unsigned                     not null,
    event_id        int                                  not null,
    excused_absence tinyint(1) default 0                 null,
    created_at      timestamp  default CURRENT_TIMESTAMP not null,
    id              int auto_increment
        primary key,
    comments        text                                 null,
    updated_at      timestamp                            null,
    constraint unique_user_event
        unique (user_id, event_id),
    constraint attendance_cadetEvent_fk
        foreign key (event_id) references event (id)
            on update cascade on delete cascade,
    constraint attendance_users_id_fk
        foreign key (user_id) references users (id)
            on update cascade on delete cascade
)
    collate = ascii_bin;

create index attendance_cadet_fk
    on attendance (user_id);

create table users_groups
(
    id       int(11) unsigned auto_increment
        primary key,
    user_id  int(11) unsigned   not null,
    group_id mediumint unsigned not null,
    constraint uc_users_groups
        unique (user_id, group_id),
    constraint fk_users_groups_groups1
        foreign key (group_id) references `groups` (id)
            on delete cascade,
    constraint fk_users_groups_users1
        foreign key (user_id) references users (id)
            on delete cascade
)
    charset = utf8;

create index fk_users_groups_groups1_idx
    on users_groups (group_id);

create index fk_users_groups_users1_idx
    on users_groups (user_id);

create table wiki
(
    name       varchar(255)                        not null,
    body       longtext                            not null,
    id         int auto_increment
        primary key,
    created_at timestamp default CURRENT_TIMESTAMP not null,
    updated_at timestamp                           null,
    constraint name
        unique (name)
)
    charset = latin1;

