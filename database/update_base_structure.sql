use iot;

update users set user_must_change_password=0 where user_id = 1;

update navigations set navigation_icon = 'ti-package' where navigation_id = 1;
update navigations set navigation_url = '/setup/user' where navigation_id = 2;
update navigations set navigation_url = '/setup/role' where navigation_id = 3;
update navigations set navigation_url = '/setup/action' where navigation_id = 4;