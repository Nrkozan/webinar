/*
 Navicat Premium Data Transfer

 Source Server         : local
 Source Server Type    : MySQL
 Source Server Version : 100411
 Source Host           : localhost:3306
 Source Schema         : webinar

 Target Server Type    : MySQL
 Target Server Version : 100411
 File Encoding         : 65001

 Date: 09/06/2020 18:45:24
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for ci_sessions
-- ----------------------------
DROP TABLE IF EXISTS `ci_sessions`;
CREATE TABLE `ci_sessions`  (
  `id` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `data` blob NOT NULL,
  INDEX `ci_sessions_timestamp`(`timestamp`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for records
-- ----------------------------
DROP TABLE IF EXISTS `records`;
CREATE TABLE `records`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `recordID` longtext CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `meetingID` longtext CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `internalMeetingID` longtext CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `name` longtext CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `state` longtext CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `startTime` longtext CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `endTime` longtext CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `participants` longtext CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `size` longtext CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `length` longtext CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `url` longtext CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `mp4` longtext CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `server_name` longtext CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `api` longtext CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `server` longtext CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `context` longtext CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `downloads` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3436 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for server
-- ----------------------------
DROP TABLE IF EXISTS `server`;
CREATE TABLE `server`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` longtext CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `bbb_url` longtext CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `bbb_secret` longtext CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `base_url` longtext CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `active` tinyint(1) NULL DEFAULT NULL,
  `owner` varchar(16) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `mail` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `level` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `staff` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `token` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `google_id` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 39 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for user_server
-- ----------------------------
DROP TABLE IF EXISTS `user_server`;
CREATE TABLE `user_server`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) NULL DEFAULT NULL,
  `server` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 25 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

SET FOREIGN_KEY_CHECKS = 1;
