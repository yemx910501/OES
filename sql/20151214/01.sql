#�����û���ɫ��ϵ��
CREATE TABLE `user_role_relation` (
 `user_id` int(10) NOT NULL,
 `role_id` int(10) NOT NULL,
 PRIMARY KEY (`user_id`,`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci