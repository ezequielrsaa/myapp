# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.7.20)
# Database: site0
# Generation Time: 2017-11-30 12:04:58 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table categories
# ------------------------------------------------------------

DROP TABLE IF EXISTS `categories`;

CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `sort` int(3) DEFAULT NULL,
  `active` int(1) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;

INSERT INTO `categories` (`id`, `name`, `slug`, `description`, `sort`, `active`, `created`, `modified`)
VALUES
	(1,'Main','main','Main',100,1,'2013-10-18 11:23:04','2016-04-22 06:20:33'),
	(2,'Shoes','shoes','Shoes',100,1,'2013-10-23 03:11:57','2016-04-22 06:21:46');

/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table orderproducts
# ------------------------------------------------------------

DROP TABLE IF EXISTS `orderproducts`;

CREATE TABLE `orderproducts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(10) unsigned DEFAULT NULL,
  `product_id` int(10) unsigned DEFAULT NULL,
  `productoption_id` int(11) DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `productoption_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `weight` decimal(8,2) unsigned DEFAULT '0.00',
  `price` decimal(8,2) unsigned DEFAULT NULL,
  `subtotal` decimal(8,2) unsigned DEFAULT NULL,
  `note` text COLLATE utf8_unicode_ci,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;



# Dump of table orders
# ------------------------------------------------------------

DROP TABLE IF EXISTS `orders`;

CREATE TABLE `orders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `billing_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `billing_address2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `billing_city` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `billing_zip` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `billing_state` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `billing_country` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shipping_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shipping_address2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shipping_city` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shipping_zip` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shipping_state` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shipping_country` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `weight` decimal(8,2) unsigned DEFAULT '0.00',
  `order_item_count` int(11) DEFAULT NULL,
  `subtotal` decimal(8,2) DEFAULT NULL,
  `tax` decimal(8,2) DEFAULT NULL,
  `shipping` decimal(8,2) DEFAULT NULL,
  `total` decimal(8,2) unsigned DEFAULT NULL,
  `shipping_method` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `payment_method` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `creditcard_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `creditcard_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `creditcard_year` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `creditcard_month` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `authorization` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `transaction` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ip_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remote_host` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `referer_cookie` text COLLATE utf8_unicode_ci,
  `referer_session` text COLLATE utf8_unicode_ci,
  `request_uri` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `comment` text COLLATE utf8_unicode_ci,
  `note` text COLLATE utf8_unicode_ci,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;



# Dump of table productoptions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `productoptions`;

CREATE TABLE `productoptions` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `product_id` int(10) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `value` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price` decimal(8,2) DEFAULT NULL,
  `weight` decimal(8,2) DEFAULT NULL,
  `active` int(1) DEFAULT NULL,
  `views` int(11) DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `modified` (`modified`),
  KEY `category_id` (`product_id`),
  KEY `brand_id` (`value`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

LOCK TABLES `productoptions` WRITE;
/*!40000 ALTER TABLE `productoptions` DISABLE KEYS */;

INSERT INTO `productoptions` (`id`, `product_id`, `name`, `value`, `price`, `weight`, `active`, `views`, `created`, `modified`)
VALUES
	(1,17,'brown 8',NULL,79.00,NULL,1,0,'2017-11-28 00:00:00','2017-11-28 00:00:00'),
	(2,17,'brown 9',NULL,79.00,NULL,1,0,'2017-11-28 00:00:00','2017-11-28 00:00:00'),
	(3,17,'brown 10',NULL,79.00,NULL,1,0,'2017-11-28 00:00:00','2017-11-28 00:00:00'),
	(4,15,'xl',NULL,14.95,NULL,1,0,'2017-11-28 00:00:00','2017-11-28 00:00:00'),
	(5,15,'sm',NULL,9.95,NULL,1,0,'2017-11-28 00:00:00','2017-11-28 00:00:00'),
	(6,15,'md',NULL,14.95,NULL,1,0,'2017-11-28 00:00:00','2017-11-28 00:00:00'),
	(7,15,'l',NULL,14.95,NULL,1,0,'2017-11-28 00:00:00','2017-11-28 00:00:00');

/*!40000 ALTER TABLE `productoptions` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table products
# ------------------------------------------------------------

DROP TABLE IF EXISTS `products`;

CREATE TABLE `products` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(11) unsigned DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price` decimal(8,2) DEFAULT NULL,
  `weight` decimal(8,2) DEFAULT NULL,
  `views` int(11) DEFAULT '0',
  `active` int(1) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`),
  KEY `modified` (`modified`),
  KEY `name_slug` (`slug`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;

INSERT INTO `products` (`id`, `category_id`, `name`, `slug`, `description`, `image`, `price`, `weight`, `views`, `active`, `created`, `modified`)
VALUES
	(1,1,'Burton TWC Smuggler Snowboard Pant Bright White','burton-twc-smuggler-snowboard-pant-bright-white','That&apos;s one big ol&apos; cargo pocket; perfect for pushing ham sandwiches across the border.To give you the most bang for your buck, Shaun hid a ton of tricks inside this waterproof wonder. The not-too-baggy, classic fit leaves room for extra layers, while inner thigh vents let you release excess heat. The mesh lining dries quickly so you&apos;re never cold and clammy, and when nature calls, snap up your cuffs with the Leg Lifts to avoid nasty restroom floors.<br />Key Features of the Burton TWC Smuggler Snowboard Pant: 5,000mm Waterproof 5,000g Breathability DRYRIDE Durashell 2-Layer Coated Fabric [5,000MM, 5,000G] TWC Sig Fit Mesh Lining Mesh-Lined Inner Thigh Vents Fully Taped Seams Cargo Pocket with Velcro Closure Includes White Collection Pant Features Package','burton-twc-smuggler-snowboard-pant-bright-white.jpg',77.95,2.00,0,1,'2017-11-28 00:00:00','2017-11-28 00:00:00'),
	(2,1,'Celtek Merit Facemask Orange/Black','celtek-merit-facemask-orange-black','<br />Key Features of the Celtek Merit Facemask: 100% nylon mesh Reversible Tie closure Oversized screen print Ventilated eyelets','celtek-merit-facemask-orange-black.jpg',19.95,7.00,0,1,'2017-11-28 00:00:00','2017-11-28 00:00:00'),
	(3,1,'Burton Restricted Wilkes 5 Pkt Snowboard Pants Blue Tiger Print','burton-restricted-wilkes-5-pkt-snowboard-pants-blue-tiger-print','Burton Restricted Wilkes 5 Pkt Snowboard Pants will keep you looking good and feeling good all day long in the snow. The DRYRIDE fabric allows for breathability and waterproofing all in one, making sure you stay both cool and dry. The pants are also backed by a lifetime warranty so if anything goes wrong simply get them exchanged for a new pair. The Burton Restricted Wilkes 5 Pkt Snowboard Pants also feature snap up leg lifts. No longer do you have to worry about scuffing and tearing the cuffs of your pants, simply snap them up when walking around and let them back down when on your snowboard.<br />Key Features of The Burton Restricted Wilkes 5 Pockets Men&apos;s Snowboard Pants: 10,000mm Waterproof 5,000g Breathability DRYRIDE Durashell 2-Layer Laminated Fabric [10,000MM, 5,000G] Burton Slim Fit Mesh Lining Inner Thigh Vents Fully Taped Seams LIFETIME WARRANTY DRYRIDE Fabrication with DWR Coating Inner Thigh Vents Fully Taped Seams Zippered, Microfleece-Lined Handwarmer Pockets Link ZIP Jacket-to-Pant Interface Boot Gaiter with Cuff-to-Boot Interface Articulated Knees Integrated Waist Adjustment Microfleece Fly and Waistband Double-Headed Fly Ghetto Slits Snap-Up Leg Lifts,Keep Your Cuffs Scuff-Free','burton-restricted-wilkes-5-pkt-snowboard-pants-blue-tiger-print.jpg',81.95,9.00,0,1,'2017-11-28 00:00:00','2017-11-28 00:00:00'),
	(4,1,'Burton Society Snowboard Pants Capers','burton-society-snowboard-pants-capers','Be civilized yet play the edge in the women&apos;s Burton Society Pant. Waterproof/breathable DRYRIDE Durashell 2L fabric and our classic signature fit combine to protect you from wind, wet, and wacky style. Lightweight levels of Thermacore insulation protect your buns from freezer burn and with mesh-lined inner thigh vents, you can keep cool when hiking or springtime riding. When the snow-choked back bowls invite you to mingle; RSVP yes &apos;cause boot gaiters and jacket-to-pant interface let you have a blast without getting bogged down in the deep stuff.<br />Key Features of The Burton Society Women&apos;s Snowboard Pants: 5,000mm Waterproof 5,000g Breathability DRYRIDE Durashell 2-Layer Coated Smooth Face Woven Fabric [5,000MM, 5,000G] Fully Taped Seams Mesh Lined Inner Thigh Vents Taffeta Wrapture Lining Thermacore Insulation (40G Throughout) Includes Women&apos;s Burton Package Sig Fit','burton-society-snowboard-pants-capers.jpg',49.95,7.00,0,1,'2017-11-28 00:00:00','2017-11-28 00:00:00'),
	(5,1,'Burton Society Snowboard Pants Grass Stain','burton-society-snowboard-pants-grass-stain','Get more bang for your buck. Waterproof warmth that performs all season.Get more bang for your buck with this weatherproof and versatile all-season style. Lightweight Thermacore insulation protect your buns from freezer burn and with mesh-lined inner thigh vents, you can cool quickly when hiking or springtime riding. Like all women&apos;s Burton pants, you can seal these to any Burton jacket to block out snow, and lift the cuffs to protect from mud and pavement.<br />Key Features of the Burton Society Snowboard Pants: 5,000mm Waterproof 5,000g Breathability DRYRIDE Durashell 2-Layer Coated Smooth Face Woven Fabric [5,000MM, 5,000G] Sig Fit Thermacore Insulation [40G Throughout] Taffeta Lining Mesh-Lined Inner Thigh Vents Fully Taped Seams Includes Women&apos;s Burton Pant Features Package','burton-society-snowboard-pants-grass-stain.jpg',71.95,5.00,0,1,'2017-11-28 00:00:00','2017-11-28 00:00:00'),
	(6,1,'Burton TWC Factory Beanie Red','burton-twc-factory-beanie-red','Looking for a great looking beanie to keep your melon warm these winter months. When it comes to getting a beanie, you want to get one that offers a lot of warmth, because it&apos;s never fun when your ears are cold. It&apos;s also important to get a design you like, so you continue to wear your hat and protect your ears. If you like subtle looks, you will love this Burton TWC Factory Beanie. It&apos;s a real simple knitted beanie that offers a ton of warmth to those ears of yours.<br />Key Features of the Burton TWC Factory Beanie: 100% Acrylic Loose Knit Beanie Convertible Slouched to Skully Fit TWC Embroidery','burton-twc-factory-beanie-red.jpg',12.56,7.00,0,1,'2017-11-28 00:00:00','2017-11-28 00:00:00'),
	(7,1,'DC Hall T-Shirt Royal Blue','dc-hall-t-shirt-royal-blue','<br />Key Features of The DC Hall T-Shirt: Regular Fit Crew Neck Short Sleeve','dc-hall-t-shirt-royal-blue.jpg',13.95,1.00,0,1,'2017-11-28 00:00:00','2017-11-28 00:00:00'),
	(8,1,'DC Iikka T-Shirt Black','dc-iikka-t-shirt-black','<br />Key Features of The DC Iikka T-Shirt: Regular Fit Crew Neck Short Sleeve 100% cotton 6.0oz 18/1&apos;s core fit jersey','dc-iikka-t-shirt-black.jpg',9.95,5.00,0,1,'2017-11-28 00:00:00','2017-11-28 00:00:00'),
	(9,2,'Forum Shepherd Snowboard Boots Brown','forum-shepherd-snowboard-boots-brown','The Shepherd is J.P.&apos;s signature boot and a team favorite. It returns this season with a few minor tweaks including our high-performance hybrid liner and a rubberized toe guard for extra protection against rail and snowmobile abuse. The Shepherd&apos;s overlasted midsole/outsole creates the ultimate all-mountain freestyle boot for riders who want enhanced terrain feel and board control.<br />Key Features of the Forum Shepherd Snowboard Boots: LINER: Concentrix Level 3 CUFF LINK: Gold SOLE: Overlasted LACING SYSTEM: Traditional','forum-shepherd-snowboard-boots-brown.jpg',114.95,4.00,0,1,'2017-11-28 00:00:00','2017-11-28 00:00:00'),
	(10,2,'DC Trust Skate Shoes Dark Shadow','dc-trust-skate-shoes-dark-shadow','<br />Key Features of the DC Trust Skate Shoes: Silky Suede Upper Foam-Padded Tongue and Collar for added Comfort &amp; Support DC&apos;s Performance Cup Sole Construction Abrasion-Resistant Sticky Rubber Outsole with DC&apos;s Trademarked &quot;Pill&quot; Pattern HEAVY DUTY CANVAS ON UPPER PANEL Extra sandwich mesh tongue with ventilated foam','dc-trust-skate-shoes-dark-shadow.jpg',64.95,9.00,0,1,'2017-11-28 00:00:00','2017-11-28 00:00:00'),
	(11,1,'Electric Charge Sunglasses Crimson Red/Grey Fire Chrome Lens','electric-charge-sunglasses-crimson-red-grey-fire-chrome-lens','Sometimes going into social situations is scary, especially if your face is naked, and the fear in your eyes is visible. But when the time comes to make your entrance, there&amp;#8217;s only one thing to do&amp;#8230; CHARGE! Classic styling, wrap fit, great for any face-these are the no nonsense, no bullsh*t, universal shades that will make any entrance you make amazing.<br />Key Features of the Electric Charge Sunglasses: Size Category - 2 100% UV Protection 8 Base Mold Injected Grilamid Frame 8 Base Polycarbonate Lens 5 Barrel Stainless Steel Optical Hinge','electric-charge-sunglasses-crimson-red-grey-fire-chrome-lens.jpg',100.00,2.00,0,1,'2017-11-28 00:00:00','2017-11-28 00:00:00'),
	(12,2,'DC Court Vulc Skate Shoes Black/Athletic Red','dc-court-vulc-skate-shoes-black-athletic-red','<br />Key Features of the DC Court Vulc Skate Shoes: An extension of the successful Court Graffik franchise, the Court Vulc features the classic styling with a vulcanized construction for great board feel and sole flex Abrasion resistant sticky rubber outsole DC&apos;s Trademarked &quot;Pill Pattern&quot; bottom','dc-court-vulc-skate-shoes-black-athletic-red.jpg',54.95,0.00,0,1,'2017-11-28 00:00:00','2017-11-28 00:00:00'),
	(13,1,'Dakine Scrambler Jr. Toddler Mittens Walrus','dakine-scrambler-jr-toddler-mittens-walrus','<br />Key Features of the Dakine Scrambler Jr. Toddler Snowboard Mittens: Waterproof insert High Loft Synthetic Insulation 230g Fleece Lining','dakine-scrambler-jr-toddler-mittens-walrus.jpg',23.00,7.00,0,1,'2017-11-28 00:00:00','2017-11-28 00:00:00'),
	(14,1,'DC So Long T-Shirt Blue Surf','dc-so-long-t-shirt-blue-surf','<br />Key Features of The DC So Long T-Shirt: Regular Fit Crew Neck Short Sleeve','dc-so-long-t-shirt-blue-surf.jpg',20.95,5.00,0,1,'2017-11-28 00:00:00','2017-11-28 00:00:00'),
	(15,1,'DC Shocked T-Shirt Celtic','dc-shocked-t-shirt-celtic','<br />Key Features of the DC Shocked T-Shirt: Premium fit 100% cotton','dc-shocked-t-shirt-celtic.jpg',14.95,6.00,0,1,'2017-11-28 00:00:00','2017-11-28 00:00:00'),
	(16,2,'DC Rogan Snowboard Boots Black/Rasta','dc-rogan-snowboard-boots-black-rasta','The Rogan offers the right amount of flex and comfort for all day park laps, while still be supportive enough to explore the entire mountain. This rider-inspired, skate influenced boot is one of the most versatile in DC&apos;s line.<br />Key Features of the DC Rogan Snowboard Boots: Direct power lacing 3D Tongue Articulation Molded backstay Internal ankle harness Unilite Bravo liner Flex rating: 6','dc-rogan-snowboard-boots-black-rasta.jpg',118.95,8.00,0,1,'2017-11-28 00:00:00','2017-11-28 00:00:00'),
	(17,2,'Forum Aura Snowboard Boots Chocolate','forum-aura-snowboard-boots-chocolate','Had a little work done and now she&apos;s better than ever. The Aura is a perennial favorite that offers style and performance at a great price. For 2008, it received the most significant makeover of all our carryover boots. Its refined court shoe-inspired outer with metal lace hooks is packed with our new 4D-molded tongue, innovative hybrid liner with 3/4 footbed and ankle supports, stabilizing internal cuff, and our rugged high-traction cupsole with self-cleaning tread.<br />Key Features of The Forum Aura Women&apos;s Snowboard Boots: Concentrix Level 1 Liner - Basic yet supportive, this no frills option features a molded EVA footbed, new anatomical PE supports, and adjustable calf straps for enhanced fit Silver Cuff Link - This option has a new custom lace look and provides much of the same comfort and hold as Forum&apos;s Gold Cuff line, except it comes in a stream lined configuration with an internal cage Cup Sole Traditional Lacing System Flex - 4','forum-aura-snowboard-boots-chocolate.jpg',68.95,3.00,0,1,'2017-11-28 00:00:00','2017-11-28 00:00:00'),
	(18,1,'DC Lear Mittens Blue Radiance/Black','dc-lear-mittens-blue-radiance-black','<br />Key Features of the DC Lear Snowboard Mittens: 10,000mm waterproof poly-insulated mitten with inner finger channels nose wipe Grippy palm Thumb protection Internal pocket','dc-lear-mittens-blue-radiance-black.jpg',29.95,2.00,0,1,'2017-11-28 00:00:00','2017-11-28 00:00:00');

/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `role` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `uuid` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `active` int(1) unsigned DEFAULT '0',
  `login_count` int(11) unsigned DEFAULT '0',
  `login_last` datetime DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `active` (`active`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `role`, `first_name`, `last_name`, `phone`, `email`, `password`, `uuid`, `active`, `login_count`, `login_last`, `created`, `modified`)
VALUES
	(1,'admin','Admin','Admin','818-111-1111','info@example.com','$2y$10$CgM4vIxsvxgDGR3A0.0tfuFNvBDw8EAVYWPZBV5eusI00qqeaofjm','',1,2,'2017-11-28 09:17:42','2014-12-10 11:19:57','2017-11-28 09:18:15');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
