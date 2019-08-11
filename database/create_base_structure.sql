-- ESPECIFCO --
drop table if exists device_responsables;
drop table if exists device_maintenances;
drop table if exists list_responsables;
drop table if exists list_devices;
drop table if exists list_users;
drop table if exists devices;
drop table if exists type_device_variables;
drop table if exists type_devices;
drop table if exists type_variables;
drop table if exists responsables;
drop table if exists lists;
drop table if exists log_events;
-- BASE --
drop procedure if exists sp_navigation_active;
drop procedure if exists sp_user_navigation;
drop procedure if exists sp_user_auth;

drop view if exists vw_navigation_action_paths;
drop view if exists vw_user_role_permissions;
drop view if exists vw_user;
drop view if exists vw_user_roles;

drop table if exists navigation_favorites;
drop table if exists navigation_paths;
drop table if exists navigation_actions;
drop table if exists rbac_permissions;
drop table if exists rbac_actions;
drop table if exists user_sessions;
drop table if exists user_roles;
drop table if exists navigations;
drop table if exists rbac_group_actions;
drop table if exists rbac_roles;
drop table if exists users;

create table users(
	user_id int not null primary key auto_increment,
	user_username varchar(50) NOT NULL,
	user_password varchar(100) NOT NULL,
	user_firstname varchar(100) NOT NULL,
	user_lastname varchar(200) NOT NULL,
	user_email varchar(50) NOT NULL,
	user_phone varchar(50) NOT NULL,
	user_gender char(1) NOT NULL,
	user_birthdate date not null,
	user_date_registered timestamp NULL DEFAULT current_timestamp,
	user_date_updated timestamp NULL DEFAULT current_timestamp,
	user_date_validated timestamp NULL,
	user_date_lastlogin timestamp NULL,
	user_must_change_password tinyint(1) NOT NULL DEFAULT '1',
	user_img_profile varchar(255) NULL DEFAULT 'static/img/user.png',
	user_status tinyint(1) NOT NULL DEFAULT '1',
	status tinyint(1) NOT NULL DEFAULT '1'
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

insert into users(user_username,user_password,user_firstname,user_lastname,user_email,user_phone,user_gender,user_birthdate) values
('admin', '$2y$10$j0QznrGyhX/QiPGZAcAjIe2TIYtYrQjA.XxIXQA7JEqfmiOXzpqQm','Administrador', 'Del Sistema', 'jnolbertovm@gmail.com','963852741','M','1992-02-03');

update users set user_must_change_password = 0 where user_id = 1;

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
	status tinyint(1) not null default '1',
	foreign key (user_id) references users (user_id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

create table user_roles(
	userrole_id int not null primary key auto_increment,
	user_id int not null,
	role_id int not null,
	userrole_date_created timestamp NULL DEFAULT current_timestamp,
	userrole_date_updated timestamp NULL,
	userrole_status tinyint(1) NOT NULL DEFAULT '1',
	status tinyint(1) NOT NULL DEFAULT '1',
	foreign key (user_id) references users (user_id),
	foreign key (role_id) references rbac_roles (role_id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

insert into user_roles(user_id, role_id) values
(1,1);
 
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

insert into navigations(navigation_name, navigation_level, navigation_depends, navigation_url, navigation_icon, navigation_order) values
('Sistema',1,0,null,'ti-package',2),
('Administración de Usuarios',2,1,'/setup/user', null,1),
('Administración de Roles',2,1,'/setup/role', null,2),
('Administración de Acciones',2,1,'/setup/action', null,3),
('Listas',1,0,'/list','ti-view-list-alt',1);

CREATE TABLE navigation_paths (
	navigationpath_id int not null primary key auto_increment,
	navigation_id int NOT NULL,
	controller_name varchar(100) NULL,
	action_name varchar(100) NULL,
	module_name varchar(100) NULL,
	status tinyint(1) not null default '1',
	foreign key (navigation_id) references navigations (navigation_id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

insert into navigation_paths(navigation_id,controller_name,action_name,module_name) values
(2,'user', null, 'setup'),
(3,'role', null, 'setup'),
(4,'action', null, 'setup'),
(5, null,null,'list');

CREATE TABLE navigation_favorites (
	navigationfavorite_id int not null primary key auto_increment,
	user_id int NOT NULL,
	navigationfavorite_name varchar(255) NOT NULL,
	navigationfavorite_url varchar(255) NOT NULL,
	status tinyint(1) not null default '1',
	foreign key (user_id) references users (user_id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE rbac_group_actions (
	groupaction_id int not null primary key auto_increment,
	groupaction_key varchar(100) NOT NULL,
	groupaction_name varchar(100) NOT NULL,
	groupaction_description text NULL,
	groupaction_order tinyint(4) NULL DEFAULT 1,
	groupaction_status tinyint(1) not null default '1',
	status tinyint(1) not null default '1'
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

insert into rbac_group_actions(groupaction_key, groupaction_name) values
('ADMIN_USERS','Administrar Usuarios'),
('ADMIN_ROLES','Administrar Roles'),
('ADMIN_ACTIONS','Administrar Acciones del Sistema'),
('ADMIN_LISTS','Administración de Listas');

CREATE TABLE rbac_actions (
	action_id int not null primary key auto_increment,
	groupaction_id int NOT NULL,
	action_key varchar(100) NOT NULL,
	action_name varchar(100) NOT NULL,
	action_description text NULL,
	action_status tinyint(1) not null default '1',
	status tinyint(1) not null default '1',
	foreign key (groupaction_id) references rbac_group_actions (groupaction_id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

insert into rbac_actions(groupaction_id, action_key, action_name) values
(1,'USER_CREATE', 'Crear Usuarios'),
(1,'USER_UPDATE', 'Actualizar Usuarios'),
(1,'USER_DELETE', 'Eliminar Usuarios'),
(1,'USER_VIEW', 'Ver Lista Usuarios'),
(2,'ROLE_CREATE', 'Crear Roles'),
(2,'ROLE_UPDATE', 'Actualizar Roles'),
(2,'ROLE_DELETE', 'Eliminar Roles'),
(2,'ROLE_VIEW', 'Ver Lista de Roles'),
(2,'ROLE_PERMISSION', 'Administración de Permisos'),
(3,'ACTION_CREATE', 'Crear Acciones'),
(3,'ACTION_UPDATE', 'Actualizar Acciones'),
(3,'ACTION_DELETE', 'Eliminar Acciones'),
(3,'ACTION_VIEW', 'Ver Lista de  Acciones'),
(4,'LIST_CREATE', 'Crear Listas'),
(4,'LIST_UPDATE', 'Actualizar Listas'),
(4,'LIST_DELETE', 'Eliminar Listas'),
(4,'LIST_ASSIGN_USERS', 'Asignar Usuarios'),
(4,'LIST_ASSIGN_DEVICES', 'Asignar Dispositivos'),
(4,'LIST_VIEW', 'Ver Listas');

CREATE TABLE rbac_permissions (
	permission_id int not null primary key auto_increment,
	role_id int NOT NULL,
	action_id int NOT NULL,
	permission_status tinyint(1) not null default '1',
	status tinyint(1) not null default '1',
	foreign key (role_id) references rbac_roles (role_id),
	foreign key (action_id) references rbac_actions (action_id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE navigation_actions (
	navigationaction_id int not null primary key auto_increment,
	navigation_id int NOT NULL,
	action_id int NOT NULL,
	status tinyint(1) not null default '1',
	foreign key (navigation_id) references navigations (navigation_id),
	foreign key (action_id) references rbac_actions (action_id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

insert into navigation_actions(navigation_id, action_id) values
(2,4),
(3,8),
(4,13),
(5,19);

-- CREACION DE VISTAS --

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
     JOIN rbac_actions a ON a.action_id = p.action_id AND a.status = 1
		 WHERE vur.userrole_status = 1;
    
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
 
-- CREACION DE PROCEDIMIENTOS -- 

DELIMITER $$

CREATE PROCEDURE sp_navigation_active(IN `_controller_name` varchar(100), IN `_action_name` varchar(100), IN `_module_name` varchar(100))
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
END$$

DELIMITER ;

DELIMITER $$

CREATE PROCEDURE sp_user_auth(IN `_username` varchar(45))
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
END$$

DELIMITER ;

DELIMITER $$

CREATE PROCEDURE sp_user_navigation(IN `_user_id` int, IN `_role_id` int)
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
END$$

DELIMITER ;

create table log_events(
	logevent_id int not null primary key auto_increment,
	action_id int not null,
	usersession_id int not null,
	logevent_code int not null,
	logevent_message text not null,
	logevent_params text not null,
	logevent_public tinyint(1) not null default '1',
	logevent_date_created timestamp not null default current_timestamp,
	status tinyint(1) not null default '1',
	foreign key (action_id) references rbac_actions (action_id),
	foreign key (usersession_id) references user_sessions (usersession_id)
);

create table responsables(
	responsable_id int not null primary key auto_increment,
	responsable_name varchar(255) not null,
	responsable_phone varchar(255) null,
	responsable_position varchar(255) null,
	status tinyint(1) not null default '1'
);

create table lists(
	list_id int not null primary key auto_increment,
	list_code char(10) not null,
	list_name varchar(255) not null,
	list_resumen text null,
	list_status int not null default '1',
	active tinyint(1) not null default '1',
	status tinyint(1) not null default '1'
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

create table type_variables(
	typevariable_id int not null primary key auto_increment,
	typevariable_denomination varchar(255) not null,
	typevariable_key varchar(255) not null,
	active tinyint(1) not null default '1',
	status tinyint(1) not null default '1'
);

create table type_devices(
	typedevice_id int not null primary key auto_increment,
	typedevice_denomination varchar(255) not null,
	typedevice_origin varchar(255) not null,
	typedevice_modem tinyint(1) null default '1',
	typedevice_maintenance_frequency int null,
	status tinyint(1) not null default '1'
);

create table type_device_variables(
	typedevicevariable_id int not null primary key auto_increment,
	typedevice_id int not null,
	typevariable_id int not null,
	status tinyint(1) not null default '1',
	foreign key (typedevice_id) references type_devices (typedevice_id),
	foreign key (typevariable_id) references type_variables (typevariable_id)
);

create table devices(
	device_id int not null primary key auto_increment,
	typedevice_id int not null,
	device_code char(20) not null,
	device_serie varchar(50) not null,
	device_latitude varchar(50) not null,
	device_longitude varchar(50) not null,
	device_number_modem varchar(255) null,
	device_provider_modem varchar(255) null,
	device_status tinyint(1) not null default '1',
	status tinyint(1) not null default '1',
	foreign key (typedevice_id) references type_devices (typedevice_id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;


create table device_maintenances(
	devicemaintenance_id int not null primary key auto_increment,
	device_id int not null,
	devicemaintenance_date date not null,
	responsable_id int not null,
	status tinyint(1) not null default '1',
	foreign key (device_id) references devices (device_id),
	foreign key (responsable_id) references responsables (responsable_id)
);

create table device_responsables(
	deviceresponsable_id  int not null primary key auto_increment,
	device_id int not null,
	responsable_id int not null,
	status tinyint(1) not null default '1',
	foreign key (device_id) references devices (device_id),
	foreign key (responsable_id) references responsables (responsable_id)
);

create table list_users(
	listuser_id int not null primary key auto_increment,
	list_id int not null,
	role_id int not null,
	user_id int not null,
	status tinyint(1) not null default '1',
	foreign key (list_id) references lists (list_id),
	foreign key (role_id) references rbac_roles (role_id),
	foreign key (user_id) references users (user_id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

create table list_devices(
	listdevice int not null primary key auto_increment,
	list_id int not null,
	device_id int not null,
	status tinyint(1) not null default '1',
	foreign key (list_id) references lists (list_id),
	foreign key (device_id) references devices (device_id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

create table list_responsables(
	listresponsable_id int not null primary key auto_increment,
	list_id int not null,
	responsable_id int not null,
	status tinyint(1) not null default '1',
	foreign key (list_id) references lists (list_id),
	foreign key (responsable_id) references responsables (responsable_id)
);


