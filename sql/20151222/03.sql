# 初始化菜单（MENU）表数据
INSERT INTO `menu`(`menu_id`, `menu_name`, `menu_url`, `sort`, `father_menu_id`) VALUES 
(1, '系统管理', '父菜单，无链接', 0, 0), 
(2, '用户管理', '', 1, 1), 
(3, '角色管理', '', 2, 1), 
(4, '菜单管理', '', 3, 1), 
(5, '试卷管理', '父菜单，无链接', 4, 0), 
(6, '试题管理', '', 5, 5), 
(7, '试卷管理', '', 6, 5), 
(8, '试卷批阅', '', 7, 5), 
(9, '题型管理', '', 8, 5), 
(10, '课程管理', '', 9, 5)