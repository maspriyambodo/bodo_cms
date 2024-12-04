CREATE TABLE `laracms.sys_menu`  (
  `id` int NOT NULL,
  `menu_parent` int NULL DEFAULT NULL,
  `nama` varchar(50) NULL DEFAULT NULL,
  `link` varchar(255) NULL DEFAULT NULL,
  `order_no` int NULL DEFAULT NULL,
  `group_menu` int NOT NULL COMMENT '1. applications\\r\\n2. report\\r\\n3. systems',
  `icon` varchar(50) NULL DEFAULT NULL,
  `description` varchar(255) NULL DEFAULT NULL,
  `is_trash` int NOT NULL DEFAULT 0 COMMENT '0. aktif 1. deleted',
  `created_by` int NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_by` int NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `group_menu`(`group_menu`)
);

CREATE TABLE `laracms.sys_menu_group`  (
  `id` int NOT NULL,
  `nama` varchar(255) NULL DEFAULT NULL,
  `description` varchar(255) NULL DEFAULT NULL,
  `order_no` int NULL DEFAULT NULL,
  `is_trash` int NULL DEFAULT NULL COMMENT '0. aktif 1. deleted',
  `created_at` datetime NULL DEFAULT NULL,
  `created_by` int NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  `updated_by` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `laracms.sys_permissions`  (
  `id` int NOT NULL,
  `role_id` int NULL DEFAULT NULL,
  `id_menu` int NULL DEFAULT NULL,
  `v` int NULL DEFAULT 0 COMMENT 'view',
  `c` int NULL DEFAULT 0 COMMENT 'create',
  `r` int NULL DEFAULT 0 COMMENT 'read',
  `u` int NULL DEFAULT 0 COMMENT 'update',
  `d` int NULL DEFAULT 0 COMMENT 'delete',
  `created_at` datetime NULL DEFAULT NULL,
  `created_by` int NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  `updated_by` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `laracms.user_groups`  (
  `id` int NOT NULL,
  `name` varchar(255) NULL DEFAULT NULL,
  `description` varchar(255) NULL DEFAULT NULL,
  `is_trash` int NULL DEFAULT NULL COMMENT '0. aktif 1. deleted',
  `created_at` datetime NULL DEFAULT NULL,
  `created_by` int NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  `updated_by` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `laracms.users`  (
  `id` int NOT NULL,
  `role` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pict` varchar(255) NULL DEFAULT 'src/media/avatars/blank.png',
  `email_verified_at` datetime NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) NULL DEFAULT NULL,
  `is_trash` int NULL DEFAULT 0 COMMENT '0. aktif 1. deleted',
  `created_at` datetime NULL DEFAULT NULL,
  `created_by` int NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  `updated_by` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `users_email_unique`(`email`)
);

ALTER TABLE `laracms.sys_menu` ADD CONSTRAINT `_copy_2` FOREIGN KEY (`group_menu`) REFERENCES `laracms.sys_menu_group` (`id`);
ALTER TABLE `laracms.sys_permissions` ADD FOREIGN KEY (`id_menu`) REFERENCES `laracms.sys_menu` (`id`);
ALTER TABLE `laracms.sys_permissions` ADD CONSTRAINT `_copy_3` FOREIGN KEY (`role_id`) REFERENCES `laracms.user_groups` (`id`);
ALTER TABLE `laracms.users` ADD CONSTRAINT `_copy_1` FOREIGN KEY (`role`) REFERENCES `laracms.user_groups` (`id`);

