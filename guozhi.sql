-- MySQL dump 10.13  Distrib 5.5.43, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: zhier
-- ------------------------------------------------------
-- Server version	5.5.43-0ubuntu0.14.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `username` varchar(255) NOT NULL COMMENT '用户',
  `password` varchar(255) NOT NULL COMMENT '密码',
  `permission` varchar(255) NOT NULL COMMENT '权限',
  PRIMARY KEY (`user_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES (1,'admin','7fd011e6b5e1dff900631490de5bb576','1');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fruit`
--

DROP TABLE IF EXISTS `fruit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fruit` (
  `fruit_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `type_id` int(11) NOT NULL COMMENT '分类',
  `name` varchar(255) NOT NULL COMMENT '名称',
  `redname` varchar(255) NOT NULL COMMENT '红色名称（活动）',
  `price` varchar(255) NOT NULL COMMENT '价钱',
  `pic` varchar(255) NOT NULL COMMENT '列表展示图',
  `picbig` varchar(255) NOT NULL COMMENT '详情页大图',
  `order` int(11) NOT NULL COMMENT '排序',
  `views` int(11) NOT NULL COMMENT '浏览量',
  `buys` int(11) NOT NULL COMMENT '购买量',
  `comments` int(11) NOT NULL COMMENT '评论数',
  `intro` varchar(255) NOT NULL COMMENT '简介',
  `detail` text NOT NULL COMMENT '详情',
  `ctime` int(11) NOT NULL COMMENT '创建时间',
  `utime` int(11) NOT NULL COMMENT '修改时间',
  `start` varchar(255) NOT NULL DEFAULT '★★★★★',
  `chengfen_name_1` varchar(255) NOT NULL DEFAULT '水',
  `chengfen_bfb_1` varchar(255) NOT NULL DEFAULT '40%',
  `chengfen_name_2` varchar(255) NOT NULL DEFAULT '西瓜',
  `chengfen_bfb_2` varchar(255) NOT NULL DEFAULT '40%',
  `chengfen_name_3` varchar(255) NOT NULL DEFAULT '牛奶',
  `chengfen_bfb_3` varchar(255) NOT NULL DEFAULT '20%',
  `recommend` int(2) NOT NULL DEFAULT '0' COMMENT '0未推荐，1已推荐',
  PRIMARY KEY (`fruit_id`),
  KEY `name` (`name`,`price`,`order`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fruit`
--

LOCK TABLES `fruit` WRITE;
/*!40000 ALTER TABLE `fruit` DISABLE KEYS */;
INSERT INTO `fruit` VALUES (2,1,'Rootbeer 乐啤露','ROYALLEN和FRANK WRIGHT在1919年从一位药剂师手里买到了一种草本饮料的秘方，而这种饮料打气后泡沫特别多，口感极像啤酒（西方人喝啤酒讲究泡沫、口感），但无酒精而且是市场上最接近全天然的饮料。','19','/product/2015-07-31-16-02-33-600s.jpg','/product/2015-07-31-16-02-33-600b.jpg',7,4,30,0,'草本饮料','乐啤露口味适中，清新怡人，上班加班必备良药<br />',1426387448,1438332589,'★★★★★','水（天然水分）','299克','阳光（热量）','185大卡','生命（碳水化合物）','51克',0),(5,2,'Paris Kiss 巴黎之吻','','37','/product/2015-07-28-14-07-49-368s.jpg','/product/2015-07-28-14-07-49-368b.jpg',8,4,18,0,' 芒果+苹果','<p>\r\n	巴黎之吻 芒果+苹果 精选美八苹果，香味浓郁天然抗氧化； 佛罗里达凯特芒，外甜内酸； MIX 7:3 促进消化首选。\r\n</p>',1426387448,1438682524,'★★★★☆','水（天然水分）','427克','阳光（热量）','259大卡','生命（碳水化合物）','64克',1),(7,2,'My Hat 帽帽','','32','/product/2015-07-28-14-15-08-507s.jpg','/product/2015-07-28-14-15-08-507b.jpg',7,4,0,0,'奇异果+菠菜','<p>\r\n	帽帽 奇异果+菠菜 一颗小小奇异果就能拥有等量的膳食纤维； 蔬菜界的“营养模范生” 富含胡萝卜素、维生素C、维生素K、矿物质（钙质、铁质等）、辅酶Q10等多种营养素； MIX 8:2 促进肠胃蠕动，换回一身轻松。\r\n</p>',1426387448,1438682566,'★★★★☆','水（天然水分）','205克','阳光（热量）','148大卡','生命（碳水化合物）','35克',0),(8,1,'Ginger Ale 干姜水','甜的口感加上柠檬皮的清香味道，让人感觉有点鲜美，口感独特，回味悠长','17','/product/2015-07-31-16-03-15-155s.jpg','/product/2015-07-31-16-03-15-155b.jpg',6,4,9,0,'中药干姜','中药干姜是姜科植物姜根茎的干燥品。中医认为干姜有温中散寒，温肺化痰的功效与作用<br />',1426387448,1438959720,'★★★★★','水（天然水分）','344克','阳光（热量）','163大卡','生命（碳水化合物）','39克',1),(9,1,'Lemonade 柠檬那嘚','口味酸甜，适于在夏天饮用','16','/product/2015-07-31-16-00-34-611s.jpg','/product/2015-07-31-16-00-34-611b.jpg',8,4,96,0,'柠檬','<br />\r\n<p>\r\n	<br />\r\n</p>',1426387448,1438332517,'★★★★★','水（天然水分）','391克','阳光（热量）','37大卡','生命（碳水化合物）','6克',1),(15,2,'Weed杂草','','32','/product/2015-07-28-14-36-12-873s.jpg','/product/2015-07-28-14-36-12-873b.jpg',6,0,0,0,'哈密瓜+黄瓜','<p>\r\n	笑喵 哈密瓜+黄瓜 “瓜中之王”含糖量15%，果肉甜度让你 分分钟掉落蜜罐； 水果黄瓜含水量高达96％～98％，口感清爽，清热解毒； MIX 6:4 最甜蜜的水果美容法。\r\n</p>',1431177445,1439518389,'★★★★★','水（天然水分）','219克','阳光（热量）','78大卡','生命（碳水化合物）','18克',0),(16,4,'Green Milktea 茉香奶绿','','27','/product/2015-07-31-16-28-07-312s.jpg','/product/2015-07-31-16-28-07-312b.jpg',3,0,15,0,'','阿里山茉香奶绿，选用当年台湾高山产茉莉花绿茶，作为原茶基底，遵循传统工艺造就，色泽淡雅，花香绵长。',1431605996,1438333433,'★★★★★','水（天然水分）','380克','阳光（热量）','183大卡','生命（碳水化合物）','20克',0),(17,4,'Black Milktea 皇家醇红','','26','/product/2015-07-31-16-27-21-902s.jpg','/product/2015-07-31-16-27-21-902b.jpg',4,0,0,0,'','<p>\r\n	承传台湾本土奶茶制作工艺，尽显台湾奶茶原滋原味，将正宗台湾小吃的健康的养生理念，融入到日常茶饮中。\r\n</p>',1431606057,1438335098,'★★★★★','水（天然水分）','379克','阳光（热量）','183大卡','生命（碳水化合物）','21克',0),(18,1,'Moutain Dew 激浪','','14','/product/2015-07-31-16-03-50-131s.jpg','/product/2015-07-31-16-03-50-131b.jpg',4,0,5,0,'','激浪，浪，浪，浪',1436532288,1438332703,'★★★★★','水（天然水分）','357克','阳光（热量）','215大卡','生命（碳水化合物）','53克',0),(19,1,'Fresprint 香碧','','14','/product/2015-07-31-16-05-22-261s.jpg','/product/2015-07-31-16-05-22-261b.jpg',1,0,5,0,'','雪碧一出，谁与争锋',1436967855,1438332868,'★★★★★','水（天然水分）','348克','阳光（热量）','188大卡','生命（碳水化合物）','44克',0),(20,1,'Lemon Coke 柠乐','','12','/product/2015-07-31-16-04-48-982s.jpg','/product/2015-07-31-16-04-48-982b.jpg',2,0,0,0,'','柠乐一开，好事自然来',1436968073,1438332791,'★★★★★','水（天然水分）','370克','阳光（热量）','179大卡','生命（碳水化合物）','44克',0),(21,1,'Kiwi Soda 忌廉汽水','','20','/product/2015-07-31-16-04-19-573s.jpg','/product/2015-07-31-16-04-19-573b.jpg',3,0,0,0,'','忌廉汽水，喝了变王子，威廉的，18',1436968245,1438332745,'★★★★★','水（天然水分）','394克','阳光（热量）','225大卡','生命（碳水化合物）','56克',0),(22,1,'Dr. Pepper 胡椒博士','','17','/product/2015-08-04-18-01-53-542s.jpg','',5,0,0,0,'','',1438065447,1438682513,'★★★★★','水（天然水分）','319克','阳光（热量）','174大卡','生命（碳水化合物）','46克',0),(23,2,'Summer Wind 夏日的风','','38','/product/2015-07-28-14-42-14-301s.jpg','/product/2015-07-28-14-42-14-301b.jpg',5,0,3,0,'苹果+凤梨+奇异果','夏日的风 奇异果+凤梨+苹果 精选美八苹果，香味浓郁天然抗氧化； 果肉金黄，汁多味甜；捣烂绞汁后清热生津； 一颗小小奇异果就能拥有等量的膳食纤维； MIX 1:1:1 增加食欲的同时促进血液循环酶降低血压。',1438065734,1438682631,'★★★★★','水（天然水分）','250克','阳光（热量）','149大卡','生命（碳水化合物）','37克',0),(24,2,'Love Affair 爱的小事','','31','/product/2015-07-28-14-47-30-279s.jpg','/product/2015-07-28-14-47-30-279b.jpg',4,0,0,0,'梨子+桂花蜜','爱的小事 梨+桂花蜜 三水梨之一，富含B族维生素，含糖量高达16%口感极佳； 采自深山老林冬天开花泌蜜的野桂花花蜜，香气馥郁温馨、清纯优雅； MIX 8:2 每日一杯，增强心肌活力。',1438066050,1439370818,'★★★★★','水（天然水分）','254克','阳光（热量）','301大卡','生命（碳水化合物）','67克',0),(25,2,'Coco Channel 喔椰','','32','/product/2015-08-04-14-28-13-364s.jpg','',3,0,0,0,'椰子','喔椰 泰国椰子 一整颗椰子 \"养生第一果汁\"，解渴祛暑、生津利尿、祛风、驱毒、有益气、润颜。',1438066371,1438682683,'★★★★★','水（天然水分）','361克','阳光（热量）','204大卡','生命（碳水化合物）','26克',0),(26,2,'Lost Star 丢丢星','','36','/product/2015-07-28-14-58-06-863s.jpg','/product/2015-07-28-14-58-06-863b.jpg',2,0,0,0,'橙子+火龙果','丢丢星 橙子+火龙果 花青素含量最高的火龙果，抗氧化、抗自由基、抗衰老； 口感酸甜多汁，抗癌佳果； MIX &nbsp;3:7 排毒护胃解油腻。',1438066686,1438682713,'★★★★★','水（天然水分）','326克','阳光（热量）','181大卡','生命（碳水化合物）','43克',0),(27,2,'Manjusaka 曼珠沙华','','33','/product/2015-07-28-15-08-05-935s.jpg','/product/2015-07-28-15-08-05-935b.jpg',1,0,0,0,'凤梨+西瓜','曼珠沙华 菠萝+西瓜 精选墨童瓜，果肉鲜红纤维少，质细爽口； 果肉金黄，汁多味甜；捣烂绞汁后清热生津； MIX 6:4 清爽此时此刻。',1438067285,1438682739,'★★★★★','水（天然水分）','552克','阳光（热量）','183大卡','生命（碳水化合物）','42克',0),(28,4,'Lemon Tea 激爽红茶','','22','/product/2015-07-31-16-29-51-223s.jpg','/product/2015-07-31-16-29-51-223b.jpg',1,0,0,0,'','',1438068421,1438333527,'★★★★★','水（天然水分）','265克','阳光（热量）','85大卡','生命（碳水化合物）','16克',0),(29,4,'Oolong Milktea 乌龙奶茶','','28','/product/2015-07-31-16-29-23-487s.jpg','/product/2015-07-31-16-29-23-487b.jpg',7,0,0,0,'','<p>\r\n	日月潭乌龙奶茶，采用产自台湾的优质冻顶乌龙原茶冲泡，加入香浓鲜奶调制，成就绝美味道。茶香清雅，口感馥郁。\r\n</p>',1438070324,1439518623,'★★★★★','水（天然水分）','379克','阳光（热量）','183大卡','生命（碳水化合物）','20克',1),(30,2,'Simple Orange傻桔子  ','','26.4','','',9,0,0,0,' 美橙+香蕉','',1439518713,1439518713,'★★★★★','水','','阳光（热量）','','生命（碳水化合物）','',0),(31,2,'Broken Heart糟心','','28','','',10,0,0,0,'凤梨+梨子','',1439518952,1439519835,'★★★★★','水（天然水分）','','阳光（热量）','','生命（碳水化合物）','',0),(32,2,'','','','','',-1,0,0,0,'','',1439519083,1439519814,'★★★★★','','','','','','',0),(33,2,'St. Pat·s Day爱尔兰国庆','','28','','',10,0,0,0,'凤梨+香瓜','',1439519174,1439519739,'★★★★★','水（天然水分）','','阳光（热量）','','生命（碳水化合物）','',0),(34,4,'Matcha Milktea抹茶奶茶','','22.4','','',8,0,50,0,'抹茶奶茶','',1439519338,1439519338,'★★★★★','水（天然水分）','','阳光（热量）','','生命（碳水化合物）','',0),(35,1,'Glass Fruit卜梨果','','29.6','','',0,0,0,0,'胡萝卜+凤梨+苹果','',1439519490,1439519650,'★★★★★','水（天然水分）','','阳光（热量）','','生命（碳水化合物）','',0),(36,2,'Glass Fruit卜梨果','','29.6','','',10,0,0,0,'胡萝卜+凤梨+苹果','',1439519885,1439519918,'★★★★★','水（天然水分）','','阳光（热量）','','生命（碳水化合物）','',0),(37,2,'Bitter Sweet生活','','30.4','','',10,0,0,0,'柚子+橙子+蜂蜜','',1439520051,1439520067,'★★★★★','水（天然水分）','','阳光（热量）','','生命（碳水化合物）','',0),(38,2,'Pussy小喵豆 ','','27.2','','',10,0,0,0,'西红柿+苹果','',1439520187,1439520196,'★★★★★','水（天然水分）','','阳光（热量）','','生命（碳水化合物）','',0),(39,4,'Turbulent Beads动感晶露 ','','22.4','','',9,0,0,0,'黑糖小丸子奶茶','',1439520394,1439520402,'★★★★★','水（天然水分）','','阳光（热量）','','生命（碳水化合物）','',0),(40,4,'Dream思豆燕奶 ','','22.4','','',10,0,0,0,'相思红豆燕麦奶茶','',1439520626,1439520636,'★★★★★','水（天然水分）','','阳光（热量）','','生命（碳水化合物）','',0),(41,4,'Grass Jelly台湾精熬烧仙草','','21.6','','',11,0,0,0,'台湾精熬烧仙草','',1439520905,1439520905,'★★★★★','水（天然水分）','','阳光（热量）','','生命（碳水化合物）','',0),(42,4,'Ice Chips夏日豆冰','','30.4','','',10,0,0,0,'夏日豆冰','',1439521094,1439521105,'★★★★★','水（天然水分）','','阳光（热量）','','生命（碳水化合物）','',0),(43,4,'Milk Shake冰激凌奶昔','','29.6','','',10,0,0,0,'冰激凌奶昔','',1439521230,1439521287,'★★★★★','水（天然水分）','','阳光（热量）','','生命（碳水化合物）','',0);
/*!40000 ALTER TABLE `fruit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fruit_addinfo`
--

DROP TABLE IF EXISTS `fruit_addinfo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fruit_addinfo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fruit_id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `price` int(11) NOT NULL,
  `display_order` int(4) NOT NULL DEFAULT '1' COMMENT '排序，越大越靠前，0为删除',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=107 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fruit_addinfo`
--

LOCK TABLES `fruit_addinfo` WRITE;
/*!40000 ALTER TABLE `fruit_addinfo` DISABLE KEYS */;
INSERT INTO `fruit_addinfo` VALUES (1,2,'薄荷',0,3),(2,2,'姜丝',0,2),(3,2,'1',0,0),(8,8,'姜丝',0,2),(9,7,'',0,0),(10,7,'去掉菠菜',0,1),(11,7,'删我啊',0,0),(12,9,'原味',0,4),(13,16,'去冰冰镇',0,4),(14,17,'去冰冰镇',0,4),(15,17,'含冰冰镇',0,3),(16,7,'',0,0),(17,15,'加柠檬片',0,0),(18,15,'加柠檬片',0,0),(19,15,'',0,0),(20,15,'加柠檬片',0,0),(21,15,'加柠檬片',0,3),(22,15,'加柠檬汁',0,2),(23,15,'去掉黄瓜',0,1),(24,23,'菠萝榨（清流w/o Pulp）',0,1),(25,23,'菠萝搅（沉淀w/ Pulp）',0,2),(26,24,'0',0,0),(27,24,'0',0,0),(28,24,'0',0,0),(29,25,'杯装',0,2),(30,25,'椰装',0,1),(31,26,'0',0,0),(32,26,'0',0,0),(33,26,'0',0,0),(34,26,'0',0,0),(35,27,'加柠檬片',0,5),(36,27,'加柠檬汁',0,4),(37,27,'加薄荷',0,3),(38,27,'菠萝榨（清流w/o Pulp）',0,1),(39,27,'菠萝搅（沉淀 w/ Pulp）',0,2),(40,9,'黄瓜（清爽）',0,3),(41,9,'雪碧（甜爽）',0,2),(42,9,'双倍柠檬（酸爽）',0,1),(43,28,'去冰冰镇',0,4),(44,28,'含冰冰镇',0,3),(45,28,'常温',0,2),(46,28,'热',0,1),(47,8,'Plain原味',0,1),(48,22,'薄荷',0,3),(49,22,'姜丝',0,2),(50,22,'Plain原味',0,1),(51,18,'百香果',0,3),(52,18,'姜丝',0,2),(53,18,'Plain原味',0,1),(54,21,'奇异果切丁',0,3),(55,21,'奇异果搅',0,2),(56,21,'Plain原味',0,1),(57,20,'姜丝',0,2),(58,20,'Plain原味',0,1),(59,19,'青桔',0,2),(60,19,'柠檬',0,1),(61,17,'常温',0,2),(62,17,'热',0,1),(63,16,'含冰冰镇',0,3),(64,16,'常温',0,2),(65,16,'热',0,1),(66,29,'去冰',0,4),(67,29,'含冰冰镇',0,3),(68,29,'常温',0,2),(69,29,'热',0,1),(70,30,'Plain原味',0,2),(71,30,'醇橙汁（去掉香蕉）',0,1),(72,31,'Plain原味',0,3),(73,31,'+柠檬片',0,2),(74,31,'+柠檬汁',0,1),(75,33,'Plain原味',0,3),(76,33,'+柠檬片',0,2),(77,33,'+柠檬汁',0,1),(78,34,'去冰冰镇',0,4),(79,34,'含冰冰镇',0,3),(80,34,'常温',0,2),(81,34,'热',0,1),(82,36,'菠萝榨（清流）',0,2),(83,36,'菠萝搅（沉淀）',0,1),(84,37,'Plain原味',0,2),(85,37,'去掉蜂蜜',0,1),(86,38,'Plain原味',0,4),(87,38,'+柠檬片',0,3),(88,38,'+柠檬汁',0,2),(89,38,'+胡萝卜(榨）',0,1),(90,39,'去冰冰镇',0,4),(91,39,'含冰冰镇',0,3),(92,39,'常温',0,2),(93,39,'热',0,1),(94,40,'去冰冰镇',0,4),(95,40,'含冰冰镇',0,3),(96,40,'常温',0,2),(97,40,'热',0,1),(98,41,'Plain原味',0,3),(99,41,'黑糖',0,2),(100,41,'抹茶',0,1),(101,42,'抹茶红豆冰',0,3),(102,42,'牛奶红豆冰',0,2),(103,42,'花生牛奶冰',0,1),(104,43,'香草',0,3),(105,43,'巧克力',0,2),(106,43,'芒果',0,1);
/*!40000 ALTER TABLE `fruit_addinfo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fruit_type`
--

DROP TABLE IF EXISTS `fruit_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fruit_type` (
  `type_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `order` int(11) NOT NULL COMMENT '排序',
  `name` varchar(255) NOT NULL COMMENT '分配名',
  `coupon_name` varchar(255) DEFAULT NULL COMMENT '优惠券名字',
  PRIMARY KEY (`type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fruit_type`
--

LOCK TABLES `fruit_type` WRITE;
/*!40000 ALTER TABLE `fruit_type` DISABLE KEYS */;
INSERT INTO `fruit_type` VALUES (1,2,'创意碳酸','碳酸券'),(2,3,'鲜榨果汁','果汁券'),(4,1,'咖啡奶茶','咖啡券');
/*!40000 ALTER TABLE `fruit_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `location_office`
--

DROP TABLE IF EXISTS `location_office`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `location_office` (
  `office_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '办公楼ID',
  `office_name` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT '名称',
  `search_word` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT '搜索哪些关键字，会出来',
  `area_id` int(11) NOT NULL COMMENT '所属区域',
  PRIMARY KEY (`office_id`),
  KEY `office_name` (`office_name`,`search_word`,`area_id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `location_office`
--

LOCK TABLES `location_office` WRITE;
/*!40000 ALTER TABLE `location_office` DISABLE KEYS */;
INSERT INTO `location_office` VALUES (35,'BTV北京电视台','BTV北京电视台',0),(16,'CBD国际大厦','CBD国际大厦',0),(2,'LG双子座大厦','LG双子座大厦',0),(28,'Metropolis大都会','Metropolis大都会',0),(31,'Metropolis大都会','Metropolis大都会',0),(32,'Metropolis大都会','Metropolis大都会',0),(17,'SK大厦','SK大厦',0),(6,'万豪国际公寓','万豪国际公寓',0),(21,'中国人保财险大厦','中国人保财险大厦',0),(25,'中国惠普大厦','中国惠普大厦',0),(36,'中国惠普大厦','中国惠普大厦',0),(18,'中环世贸中心','中环世贸中心',0),(27,'中航工业大厦','中航工业大厦',0),(38,'丰树大厦','丰树大厦',0),(13,'丽晶苑','丽晶苑',0),(26,'京汇大厦','京汇大厦',0),(10,'北京IFC大厦','北京IFC大厦',0),(9,'北京国际财源中心','北京国际财源中心',0),(20,'北京银泰中心','北京银泰中心',0),(34,'北大写字楼','北大写字楼',0),(12,'华彬中心','华彬中心',0),(3,'外贸建外办公大楼','外贸建外办公大楼',0),(14,'安邦金融中心','安邦金融中心',0),(22,'建外SOHO东区','建外SOHO东区',0),(15,'建外SOHO西区','建外SOHO西区',0),(33,'恋日国际','恋日国际',0),(24,'招商局大厦','招商局大厦',0),(4,'日晟商务中心','日晟商务中心',0),(23,'柏悦府','柏悦府',0),(5,'永安东里','永安东里',0),(37,'海航实业大厦','海航实业大厦',0),(29,'瑞赛商务楼','瑞赛商务楼',0),(11,'米阳大厦','米阳大厦',0),(1,'艺嘉大厦','艺嘉大厦',0),(30,'艾维克大厦','艾维克大厦',0),(7,'通用国际中心','通用国际中心',0),(8,'通用时代国际公寓','通用时代国际公寓',0),(19,'银泰写字楼','银泰写字楼',0);
/*!40000 ALTER TABLE `location_office` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `opinion`
--

DROP TABLE IF EXISTS `opinion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `opinion` (
  `opinion_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '意见ID',
  `user_id` int(11) NOT NULL COMMENT '用户ID',
  `status` int(2) NOT NULL DEFAULT '0' COMMENT '1 已回复，0未回复',
  `question` varchar(255) NOT NULL COMMENT '问题',
  `answer` varchar(255) NOT NULL COMMENT '回答',
  `qtime` varchar(255) NOT NULL COMMENT '提问时间',
  `rtime` varchar(255) NOT NULL COMMENT '回答时间',
  PRIMARY KEY (`opinion_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `opinion`
--

LOCK TABLES `opinion` WRITE;
/*!40000 ALTER TABLE `opinion` DISABLE KEYS */;
/*!40000 ALTER TABLE `opinion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order`
--

DROP TABLE IF EXISTS `order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '订单ID',
  `user_id` int(11) NOT NULL COMMENT '用户ID',
  `status` int(11) NOT NULL COMMENT '状态 1已下单，2制作中，3配送中，4已送达',
  `price` varchar(255) NOT NULL COMMENT '价钱',
  `ctime` int(11) NOT NULL COMMENT '创建时间',
  `sendtime` varchar(255) NOT NULL,
  `etime` int(11) NOT NULL COMMENT '完成时间',
  `to_name` varchar(255) NOT NULL COMMENT '收货人',
  `to_mobile` varchar(255) NOT NULL COMMENT '收货人手机',
  `to_location` varchar(255) NOT NULL,
  `to_location_detail` varchar(255) NOT NULL COMMENT '收货人详细地址',
  `iscommend` int(2) NOT NULL DEFAULT '0' COMMENT '是否评论，0否，1是',
  PRIMARY KEY (`order_id`),
  KEY `user_id` (`user_id`,`status`)
) ENGINE=InnoDB AUTO_INCREMENT=12466 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order`
--

LOCK TABLES `order` WRITE;
/*!40000 ALTER TABLE `order` DISABLE KEYS */;
INSERT INTO `order` VALUES (12463,109,4,'12',1439438800,'0',0,'时间','13596963636','3','测试订单 无需配送',0),(12464,106,4,'12',1439517616,'0',0,'隋小波','13901234567','6','嘿',0),(12465,109,4,'29',1439517824,'0',0,'时间','13596963636','3','测试订单 无需配送',0);
/*!40000 ALTER TABLE `order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_detail`
--

DROP TABLE IF EXISTS `order_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_detail` (
  `order_detail_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '详情ID',
  `order_id` int(11) NOT NULL COMMENT '对应的订单ID',
  `fruit_id` int(11) NOT NULL COMMENT '购买的产品',
  `fruit_name` varchar(255) NOT NULL COMMENT '产品名称',
  `buys` int(11) NOT NULL COMMENT '购买数量',
  `fruit_version` int(11) NOT NULL COMMENT '产品版本（每次更新产品信息，应生成新版）',
  `price` varchar(255) NOT NULL COMMENT '购买价钱',
  `addinfo` varchar(255) NOT NULL COMMENT '附加条件',
  `addname` varchar(255) DEFAULT NULL,
  `commend_status` int(2) NOT NULL DEFAULT '0' COMMENT '0未评价，1未回复，2已隐藏，3已回复',
  `commend` varchar(255) NOT NULL DEFAULT '0' COMMENT '评论',
  `rcommend` varchar(255) NOT NULL DEFAULT '' COMMENT '回复评论',
  PRIMARY KEY (`order_detail_id`)
) ENGINE=InnoDB AUTO_INCREMENT=386 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_detail`
--

LOCK TABLES `order_detail` WRITE;
/*!40000 ALTER TABLE `order_detail` DISABLE KEYS */;
INSERT INTO `order_detail` VALUES (383,12463,9,'Lemonade 柠檬那嘚',1,0,'12','','',0,'0',''),(384,12464,9,'Lemonade 柠檬那嘚',1,0,'12','','',0,'0',''),(385,12465,5,'Paris Kiss 巴黎之吻',1,0,'29','','',0,'0','');
/*!40000 ALTER TABLE `order_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `share_coupon`
--

DROP TABLE IF EXISTS `share_coupon`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `share_coupon` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(400) CHARACTER SET utf8 DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  `ctime` timestamp NULL DEFAULT NULL,
  `utime` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `num` int(11) DEFAULT NULL,
  `used` int(11) DEFAULT '0' COMMENT '用量',
  `value` int(11) DEFAULT '2' COMMENT '金额',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `share_coupon`
--

LOCK TABLES `share_coupon` WRITE;
/*!40000 ALTER TABLE `share_coupon` DISABLE KEYS */;
INSERT INTO `share_coupon` VALUES (8,'快来抢，健康就在汁儿！',0,'2015-08-06 12:38:22','2015-08-07 10:00:24',340,33,3),(16,'时间 发汁儿的红包啦，快来抢！',12463,'2015-08-14 01:13:19','2015-08-14 01:13:19',3,0,2);
/*!40000 ALTER TABLE `share_coupon` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `share_coupon_code`
--

DROP TABLE IF EXISTS `share_coupon_code`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `share_coupon_code` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `coupon_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `value` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `get_time` timestamp NULL DEFAULT NULL,
  `use_time` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `share_coupon_code`
--

LOCK TABLES `share_coupon_code` WRITE;
/*!40000 ALTER TABLE `share_coupon_code` DISABLE KEYS */;
/*!40000 ALTER TABLE `share_coupon_code` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '用户ID',
  `wei_id` varchar(255) NOT NULL COMMENT '用户微信ID',
  `name` varchar(255) NOT NULL COMMENT '姓名',
  `mobile` varchar(11) NOT NULL DEFAULT '' COMMENT '电话',
  `face` varchar(255) DEFAULT '0' COMMENT '头像',
  `ctime` int(11) NOT NULL COMMENT '创建时间',
  `ltime` int(11) NOT NULL COMMENT '登录时间',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=163 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (106,'oWeLOvneJ6xRythTnGkX8vudDcVM','隋小波','','http://wx.qlogo.cn/mmopen/yzjCYdRsEuhFctWmH5X0or5FHU9ICibIFa7vZInBNt0AxG8YfYGC8mkY3nlltlzafUncTI5YvfTP2qKqibCJ4Uia5ZPnb16kzDa/0',1435493825,1439517524),(107,'oWeLOvsHXNNmTp5r31KxQ_4oRFK0','IL瑞','','http://wx.qlogo.cn/mmopen/rjdt7ddDxvTWUAngs2m1gNdibPGLX4QIicLmgBKiadtn7cEAWFaneFp0qpF4AlGA6srjHLrykJmjsQDxycibM4yia1GZS7IdzKZUR/0',1435495113,1435500283),(108,'oWeLOvka0ww9L8bZ60ANm9azi8sw','白米粥小姐','','http://wx.qlogo.cn/mmopen/PiajxSqBRaEJzbO0vVbPFDVQGDxIVPl8nQRHOWsaerjribpyB7emVzRChJ5efb6Dybmzj6g3Y10hu4BZjWUaxk2Q/0',1435495313,1439454281),(109,'oWeLOvmrNmL4_D0dyClUzSdpusTg','时间','','http://wx.qlogo.cn/mmopen/rjdt7ddDxvQLE7JBxcWOd4hRI4yicuHL14zkjACWa0IVdqh54ZibWdt6kpQ5010u1rQxRlYNGsI7QzgcCjy6ibwW03R9GrK2GTH/0',1435495591,1439517799),(110,'oWeLOvuABuUyZRsB8tmrQ1yp93cM','Timmy','','http://wx.qlogo.cn/mmopen/Iic4Zx3iaYpibZWRVUnsSRyryZEicfZuC2xW5Sn8ib85gA1xPEWibBGGA5bCibOdk4ee2NCMnBetg4wI9IFXjHiaOgYIQg/0',1435495752,1439278458),(111,'oWeLOvpYkhNWAWvyppLYkuYoSM_U','Qianwen','','http://wx.qlogo.cn/mmopen/Iic4Zx3iaYpibZS6RCJxarsXNo7J8ykbO0l02ZiaCRK0QuXnx3lrZTlCvE1M5UqR0sVFad3icKjemZytN7f6xGC03dyqkeMMTt9pA/0',1435495778,1438419905),(112,'oWeLOvnArzQzXL0cu5Bw8UNd-SFU','八通','','http://wx.qlogo.cn/mmopen/Iic4Zx3iaYpibbPbGeDOm7X03NfxHJiapz4eB52kSqDtuaKusuWNR1bfy2OPZq4WEDl6oknqoEWibSGsNt9ITSs7BPd6ebice6qibyR/0',1435495785,1436530409),(113,'oWeLOvpLP_ItHBKhMA_PdAOfUpV4','刘萱','','http://wx.qlogo.cn/mmopen/Iic4Zx3iaYpibZS6RCJxarsXGUSmlbRicRSlQEmibJic8qbWOxjYX2SEoVtk9CaeoNCIdPHNxanAEvPUWn5vTpYtesleH3unTzxFHK/0',1435495786,1439106299),(114,'oWeLOvnfkTZ_79eX7eK369LH9kBk','Chloe','','http://wx.qlogo.cn/mmopen/TLITua63TibuAugUHVSGiabysN1CWicA7YYz082wqM9ypS9Kuumn3qicP8Yic3a1IxSGFyMbTe8icuHTibzBsOZJOwfET0M1agHFiaTm/0',1435495796,1435495946),(115,'oWeLOvnBBe5lUsklD0_-pnMkr5Fc','MLi','','http://wx.qlogo.cn/mmopen/rjdt7ddDxvQLE7JBxcWOd4kOwIOibI7N2upayH9e9xRUeNPxg4XMljzSib774ZILpZ47wy8om8cc3skOnIicNcicT1YrZGMMrNeV/0',1435495822,1438941616),(116,'oWeLOvlMKzUfqjwaZnPPclN97BRc','B.M.','','http://wx.qlogo.cn/mmopen/7N2JRaWooRAUUlOgLpmrib84195jzuVom4sdVGNnib1nLF38rj0e8iaRwaYXAviafepD4ed808RXFl2eFmht05CfYMrNw9XLDmTl/0',1435496556,1439005728),(117,'oWeLOvv1Atic6IE02EIxz2M04Rxk','张胖胖','','http://wx.qlogo.cn/mmopen/ajNVdqHZLLDh7dFMUibx8z6WSnbmicw5x9DskumhR15OcpstQvOeHrv9AjSFd6hBiaoAicwPpic8KHUuVyBEFuntJDg/0',1435498752,1435499127),(118,'oWeLOvhPNOqg-HFP2ud_80WibAWA','盆儿','','http://wx.qlogo.cn/mmopen/ajNVdqHZLLBWzTFNXewFFUaNtGeibhfj7KA1xr8W2PKJ6tdNTmDttSKVV5U84kTyIXaTNOBNSpAh37zOTF15nOA/0',1435500034,1438166878),(119,'oWeLOvmngkmIy_cYDa0iVHRNmc1k','24K猫女王 ','','http://wx.qlogo.cn/mmopen/rjdt7ddDxvQLE7JBxcWOdxXKG2zIJqlj15zPD44K5dmfRWOdPbMdrSmEnwd5z3aO4hCmtglJdp2Qp0aWGtDnJXkKlHeSnhpr/0',1435501021,1435501100),(120,'oWeLOvgiwUUbzGLHWRTy1EzgMeuo','小雨天凉','','http://wx.qlogo.cn/mmopen/Y6NTopEmn19q5SvicOuegSCUriaLK3TsJ86ZC8LRtBibd28qgOP9R3KQyX3L3yeUGSicY5QDs4u1FELvK7dN75zDjfwicwhZXujOw/0',1435503296,1435503355),(121,'oWeLOviZ5WDqi1kIBOBguiSoeTYU','中软国际JointForce平台','','http://wx.qlogo.cn/mmopen/7N2JRaWooRDicLEQic3Zhicc3l3IHK8LuxttHYOU7c363LPh3DukufkJuicHwY6vhndQzQQNBuxdSsE6VyibpbKIK5rkS2hZBdV40/0',1435548527,1435548527),(122,'oWeLOvsrYLq4NjkUncWUzgZSkcYQ','陈晓明','','http://wx.qlogo.cn/mmopen/7N2JRaWooRAUUlOgLpmrib1lr6YAQh34h54S8EvnCAc5M1IgHPhOOsXBMGdEUtceTc7gmiamaVn9M9nhtlvoaWYdCXQHxO15n7/0',1435554785,1435554785),(123,'oWeLOvj2nurI6LkRw9VsSCio2NsM','李想想','','http://wx.qlogo.cn/mmopen/aDolcicNgYzL0uzibdsiaE2jbcEqGFAyXqHdp2wIx7X1fpC9lLy4RxJuQn6pBx3MgYeVG94t1CkwoNnhiaSD0oUWW63DlwKJlibibD/0',1435572634,1439023131),(124,'oWeLOvuKus7n2MC6XA6n7NU9NWz8','西米黄文谋','','http://wx.qlogo.cn/mmopen/ajNVdqHZLLCfghTDOiauSVDibQ9eyP0Mfnlveicz0jBeb0Ycb7kHP1pd4FZrUkhu9Us4c2k2qJWOwmeYib4yx29Ihg/0',1435596946,1435596946),(125,'oWeLOvpO_NOPeXyOCo4U5J7hWs-U','金石','','http://wx.qlogo.cn/mmopen/aDolcicNgYzIrevNnP6yBBqf2JXDOobiaic4GOD7YUN9spicSRCYsFpQib9iaiaa8MUzoVZ7M4ibsM7ibLs6J9k5VlGz80QSlAR6QgHYI/0',1435629781,1435632254),(126,'oWeLOvigij3TJqL6dwxYMyVbFL4Q','紫墩','','http://wx.qlogo.cn/mmopen/PiajxSqBRaEL9LzHuGib7BynALSwhqHC63222sH6VI2LYib1FtANHllEGAv15iarKo9BkyibXtprBDyW2cq9XN6DibJg/0',1435674624,1435674624),(127,'oWeLOvvn2BZaocOZmkjozW4ucauQ','胡光远','','http://wx.qlogo.cn/mmopen/Iic4Zx3iaYpibZS6RCJxarsXM9bnE4a8ibyEF20YVgvGfLUmPDm9icELnYcoe6Bx381cHlhrqKmuKZplyTOKKNwfrWeGWpSPYtC0l/0',1435724634,1435724634),(128,'oWeLOvuwjQ2SJUlenNKaky7X3sw0','鲜品  水果切','','http://wx.qlogo.cn/mmopen/ajNVdqHZLLDZ41JChbMvcN8iazFwaWKeoQg5hhAxO8YcgiclL127XHsOzc4MHvDPsV3xOIp9f54ZkctH3UiakXFBQ/0',1435846783,1435882155),(129,'oWeLOvhlpbta5orPVwuIKyXFdfz8','I.Think.','','http://wx.qlogo.cn/mmopen/yzjCYdRsEuhFctWmH5X0onVyHcEl5NI9EZapmMZBWPgSicH2UK3xosgVonekUtH3WkSIs5ItSYLl22Ys1CoLicSkKJia9hqPnTz/0',1436018970,1437132501),(130,'oWeLOvl_Pge-nREiLSFQWsBQgKp8','yuan小玮','','http://wx.qlogo.cn/mmopen/Iic4Zx3iaYpibZS6RCJxarsXJX8Xd3lyDzdhqlibI0ibuGLn7P2fS0Not2LLrsmn1PIY0iaFffHjdtmvebYWapXZxJHhUbQ5ytqibAJ/0',1436446109,1436530593),(131,'oWeLOvlPCwvKyvDuH3xs4kYnv3Tg','婉茹','','',1436766544,1437119725),(132,'oWeLOviRXMr84Fxb_ZuO73TNLsUA','雾狸','','http://wx.qlogo.cn/mmopen/pzmqnzk1MpFEMocXia9GLhvcSn9NFoPcVrFTWGSt5d4vLRezMh1N4unNJgYwZmW0ZxuiaUMszibZo2KeuCRl6icLdg4QMIN8u3Dk/0',1436766618,1439474043),(133,'oWeLOvufLAEq7rvN52POQRM9aNwQ','王亚川@大数据','','http://wx.qlogo.cn/mmopen/Iic4Zx3iaYpibbfSvly1WnL66Wyd3IJ9KInRvkQx7hmciasomXb2kLmibrwWEyQibmnjhZU6nzawM6ibGHfJJ04ZvJaC1eea3pnMRno/0',1437128058,1437155032),(134,'oWeLOvrvg45FvMxQbUA4ZhZXJSHE','Willey','','http://wx.qlogo.cn/mmopen/rjdt7ddDxvTt9wrKgaDibZPyaNcs7c9ZE3TWibaJPRXrpXdp6sKfLo7kbcYXoicRuVibjb93ZjdvH2MfHg6ibgECdDffOVpEsoWSM/0',1437130376,1439289096),(135,'oWeLOvgK7QWwB8X9Kdu2TAYjYrR0','Vivian','','http://wx.qlogo.cn/mmopen/Iic4Zx3iaYpibZS6RCJxarsXL4Ey4fjNAR7A1iaA9azicMR3kqQ9fwwdZhOViaBgCmMgZzMZKvDb7ZhJXeGzbtLQJDJgXHn28X0iapg/0',1437132652,1437132652),(136,'oWeLOvqL1HQno2TD_84uUfFkTTTc','半成品。','','http://wx.qlogo.cn/mmopen/Iic4Zx3iaYpibZic31HyX03s77wIWTdASjxCpKUDbuIPqKvIDMoacx0tRib6auIQa0rbe0yYP8FibvdwJyvdhuKkM0ELHSQpXKujgc/0',1437143340,1438953811),(137,'oWeLOvtcp7ytnYNcmp3nPEFjRUos','倘若似水流年','','http://wx.qlogo.cn/mmopen/rjdt7ddDxvQLE7JBxcWOd3jdCHicuAUREDoBDFI9qXciaiaJatJqENOGg0Km7SxoicDDDDwUcHIpu63jribxZejZ6FPYuwajPtrNp/0',1437193801,1439518809),(138,'oWeLOvpl39rz6RFZsRQboZQn93Fg','  +  +  +  ','','http://wx.qlogo.cn/mmopen/Iic4Zx3iaYpibaDjYVv9pnuP9Fv7LAvVwwnR9pwlLz84rjrp8xb7qkUtDD7r3zZRDcm5a2U0O2eH4qWykApBMhFGicJkII1NHlKu/0',1437195723,1437391421),(139,'oWeLOvtAPds-jHTBhE1tuWZ1uprs','红小豆尹小媛','','http://wx.qlogo.cn/mmopen/Iic4Zx3iaYpibaZ2snC3aHzLBw69RFyxyXJbEWbnQ6pbhQXgs2bgOQ1Sube9ia8ZyJTsJ3xrkPWZzg1MagookKMc6NHewJDNq7y1/0',1437310998,1437310998),(140,'oWeLOvlE_Nld0YYvkXb4LaXVL5uo','赵凤','','http://wx.qlogo.cn/mmopen/Iic4Zx3iaYpibZS6RCJxarsXFVGRaAG7cIgWHaMDPDRJr6TzO1wtuWXOfHqoL3eUuOWibF1QdH2w8ySMcFhezcMlZoZwbraaxdGM/0',1437458681,1437458681),(141,'oWeLOvneIZjOy4QdqDv_NWkOGQZo','sheep.ly','','http://wx.qlogo.cn/mmopen/Iic4Zx3iaYpibZS6RCJxarsXKdia8v3LQibK4SkIThZmw4mTtfov4IuKgtwtmQUwsepZwnwknAk3WYMMhwDPD37libdaJYbY0q87vd/0',1437480260,1437564990),(142,'oWeLOvqou_iIylrAoyMl2eKRK_WQ','Joseph K','','http://wx.qlogo.cn/mmopen/rjdt7ddDxvR9k3EQDImPwdnmh6qahUllGMibn75qkvPU0PKUqaJc2V0QjJKBKqU4e9NAvLK9xzO0zTYNSY7KxoDEdyJB9ltYL/0',1437872109,1437872109),(143,'oWeLOvo5va2n9e_wzZ0bn5e9xz50','刘橙子:-)','','http://wx.qlogo.cn/mmopen/aDolcicNgYzIsaXLEZW6lWs5YRlKTOYXGogL5m5SKicg3cIdh0VSjtG3KxZU7ToI70ukC4ibqZRM2LAFpcBELK2eBiao29IOlvKv/0',1438009468,1438009468),(144,'oWeLOvldp21psFhimRxaxtZ9f8vM','陈铭丰-综合贷款融资','','http://wx.qlogo.cn/mmopen/aDolcicNgYzIP3FW2dzAxpnbXCialKDSpaEIT3UOAxyk57vs0wBB9J1HORb3T8p5tlelh0hViajIvbuACYh3Nic4BQ/0',1438246682,1438246682),(145,'oWeLOviCc_-4-eadzf7AOgdey-e4','','','http://wx.qlogo.cn/mmopen/ajNVdqHZLLDkibFHVGP3tZVx2pkhDw35nfIHUNTojSsEMPnJib2G6QgjG67gic3GTmKyttU23nZbZXnkToc1Pjyfg/0',1438406366,1438406366),(146,'oWeLOvkVqMpgpVM3k4O2zyE73LEU','warren','','http://wx.qlogo.cn/mmopen/PiajxSqBRaEJCrCND7PrbWJMjlibeX8rsVD47AjicSXelwE6yvD8QRibYhJeWzmzJDibcS2q1tRFlY2ib5icgvsvpujeQ/0',1438509681,1438509681),(147,'oWeLOvj0fUgtqI8src8-e3To8gsc','Jeanne','','http://wx.qlogo.cn/mmopen/aDolcicNgYzIrevNnP6yBBmDibgL4DGiaSpV8jibjrNd4p3JCvfQoiaHamHGzPyKomPrdz8u0ttDpPUYMjM8WchbMkG2ZnDqCCNQP/0',1438524823,1438576566),(148,'oWeLOvuN2BJG7ThWvw2qvg-hjN_E','LYL','','http://wx.qlogo.cn/mmopen/ajNVdqHZLLC38UvVbibzkTDrulibgtaZxKVNOGrJBAxJLBoezJLrDZibrDdpKXPwz6kAqwYezIq67Ctqrp1tSw83w/0',1438823273,1438823273),(149,'oWeLOvlIWasugEjmsJNzbCa0Tums','念','','http://wx.qlogo.cn/mmopen/Iic4Zx3iaYpibZS6RCJxarsXOamXGDDQeGGyFBoXvwEMprLzq4fpibjeuHZ63Cad1CyluPE6qYrwItXiaMQXfdlecia4EBBzJ38FqL/0',1438941635,1438941635),(150,'oWeLOvku-VYcJniYeVsq3b88n7_8','勇哥','','http://wx.qlogo.cn/mmopen/ajNVdqHZLLBJlrquLdMK7yR35fMBfEXd1CX21bowcNO3QXLodagaicGkzyn4c1ohtp61rsGEnZV8tpL9Ry9MLaQ/0',1438958792,1438958792),(151,'oWeLOvolqHlfyAyyr47uyYrWiv-s','小金','','',1439005200,1439005200),(152,'oWeLOvk93UtYDBhNYm9IizFZ57gM','兰均','','',1439005695,1439005695),(153,'oWeLOvj4Sz7QzD9RbVGhPD-kO-4U','agitator','','',1439119852,1439285156),(154,'oWeLOvmGY7goOb9lbusUg8Qbdt4c','老家表弟','','http://wx.qlogo.cn/mmopen/Q3auHgzwzM5YTXGr2sqsJyvVWwY3waSlIZicHaT9uzp82ib0mqrY92hyVccm60uDnjiaia2ONlZAWv7ials2RU1ybzQ/0',1439125463,1439127234),(155,'oWeLOvkijfo-7VY9R3RMDmJBHLj0','','','http://wx.qlogo.cn/mmopen/aDolcicNgYzKtuuoQrQFfPrVzaiakbIrf1dQvcVFfMyUriaLYcel4Qk2229peXFonMcplZq5xficFqfQyicTQTo1x8g/0',1439204255,1439288485),(156,'oWeLOvvA5c_BPd6ov6eueRELvNtw','Casey','','http://wx.qlogo.cn/mmopen/aDolcicNgYzIrevNnP6yBBtpCWgpcHkMk7bzqVYzKAuaKsrfyaxLGwQtglXj0kxViakNR1UzpZu6bTibxESpYqDmLFLfxoHqYGc/0',1439275987,1439516313),(157,'oWeLOvkY2_C6Mghw4p4lkrh24zTQ','王智铎','','http://wx.qlogo.cn/mmopen/rjdt7ddDxvQLE7JBxcWOd2HicsUT0O9oia7hh12ao85bNZ3GOLa9kWkD82bGcOfN5WyPWFG2mhj7nOaaibRg4WgKYiaMRuMzJGicO/0',1439309449,1439309449),(158,'oWeLOvuq0RHtNMxxnlfvKZHHs48Y','请叫我士杰-汪士杰。','','http://wx.qlogo.cn/mmopen/Iic4Zx3iaYpibZS6RCJxarsXAticmxibYnZbZF0qZk4XPsYnZzc0A3wLiaUXodzkHv4GicKvn5N7Zicd3eFxMnWAAibGOnTaiaca3YBY06/0',1439369248,1439518619),(159,'oWeLOvpFLlNcEfrTd4gPEweVTEkg','安安静静','','http://wx.qlogo.cn/mmopen/ajNVdqHZLLCkiaf0jsibPiaic3HSib4M8zqiaicFbhgsxtE3MlAtDXtNEgPoPLtiaibl0GO3IjbTp7CicLQjibYjC2D6RvLcw/0',1439373555,1439373555),(160,'oWeLOvr9c0bTv2og1n3Hlna204No','小兔子','','http://wx.qlogo.cn/mmopen/ajNVdqHZLLBJDVKQL2TwBWVNapXDQM8pYhRiaGDcrHL7HCDbchuLKVckt7BWrXYhEgMjnPw5e6PViaicfTSPMkVTQ/0',1439463567,1439463567),(161,'oWeLOvmz7RlnuCraAvDXL0I_VzuE','cherry','','http://wx.qlogo.cn/mmopen/Q3auHgzwzM7micXEI5NpVIORPCM3UXQicqJ73Lco0RibtcRibAkMVxXOZ38AGB0QJHUR1G9cxt1BSltJ2ibiclibHtNrg/0',1439463743,1439463743),(162,'oWeLOvhktP2aTyC3CaKqY3RljJO8','阿布','','http://wx.qlogo.cn/mmopen/Q3auHgzwzM4NelWNRKeo3gG0Ljv8Tiagd1TxibVSty2dC5hFyCz7ibJRsrFt2kEhlRD8SuBU0BPcyL5f6hFFW6x9w/0',1439463768,1439463768);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_address`
--

DROP TABLE IF EXISTS `user_address`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_address` (
  `add_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '地址ID',
  `user_id` int(11) NOT NULL COMMENT '所属用户',
  `name` varchar(255) NOT NULL COMMENT '收货人姓名',
  `mobile` varchar(255) NOT NULL COMMENT '电话',
  `location` varchar(255) NOT NULL COMMENT '地区',
  `location_detail` varchar(255) NOT NULL COMMENT '详细地址',
  PRIMARY KEY (`add_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=130 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_address`
--

LOCK TABLES `user_address` WRITE;
/*!40000 ALTER TABLE `user_address` DISABLE KEYS */;
INSERT INTO `user_address` VALUES (73,106,'隋小波','13901234567','6','嘿'),(74,107,'IL瑞','13901234567','35','测试'),(75,108,'白米粥小姐','18611730502','2','去你丫的'),(76,109,'时间','13596963636','3','测试订单 无需配送'),(77,110,'Timmy','','',''),(78,111,'Qianwen','13910961356','10','003'),(79,112,'八通','13811689999','2','6楼1621'),(80,113,'刘萱','13671263962','2','双子大厦15层'),(81,114,'Chloe','','',''),(82,115,'MLi','18612170205','2','黑胡椒'),(83,116,'B.M.','','',''),(84,117,'张胖胖','','',''),(85,118,'盆儿','','',''),(86,119,'24K猫女王 ','','',''),(87,120,'小雨天凉','','',''),(88,121,'中软国际JointForce平台','','',''),(89,122,'陈晓明','','',''),(90,123,'李俍予','18611857914','15','test'),(91,124,'西米黄文谋','','',''),(92,125,'金石','15001286407','28','拉几个'),(93,126,'紫墩','','',''),(94,127,'胡光远','','',''),(95,128,'鲜品  水果切','','',''),(96,129,'I.Think.','','',''),(97,130,'yuan小玮','','',''),(98,131,'婉茹','','',''),(99,132,'雾狸','','',''),(100,133,'王亚川@大数据','','',''),(101,134,'Willey','','',''),(102,135,'Vivian','','',''),(103,136,'半成品。','','',''),(104,137,'倘若似水流年','','',''),(105,138,'  +  +  +  ','','',''),(106,139,'红小豆尹小媛','','',''),(107,140,'赵凤','','',''),(108,141,'sheep.ly','','',''),(109,142,'Joseph K','','',''),(110,143,'刘橙子:-)','','',''),(111,144,'陈铭丰-综合贷款融资','','',''),(112,145,'','','',''),(113,146,'warren','','',''),(114,147,'Jeanne','','',''),(115,148,'LYL','','',''),(116,149,'念','','',''),(117,150,'勇哥','','',''),(118,151,'小金','','',''),(119,152,'兰均','','',''),(120,153,'agitator','','',''),(121,154,'老家表弟','','',''),(122,155,'','','',''),(123,156,'Casey','','',''),(124,157,'王智铎','','',''),(125,158,'请叫我士杰-汪士杰。','','',''),(126,159,'安安静静','','',''),(127,160,'小兔子','','',''),(128,161,'cherry','','',''),(129,162,'阿布','','','');
/*!40000 ALTER TABLE `user_address` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_coupon`
--

DROP TABLE IF EXISTS `user_coupon`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_coupon` (
  `coupon_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '优惠券ID',
  `user_id` int(11) NOT NULL COMMENT '用户ID',
  `type_id` int(11) NOT NULL COMMENT '优惠券类型',
  `having_time` int(11) NOT NULL COMMENT '拥有优惠券时间',
  `is_used` int(11) NOT NULL DEFAULT '0' COMMENT '优惠券是否使用',
  `order_id` int(12) NOT NULL DEFAULT '0' COMMENT '使用的订单',
  `use_time` int(11) NOT NULL DEFAULT '0' COMMENT '优惠券使用时间',
  `valid_time` int(11) NOT NULL DEFAULT '0' COMMENT '优惠券有效期',
  `pay_order` varchar(255) NOT NULL DEFAULT '0' COMMENT '购买优惠券的订单ID（对应微信支付）',
  PRIMARY KEY (`coupon_id`),
  KEY `user_id` (`user_id`,`type_id`,`is_used`),
  KEY `order_id` (`order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_coupon`
--

LOCK TABLES `user_coupon` WRITE;
/*!40000 ALTER TABLE `user_coupon` DISABLE KEYS */;
INSERT INTO `user_coupon` VALUES (46,156,2,1439276485,0,0,0,0,'20150531'),(47,156,2,1439276485,0,0,0,0,'20150531'),(48,156,2,1439276485,0,0,0,0,'20150531'),(49,156,2,1439276485,0,0,0,0,'20150531'),(50,156,2,1439276485,0,0,0,0,'20150531'),(51,156,1,1439276494,0,0,0,0,'20150531'),(52,156,1,1439276494,0,0,0,0,'20150531'),(53,156,1,1439276494,0,0,0,0,'20150531'),(54,156,1,1439276494,0,0,0,0,'20150531'),(55,156,1,1439276494,0,0,0,0,'20150531'),(56,156,4,1439276786,0,0,0,0,'20150531'),(57,156,4,1439276786,0,0,0,0,'20150531'),(58,156,4,1439276786,0,0,0,0,'20150531'),(59,156,4,1439276786,0,0,0,0,'20150531'),(60,156,4,1439276786,0,0,0,0,'20150531'),(61,156,2,1439276795,0,0,0,0,'20150531'),(62,156,2,1439276795,0,0,0,0,'20150531'),(63,156,2,1439276795,0,0,0,0,'20150531'),(64,156,2,1439276795,0,0,0,0,'20150531'),(65,156,2,1439276795,0,0,0,0,'20150531'),(66,156,1,1439276803,0,0,0,0,'20150531'),(67,156,1,1439276803,0,0,0,0,'20150531'),(68,156,1,1439276803,0,0,0,0,'20150531'),(69,156,1,1439276803,0,0,0,0,'20150531'),(70,156,1,1439276803,0,0,0,0,'20150531'),(71,156,4,1439276829,0,0,0,0,'20150531'),(72,156,4,1439276829,0,0,0,0,'20150531'),(73,156,4,1439276829,0,0,0,0,'20150531'),(74,156,4,1439276829,0,0,0,0,'20150531'),(75,156,4,1439276829,0,0,0,0,'20150531');
/*!40000 ALTER TABLE `user_coupon` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-08-14 11:29:35
