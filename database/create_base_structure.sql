use master;

create database if not exists iot character set utf8 COLLATE utf8_general_ci;

use iot;

create table users(
	user_id int not null primary key auto_increment,
	user_username varchar(50) NOT NULL,
	user_password varchar(100) NOT NULL,
	user_firstname varchar(100) NOT NULL,
	user_lastname varchar(200) NOT NULL,
	user_email varchar(50) NOT NULL,
	user_date_registered timestamp NULL DEFAULT current_timestamp,
	user_date_updated timestamp NULL DEFAULT current_timestamp,
	user_date_validated timestamp NULL,
	user_date_lastlogin timestamp NULL,
	user_must_change_password tinyint(1) NOT NULL DEFAULT '1',
	user_img_profile varchar(255) NULL DEFAULT 'static/img/user.png',
	user_status tinyint(1) NOT NULL DEFAULT '1',
	status tinyint(1) NOT NULL DEFAULT '1'
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

insert into users(user_username,user_password,user_firstname,user_lastname,user_email) values
('admin', '$2y$10$j0QznrGyhX/QiPGZAcAjIe2TIYtYrQjA.XxIXQA7JEqfmiOXzpqQm','Administrador', 'Del Sistema', 'jnolbertovm@gmail.com');

create table user_roles(
	userrole_id int not null primary key auto_increment,
	user_id int not null,
	role_id int not null,
	userrole_date_created timestamp NULL DEFAULT current_timestamp,
	userrole_status tinyint(1) NOT NULL DEFAULT '1',
	status tinyint(1) NOT NULL DEFAULT '1'
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

insert into user_roles(user_id, role_id) values
(1,1);

create table user_sessions (
	usersession_id int not null primary key auto_increment,
	user_id int not null,
	usersession_token varchar(40) null,
	usersession_host varchar(255) null,
	usersession_os varchar(255) null,
	usersession_browser varchar(255) null,
	usersession_browser_version varchar(255) null,
	usersession_device varchar(255) null,
	usersession_geoip text null,
	usersession_date_created timestamp null default current_timestamp,
	usersession_date_expired timestamp null,
	usersession_status tinyint(1) not null default '1',
	status tinyint(1) not null default '1'
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

drop table if exists rbac_roles;
CREATE TABLE rbac_roles (
	role_id int not null primary key auto_increment,
	role_key varchar(100) NOT NULL,
	role_name varchar(100) NOT NULL,
	role_description text NULL,
	role_default tinyint(1) not null default '0',
	role_status tinyint(1) not null default '1',
	status tinyint(1) not null default '1'
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

insert into rbac_roles(role_key,role_name) values
('SUPERADMIN','Super Administrador'),
('ADMIN','Administrador'),
('VISOR','Visualizador');

drop view vw_user_roles;
create view vw_user_roles as 
SELECT ur.user_id,
    ur.userrole_id,
    r.role_id,
    r.role_key,
    r.role_name,
    r.role_status,
    r.role_default,
    ur.userrole_status
   FROM user_roles ur
     JOIN rbac_roles r ON r.role_id = ur.role_id AND r.status = 1
  WHERE ur.status = 1;
 
drop view vw_user;
create view vw_user as
SELECT u.user_id,
    u.user_firstname,
    u.user_lastname,
    u.user_username,
    u.user_email,
    u.user_date_lastlogin,
    u.user_date_registered,
    u.user_date_updated,
    u.user_must_change_password,
    u.user_img_profile,
    u.user_status,
    vur.role_id,
    vur.role_key,
    vur.role_name,
    vur.role_default
   FROM users u
     LEFT JOIN vw_user_roles vur ON vur.user_id = u.user_id AND vur.userrole_status = 1
  WHERE u.status = 1;

 
CREATE TABLE navigations (
	navigation_id int not null primary key auto_increment,
	navigation_name varchar(100) NOT NULL,
	navigation_level tinyint(1) NOT NULL DEFAULT 1,
	navigation_depends int NOT NULL DEFAULT 0,
	navigation_url varchar(255) NULL,
	navigation_icon varchar(100) NULL,
	navigation_order tinyint(4) NULL DEFAULT 1,
	navigation_status tinyint(1) not null default '1',
	status tinyint(1) not null default '1'
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

insert into navigations(navigation_name, navigation_level, navigation_depends) values
('Sistema',1,0),
('Administración de Usuarios',2,1),
('Administración de Roles',2,1),
('Administración de Acciones',2,1);

CREATE TABLE navigation_actions (
	navigationaction_id int not null primary key auto_increment,
	navigation_id int NOT NULL,
	action_id int NOT NULL,
	status tinyint(1) not null default '1'
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

insert into navigation_actions(navigation_id, action_id) values
(2,1),
(3,2),
(4,3);

CREATE TABLE navigation_paths (
	navigationpath_id int not null primary key auto_increment,
	navigation_id int NOT NULL,
	controller_name varchar(100) NULL,
	action_name varchar(100) NULL,
	module_name varchar(100) NULL,
	status tinyint(1) not null default '1'
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

insert into navigation_paths(navigation_id,controller_name,action_name,module_name) values
(2,'user', null, 'setup'),
(3,'role', null, 'setup'),
(4,'action', null, 'setup');

CREATE TABLE navigation_favorites (
	navigationfavorite_id int not null primary key auto_increment,
	user_id int NOT NULL,
	navigationfavorite_name varchar(255) NOT NULL,
	navigationfavorite_url varchar(255) NOT NULL,
	status tinyint(1) not null default '1'
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE rbac_group_actions (
	groupaction_id int not null primary key auto_increment,
	groupaction_name varchar(100) NOT NULL,
	groupaction_description text NULL,
	groupaction_order tinyint(4) NULL DEFAULT 1,
	groupaction_status tinyint(1) not null default '1',
	status tinyint(1) not null default '1'
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

insert into rbac_group_actions(groupaction_name) values
('Configuración del Sistema');

CREATE TABLE rbac_actions (
	action_id int not null primary key auto_increment,
	groupaction_id int NOT NULL,
	action_key varchar(100) NOT NULL,
	action_name varchar(100) NOT NULL,
	action_description text NULL,
	action_status tinyint(1) not null default '1',
	status tinyint(1) not null default '1'
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

insert into rbac_actions(groupaction_id, action_key, action_name) values
(1,'ADMIN_USERS', 'Administración de Usuarios'),
(1,'ADMIN_ROLES', 'Administración de Roles'),
(1,'ADMIN_ACTIONS', 'Administración de Acciones'),
(1,'ADMIN_PERMISSION', 'Administración de Permisos');

CREATE TABLE rbac_permissions (
	permission_id int not null primary key auto_increment,
	role_id int NOT NULL,
	action_id int NOT NULL,
	permission_status tinyint(1) not null default '1',
	status tinyint(1) not null default '1'
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

insert into rbac_permissions(role_id, action_id) values
(1, 1),
(1, 2),
(1, 3),
(1, 4);

create view vw_user_role_permissions as
SELECT vur.user_id,
    vur.role_id,
    vur.role_key,
    vur.role_name,
    vur.role_status,
    p.permission_id,
    p.permission_status,
    a.action_id,
    a.action_key,
    a.action_name,
    a.action_status
   FROM vw_user_roles vur
     JOIN rbac_permissions p ON p.role_id = vur.role_id AND p.status = 1
     JOIN rbac_actions a ON a.action_id = p.action_id AND a.status = 1;
    
 create view vw_navigation_action_paths as 
 SELECT na.navigation_id,
    na.action_id,
    np.controller_name,
    np.action_name,
    np.module_name
   FROM navigation_paths np
     JOIN navigation_actions na ON na.navigation_id = np.navigation_id AND na.status = 1
     JOIN navigations n ON n.navigation_id = np.navigation_id AND n.status = 1
  WHERE np.status = 1;
  
 
CREATE PROCEDURE `iot`.`sp_navigation_active`(IN `_controller_name` varchar(100), IN `_action_name` varchar(100), IN `_module_name` varchar(100))
begin
	select
		vnap.action_id
	from vw_navigation_action_paths vnap
	where (
		(vnap.module_name = _module_name and vnap.controller_name = _controller_name and vnap.action_name is null)
		or
		(vnap.module_name = _module_name and vnap.controller_name = _controller_name and vnap.action_name = _action_name)
		or
		(vnap.module_name is null and vnap.controller_name = _controller_name and vnap.action_name is null)
		or
		(vnap.module_name is null and vnap.controller_name = _controller_name and vnap.action_name = _action_name)
		or
		(vnap.module_name = _module_name and vnap.controller_name is null and vnap.action_name is null)
	);
END;

CREATE PROCEDURE `iot`.`sp_user_auth`(IN `_username` varchar(45))
begin
	DECLARE _user_status	INT;
	DECLARE _user_id 		INT;
	DECLARE _user_password	VARCHAR(100);

	SELECT u.user_id, u.`user_status`, u.`user_password` INTO _user_id, _user_status,_user_password FROM `users` as u WHERE u.user_username = _username AND u.`status` = 1;

	IF _user_id IS NULL THEN
		SELECT TRUE as `error`, 1811 as `code`, 'No pudimos encontrar tu cuenta InsiteIOT' as `message`;
	END IF;	
    
    IF _user_status = 2 THEN
		SELECT TRUE as `error`, 1812 as `code`, 'Su cuenta se encuentra temporalmente Bloqueada' as `message`;
	END IF;
    
    UPDATE `users` SET user_date_lastlogin = curdate() WHERE user_id = _user_id;
   
	SELECT FALSE as `error`, _user_id as `user_id`, _user_password as `password`;
END;


CREATE PROCEDURE `iot`.`sp_user_navigation`(IN `_user_id` int, IN `_role_id` int)
begin
	select n.*, vurp.action_id
	from navigations n
	inner join navigation_actions na on (na.navigation_id = n.navigation_id and na.status = 1)
	inner join vw_user_role_permissions vurp on (vurp.action_id = na.action_id)
	where n.navigation_status = 1
	and n.status = 1
	and vurp.user_id = _user_id 
	and vurp.role_id = _role_id
	order by 
		n.navigation_level
		,n.navigation_order
		,n.navigation_depends;
END;

