
/**
 * 保存用户信息的数据库表
 */
CREATE TABLE `wechats` (
    `id`          int NOT NULL AUTO_INCREMENT,
    `openid`      varchar(28) NOT NULL DEFAULT '' COMMENT 'openid',
    `unionid`     varchar(28) NOT NULL DEFAULT '' COMMENT 'unionid',
    `nickname`    varchar(32) CHARACTER SET utf8mb4 NOT NULL DEFAULT '' COMMENT '昵称 特殊符号',
    `gender`      enum('M','F','N') DEFAULT NULL DEFAULT 'N' COMMENT '性别',
    `country`     varchar(32) NOT NULL DEFAULT '' COMMENT '国家',
    `province`    varchar(32) NOT NULL DEFAULT '' COMMENT '省份',
    `city`        varchar(32) NOT NULL DEFAULT '' COMMENT '城市',
    `avatar`      varchar(128) NOT NULL DEFAULT '' COMMENT '头像',
    `created_at`  timestamp NULL DEFAULT NULL,
    `updated_at`  timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `openid` (`openid`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
