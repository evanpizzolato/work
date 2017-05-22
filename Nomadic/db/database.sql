-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Apr 20, 2017 at 01:46 PM
-- Server version: 5.6.35
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nomadic`
--

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

DROP TABLE IF EXISTS `activities`;
CREATE TABLE `activities` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `description` varchar(200) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `notes` varchar(500) DEFAULT NULL,
  `time_start` datetime DEFAULT NULL,
  `time_end` datetime DEFAULT NULL,
  `location` varchar(45) DEFAULT NULL,
  `days_id` int(11) NOT NULL,
  `days_Vacations_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ambassador_categories`
--

DROP TABLE IF EXISTS `ambassador_categories`;
CREATE TABLE `ambassador_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `common_phrases`
--

DROP TABLE IF EXISTS `common_phrases`;
CREATE TABLE `common_phrases` (
  `id` int(11) NOT NULL,
  `phrase` varchar(200) NOT NULL,
  `destinations_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `contact_form`
--

DROP TABLE IF EXISTS `contact_form`;
CREATE TABLE `contact_form` (
  `id` int(11) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `address` varchar(75) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `email` varchar(75) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `subject` varchar(100) NOT NULL,
  `comment` text NOT NULL,
  `date_submitted` varchar(60) NOT NULL,
  `date_edited` varchar(60) DEFAULT NULL,
  `edit_reason` varchar(100) DEFAULT NULL,
  `reply_status` varchar(50) DEFAULT NULL,
  `users_id` varchar(13) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `contact_form`
--

INSERT INTO `contact_form` (`id`, `firstname`, `lastname`, `address`, `country`, `email`, `phone`, `subject`, `comment`, `date_submitted`, `date_edited`, `edit_reason`, `reply_status`, `users_id`) VALUES
(1, 'Hello', 'World', '1234 Fake St', 'Canada', 'hello@world.com', '', 'Testing', 'Testing users ID    ', '2017-04-19 12:35:18', ' 2017-04-19 12:51:08 ', 'Testing switch to GET', '', '58e05eb7e52f9');

-- --------------------------------------------------------

--
-- Table structure for table `days`
--

DROP TABLE IF EXISTS `days`;
CREATE TABLE `days` (
  `id` int(11) NOT NULL,
  `vacations_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `destinations`
--

DROP TABLE IF EXISTS `destinations`;
CREATE TABLE `destinations` (
  `id` int(11) NOT NULL,
  `city` varchar(60) NOT NULL COMMENT '		',
  `state` varchar(60) NOT NULL,
  `country` varchar(60) NOT NULL,
  `lat` float(10,6) NOT NULL,
  `lng` float(10,6) NOT NULL,
  `population` int(10) DEFAULT NULL,
  `languages` varchar(500) DEFAULT NULL,
  `climate` varchar(45) DEFAULT NULL,
  `advisory` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `destinations`
--

INSERT INTO `destinations` (`id`, `city`, `state`, `country`, `lat`, `lng`, `population`, `languages`, `climate`, `advisory`) VALUES
(1, 'Tulum', 'Quintana Roo', 'Mexico', 20.214815, -87.429268, 18233, 'Spanish', 'Hot', 0),
(2, 'Bangkok', 'Bangkok Metropolitan Division', 'Thailand', 13.756331, 100.501762, 14565547, 'Thai', 'Hot', 0),
(3, 'Budapest', 'Central Hungary', 'Hungary', 47.497913, 19.040236, 1732000, 'Hungarian', 'Temperate', 0);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `name` varchar(75) NOT NULL,
  `date` datetime NOT NULL,
  `description` longtext NOT NULL,
  `link` varchar(255) NOT NULL,
  `visible` tinyint(1) NOT NULL DEFAULT '0',
  `users_id` varchar(13) NOT NULL,
  `locations_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `name`, `date`, `description`, `link`, `visible`, `users_id`, `locations_id`) VALUES
(2, 'Butt Party', '2017-04-30 19:04:00', 'Prepare yourself', '', 0, '58ecee6ddc5b7', 21),
(3, 'Pink Things', '2017-05-15 15:05:00', 'Yep yep', '', 0, '58ecee6ddc5b7', 7),
(4, 'Who Knows Who Cares', '2017-07-19 01:07:00', 'Who knows?', '', 0, '58ecee6ddc5b7', 7);

-- --------------------------------------------------------

--
-- Table structure for table `events_active`
--

DROP TABLE IF EXISTS `events_active`;
CREATE TABLE `events_active` (
  `events_id` int(11) NOT NULL,
  `token` varchar(50) NOT NULL,
  `amount` int(11) NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `events_active`
--

INSERT INTO `events_active` (`events_id`, `token`, `amount`, `start`, `end`) VALUES
(1, 'tok_1A9gZWHAiWcZuBMgz09vdRl7', 99, '2017-04-17 16:35:46', '2017-04-17 16:45:46'),
(1, 'tok_1A9itQHAiWcZuBMgLxgBVseR', 99, '2017-04-17 19:04:28', '2017-04-17 19:14:28'),
(1, 'tok_1A9kUoHAiWcZuBMgJwzKZmeM', 20000, '2017-04-17 20:47:10', '2017-04-19 13:47:10'),
(2, 'tok_1A9bl0HAiWcZuBMgOGk6wxzb', 99, '2017-04-17 11:27:18', '2017-04-17 11:37:18'),
(2, 'tok_1A9bRrHAiWcZuBMg1N519NEM', 99, '2017-04-17 11:07:30', '2017-04-17 11:17:30'),
(2, 'tok_1A9bx4HAiWcZuBMg70J77C6z', 99, '2017-04-17 11:39:45', '2017-04-17 11:49:45'),
(2, 'tok_1A9fsgHAiWcZuBMg5xkO1nZf', 99, '2017-04-17 15:51:29', '2017-04-17 16:01:29'),
(2, 'tok_1A9gZtHAiWcZuBMgYDWekOCH', 500, '2017-04-17 16:36:09', '2017-04-17 17:36:09'),
(2, 'tok_1A9qLfHAiWcZuBMg3xykmcyN', 99, '2017-04-18 03:02:07', '2017-04-18 03:12:07'),
(2, 'tok_1AAP5sHAiWcZuBMgv4cABGNO', 99, '2017-04-19 16:08:08', '2017-04-19 16:18:08'),
(2, 'tok_1AAPbwHAiWcZuBMg042QxKNl', 500, '2017-04-19 16:41:16', '2017-04-19 17:41:16'),
(3, 'tok_1A9bixHAiWcZuBMgHVadupwX', 99, '2017-04-17 11:25:10', '2017-04-17 11:35:10'),
(3, 'tok_1A9ftUHAiWcZuBMggILtrXmw', 99, '2017-04-17 15:52:20', '2017-04-17 16:02:20'),
(3, 'tok_1AAPmhHAiWcZuBMguW4vNy1t', 99, '2017-04-19 16:52:23', '2017-04-19 17:02:23'),
(4, 'tok_1A9bwXHAiWcZuBMgs4z0asqE', 99, '2017-04-17 11:39:12', '2017-04-17 11:49:12'),
(4, 'tok_1A9gepHAiWcZuBMgmtmjN4rF', 99, '2017-04-17 16:41:14', '2017-04-17 16:51:14'),
(4, 'tok_1A9hLTHAiWcZuBMgdttxTjGp', 99, '2017-04-17 17:25:18', '2017-04-17 17:35:18');

-- --------------------------------------------------------

--
-- Table structure for table `exp_levels`
--

DROP TABLE IF EXISTS `exp_levels`;
CREATE TABLE `exp_levels` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `exp_levels`
--

INSERT INTO `exp_levels` (`id`, `name`) VALUES
(1, 'Budget'),
(2, 'Modest'),
(3, 'Luxury'),
(4, 'All');

-- --------------------------------------------------------

--
-- Table structure for table `forum_categories`
--

DROP TABLE IF EXISTS `forum_categories`;
CREATE TABLE `forum_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `description` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `forum_categories`
--

INSERT INTO `forum_categories` (`id`, `name`, `description`) VALUES
(1, 'Forum Rules & Welcome', 'General rules and introductions'),
(2, 'General Discussion', 'Discussions on anything travel related'),
(3, 'Travel Advice', 'Helping community members with trustworthy ad'),
(4, 'North America', 'Destinations/Hotels/Flights/Restaurants/Activ'),
(5, 'South America', 'Destinations/Hotels/Flights/Restaurants/Activ'),
(6, 'Caribbean', 'Destinations/Hotels/Flights/Restaurants/Activ'),
(7, 'Europe', 'Destinations/Hotels/Flights/Restaurants/Activ'),
(8, 'Asia', 'Destinations/Hotels/Flights/Restaurants/Activ'),
(9, 'Africa', 'Destinations/Hotels/Flights/Restaurants/Activ'),
(10, 'Middle East', 'Destinations/Hotels/Flights/Restaurants/Activ'),
(11, 'Oceania', 'Destinations/Hotels/Flights/Restaurants/Activ');

-- --------------------------------------------------------

--
-- Table structure for table `forum_replies`
--

DROP TABLE IF EXISTS `forum_replies`;
CREATE TABLE `forum_replies` (
  `id` int(11) NOT NULL,
  `content` longtext NOT NULL,
  `date` datetime NOT NULL,
  `total` int(11) NOT NULL DEFAULT '0',
  `forum_topics_id` int(11) NOT NULL,
  `users_id` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `forum_topics`
--

DROP TABLE IF EXISTS `forum_topics`;
CREATE TABLE `forum_topics` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  `total` int(11) NOT NULL DEFAULT '0',
  `forum_categories_id` int(11) NOT NULL,
  `users_id` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `forum_topics`
--

INSERT INTO `forum_topics` (`id`, `title`, `date`, `total`, `forum_categories_id`, `users_id`) VALUES
(1, 'Welcome fellow Nomads!', '2017-04-12 15:50:15', 0, 1, '58e05eb7e52f9'),
(2, 'General Posting Rules', '2017-04-12 15:50:23', 0, 1, '58e05eb7e52f9'),
(3, 'Introduce yourself!', '2017-04-12 15:50:32', 0, 1, '58e05eb7e52f9'),
(4, 'Use of images and other media', '2017-04-12 15:51:07', 0, 1, '58e05eb7e52f9'),
(9, 'Bucket Lists', '2017-04-12 15:57:00', 0, 2, '58e05eb7e52f9'),
(10, 'Solo traveller experiences', '2017-04-12 15:57:49', 0, 2, '58e05eb7e52f9'),
(11, 'Travelling on a budget', '2017-04-12 15:58:07', 0, 2, '58e05eb7e52f9'),
(12, 'Safety in numbers', '2017-04-12 15:58:29', 0, 3, '58e05eb7e52f9'),
(13, 'Travelling Gear', '2017-04-12 15:58:39', 0, 3, '58e05eb7e52f9'),
(14, 'A guide to packing as little as possible', '2017-04-12 15:59:43', 0, 3, '58e05eb7e52f9'),
(15, 'Best hostels to stay at in Toronto?', '2017-04-12 16:00:12', 0, 4, '58e05eb7e52f9'),
(16, 'Where to rent motorcycles in California?', '2017-04-12 16:05:37', 0, 4, '58e05eb7e52f9'),
(17, 'Road trip throughout the U.S., any experiences?', '2017-04-12 16:06:22', 0, 4, '58e05eb7e52f9'),
(18, 'Beaches in Brazil', '2017-04-12 16:07:46', 0, 5, '58e05eb7e52f9'),
(19, 'How dangerous is Colombia?', '2017-04-12 16:08:02', 0, 5, '58e05eb7e52f9'),
(20, 'My solo backpacking journey throughout South America', '2017-04-12 16:08:41', 0, 5, '58e05eb7e52f9'),
(21, 'Best Cuban All-Inclusive Resort?', '2017-04-12 16:10:29', 0, 6, '58e05eb7e52f9'),
(22, 'Marijuana use in Jamaica...', '2017-04-12 16:11:27', 0, 6, '58e05eb7e52f9'),
(23, 'How hot does it get in Costa Rica throughout the year?', '2017-04-12 16:12:05', 0, 6, '58e05eb7e52f9'),
(24, 'Best dance clubs in Ibiza?', '2017-04-12 16:21:26', 0, 7, '58e05eb7e52f9'),
(25, 'Typical tourist sites in England?', '2017-04-12 16:25:32', 0, 7, '58e05eb7e52f9'),
(26, 'List of Michelin Star Restaurants in Europe', '2017-04-12 16:26:18', 0, 7, '58e05eb7e52f9'),
(27, 'Cheapest Asian country to visit?', '2017-04-12 16:26:40', 0, 8, '58e05eb7e52f9'),
(28, 'Malaysian vs. China food, what\'s the difference?', '2017-04-12 16:29:53', 0, 8, '58e05eb7e52f9'),
(29, 'A guide to the sites and sounds of Tokyo, Japan', '2017-04-12 16:30:31', 0, 8, '58e05eb7e52f9'),
(30, 'African Adventure Tours', '2017-04-12 16:30:56', 0, 9, '58e05eb7e52f9'),
(31, 'What\'s the best experience you had while on an African vacation?', '2017-04-12 16:31:35', 0, 9, '58e05eb7e52f9'),
(32, 'Relocating to South Africa, any experiences or helpful advice?', '2017-04-12 16:37:36', 0, 9, '58e05eb7e52f9'),
(33, 'How expensive is it to vacation in Dubai?', '2017-04-12 16:39:20', 0, 10, '58e05eb7e52f9'),
(34, 'Any experiences visiting Jerusalem? ', '2017-04-12 16:39:57', 0, 10, '58e05eb7e52f9'),
(35, 'A guide to the Do\'s and Don\'t in Middle Eastern culture', '2017-04-12 16:40:27', 0, 10, '58e05eb7e52f9'),
(36, 'Australian/New Zealand life compared to North America', '2017-04-12 16:41:09', 0, 11, '58e05eb7e52f9'),
(37, 'Australian Outback Adventures', '2017-04-12 16:41:39', 0, 11, '58e05eb7e52f9'),
(38, 'Where is the best people to meet fellow Nomads like myself in New Zealand?', '2017-04-12 16:41:59', 0, 11, '58e05eb7e52f9');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

DROP TABLE IF EXISTS `invoices`;
CREATE TABLE `invoices` (
  `id` int(11) NOT NULL,
  `transaction_date` date DEFAULT NULL,
  `card_number` varchar(16) DEFAULT NULL,
  `users_id` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `invoice_line_items`
--

DROP TABLE IF EXISTS `invoice_line_items`;
CREATE TABLE `invoice_line_items` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `product_date` datetime DEFAULT NULL,
  `invoices_id` int(11) NOT NULL,
  `products_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `itinerary_items`
--

DROP TABLE IF EXISTS `itinerary_items`;
CREATE TABLE `itinerary_items` (
  `id` int(11) NOT NULL,
  `name` varchar(75) NOT NULL,
  `description` varchar(200) NOT NULL,
  `notes` text NOT NULL,
  `time_start` time NOT NULL,
  `time_end` time NOT NULL,
  `location` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `vacation_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

DROP TABLE IF EXISTS `locations`;
CREATE TABLE `locations` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `zip` varchar(6) NOT NULL,
  `lat` float(10,6) NOT NULL,
  `lng` float(10,6) NOT NULL,
  `description` longtext NOT NULL,
  `website` varchar(250) NOT NULL,
  `visible` tinyint(1) NOT NULL,
  `rating` int(2) NOT NULL,
  `cost` float DEFAULT NULL,
  `phone` varchar(50) NOT NULL,
  `filePath` varchar(250) NOT NULL,
  `destinations_id` int(11) NOT NULL,
  `location_categories_id` int(11) NOT NULL,
  `exp_levels_id` int(11) NOT NULL DEFAULT '4'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `name`, `address`, `zip`, `lat`, `lng`, `description`, `website`, `visible`, `rating`, `cost`, `phone`, `filePath`, `destinations_id`, `location_categories_id`, `exp_levels_id`) VALUES
(6, 'Cobá Ruins', 'Carretera Federal 307 Cancún-Chetumal', '77793', 20.493078, -87.724632, 'Discover the essence of ancient Mayan civilization on this full-day excursion to Coba and the Tulum ruins. This Cancun Super Saver takes you to explore Tulum\'s ruins with an expert guide, then jump into a rejuvenating underground cenote. Tour Coba, a once-thriving Mayan village deep in the rainforest. Enjoy Yucatanean specialities at a buffet lunch and round-trip transportation from your Cancun hotel.', 'https://www.tripadvisor.ca/Attraction_Review-g499447-d152724-Reviews-Coba_Ruins-Coba_Yucatan_Peninsula.html', 0, 0, 0, '', 'media/location-images/Cobá Ruins-loc.jpg', 1, 1, 4),
(7, 'Grand Palace', 'Na Phra Lan Rd', '10200', 13.750020, 100.491295, 'The Grand Palace is a complex of buildings at the heart of Bangkok, Thailand. The palace has been the official residence of the Kings of Siam since 1782.\r\n', '', 0, 0, 0, '', 'media/location-images/Grand Palace-loc.jpg', 2, 1, 4),
(8, 'Szechenyi Thermal Bath', 'Állatkerti krt. 9-11', '1146', 47.518646, 19.082378, 'The Szechenyi Medicinal Bath in Budapest is the largest medicinal bath in Europe. Its water is supplied by two thermal springs, their temperature is 74C and 77C, respectively.', 'https://www.tripadvisor.ca/Attraction_Review-g274887-d279029-Reviews-Szechenyi_Baths_and_Pool-Budapest_Central_Hungary.html', 0, 0, 0, '', 'http://www.szechenyibath.hu/static/baths/8/vip_images/5-b.jpg', 3, 1, 4),
(9, 'Rancho Tranquilo', 'Av. Tulum no. 86 (entre Saturno y Luna Norte)', '', 20.209208, -87.469543, 'Rancho Tranquilo is a family operated hotel/hostel, where you can relax, enjoy, and visit all what Tulum and Riviera Maya area offers you. Come relax in our beautiful gardens, used the communal kitchen, enjoy our included breakfast, and be part of our story.\nThis getaway is the right place for any traverler\'s affordable accomodation needs, it is also a great place to meet other travelers and exchange stories and experiences and cultures.\n', 'http://ranchotulum.com/', 0, 0, 38, '+52 (984) 871-2784', 'http://evanpizzolato.com/nomadic/images/hotel-budget-rancho.jpg', 1, 2, 1),
(10, 'Posada Luna del Sur', 'Calle Luna Sur 5, Quintana Roo', '77780', 20.208740, -87.468307, 'This unpretentious guesthouse on a secluded street is 4 km from Centro Artesanal Tulum, 7 km from Paradise Beach and 8 km from Tulum Monkey Sanctuary. \r\n\r\nFeaturing balconies or patios, modest suites offer flat-screen TVs, minifridges and free Wi-Fi, as well as tea and coffeemaking equipment. They all have living areas with sofas.\r\n\r\nContinental breakfast is complimentary (seasonal availability). There\'s also an open-air rooftop lounge under a thatched roof.\r\n', 'http://posadalunadelsur.com/', 0, 0, 136, '+52 984 134 8874', 'http://evanpizzolato.com/nomadic/images/hotel-tulum-la-posada-del-sol.jpg', 1, 2, 2),
(11, 'Mi Amor', 'Carretera Tulum-Bocapaila', '77780', 20.194021, -87.439339, 'Set masterfully on a rock cliff, where the waves become a symphony of sounds, Mi Amor is an exclusive \"Love Chic\" hotel overlooking the enchanting hues of the Caribbean Sea. ??Emulating the classic romanticism of Acapulco in the 1950s, we invite you to share love, passion and spiritual connection. Secluded yet spacious, you can take a dip in your own private plunge pool, or a swim at the beautifully designed infinity pool, while soulfully relaxing with a chilled champagne cocktail. And for complete relaxation and connection with your partner, book a lovely couples\' massage in our very romantic and intimate spa.', 'http://www.tulumhotelmiamor.com/', 0, 0, 744, '+52 1 984 115 4728', 'media/location-images/Mi Amor-loc.jpg', 1, 2, 3),
(13, 'Bangkok Loft Inn', '55 Somdet Phra Chao Tak Sin Rd', '10600', 13.721908, 100.491837, 'With its cozy atmosphere and contemporary style, this four-storey retreat offers guests an inviting environment coupled with the best facilities and amenities that they could wish for. Here, guests can take advantage of a wide array of personalized services, provided by a hospitable and friendly staff that will ensure each day of their stay is unbelievably enjoyable.', 'http://www.bangkokloftinn.com/', 0, 0, 39, '+66 2 862 0300', 'media/location-images/Bangkok Loft Inn-loc.jpg', 2, 2, 1),
(14, 'Adelphi Forty-Nine', 'Soi Sukhumvit 49 Klang Alley', '10110', 13.728254, 100.575630, 'Combining the comforts and luxury of fully-appointed suites with the hospitality and attention of an intimate boutique hotel & serviced apartment, Adelphi Forty-Nine offers superior serviced residential accommodation in the heart of downtown Bangkok. Conveniently located on Sukhumvit Soi 49, Adelphi Forty-Nine is within easy reach of the sky train network from Thonglor Station as well as Samitivej Hospital and the city\'s vibrantly cosmopolitan dining, shopping and entertainment districts. Situated just a short distance from a number of main arterial roads, Adelphi Forty-Nine serviced apartment Bangkok is also only a 30-minute drive from Bangkok Suvarnabhumi Airport.\r\n\r\n', 'http://www.adelphi49.com/', 0, 0, 109, '+66 2 662 7575', 'http://evanpizzolato.com/nomadic/images/hotel-bangkok-adelphi49.jpg', 2, 2, 2),
(15, 'The Siam Hotel', 'Khao Rd, Khwaeng Wachira Phayaban', '10300', 13.781330, 100.505745, 'Along the River of Kings... Nestled amongst Bangkok\'s historical palaces, temples and museums; a lucky few will happen upon our boutique gem, The Siam.\n\nSet on 3 acres of premium river frontage, our privately owned and operated 39-room luxury retreat will transport you to a bygone serenity suffused with priceless antiquities, oriental allure and contemporary comforts.\n\nConceived by Krissada Sukosol Clapp and globally acclaimed architect and designer Bill Bensley, The Siam features Bangkok\'s most spacious suites and is the kingdom\'s premier urban resort offering intimately private pool villas with rooftop terraces.\n', 'http://www.thesiamhotel.com/', 0, 0, 650, '+66 2 206 6999', 'http://evanpizzolato.com/nomadic/images/hotel-bangkok-siam.jpg', 2, 2, 3),
(16, 'Hotel Pension Helios', 'Lidérc u. 5', '1121', 47.480309, 18.990398, 'Among Budapest hotels the family-run Helios Hotel Pension is located in a green area of the City, but you can reach the heart of Budapest with direct bus connection within 17 minutes. Our Hotel offers its guests comfortably furnished rooms (with twin or separate beds). Most of them have balcony affording marvellous view to Budapest City.', 'http://www.heliospanzio.hu/', 0, 0, 44, '+36 1 246 4658', 'media/location-images/Hotel Pension Helios-loc.jpg', 3, 2, 1),
(19, 'Four Seasons Hotel Gresham Palace', 'Széchenyi István tér 5', '1051', 47.499702, 19.047859, 'An art nouveau landmark on Szechenyi Square, Four Seasons Hotel Gresham Palace Budapest gracefully combines vintage architecture and design with modern services and amenities. Of the Hotel\'s 179 generously proportioned luxury guest rooms, including 19 suites with vaulted ceilings and private step-out balconies, many offer views of intimate interior courtyards, the Old City or the sparkling Danube.', 'http://www.fourseasons.com/budapest/', 0, 0, 509, '+36 1 268 6000', 'media/location-images/Four Seasons Hotel Gresham Palace-loc.jpg', 3, 2, 3),
(20, 'Labnaha\'s Eco Park', 'Carretera Cancun- KM 240, Av Tulum 307, Tankah, 89', '77780', 20.284702, -87.389275, 'Labnaha\'s Eco Park called the Magic Mayan World is exclusively open for a few visitors daily. This Park offers different activities surrounded by an exuberant jungle and a subterranean world known as magical and sacred in the Mayan culture. Labnaha operates only with small groups and counts with a visitor limit per day to avoid mass tourism and the negative impact on the Eco system which allows you to enjoy without being surrounded by hundreds of people. ', 'https://www.tripadvisor.ca/Attraction_Review-g150813-d1632455-Reviews-LabnaHa_Cenotes_Eco_Park-Tulum_Yucatan_Peninsula.html', 0, 0, 0, '+52 1 984 129 3040', 'media/location-images/Labnaha\'s Eco Park-loc.jpg', 1, 1, 4),
(21, 'Tulum Monkey Sanctuary', 'Avenida Coba', '77780', 20.265884, -87.476753, 'The Tulum Monkey Sanctuary is a privately owned 60 acre ranch. On the ranch we have 15 rescued Spider Monkeys that live in natural habitats. There are also wild monkeys that pass through on their normal feeding routes. In addition to Spider Monkeys we have saved many, many animals including lots of street dogs. Although the Tulum Monkey Sanctuary is closed at the moment we hope you will support us in our move to the YuCARE Ranch.', 'https://www.tripadvisor.ca/Attraction_Review-g150813-d3726750-Reviews-Tulum_Monkey_Sanctuary-Tulum_Yucatan_Peninsula.html', 0, 0, 0, '+52 01984555555', 'media/location-images/Tulum Monkey Sanctuary-loc.jpg', 1, 1, 4),
(22, 'Baltazár Budapest', 'Országház u. 31', '1014', 47.504574, 19.029243, 'In the stylish guestrooms no detail is overlooked; the eclectic nature of the public spaces at Baltazar is carried on into all 11 rooms and suites. Each luxury room has its own bohemian spirit featuring an innovative mix of color, texture, artwork, and graphic design. The guestrooms all come appointed with original vintage and modern furnishings and handcrafted local limestone bathrooms, complemented by top-tier amenities and technology. The unique and cozy design, friendly staff, central location, and excellent service make Baltazar one of the best hotels in Budapest.', 'http://baltazarbudapest.com/', 0, 0, 150, '011 36 1 300 7051', 'media/location-images/Baltazár Budapest-loc.jpg', 3, 2, 2),
(23, 'Wat Pho (Temple of Reclining Buddha)', '2 Sanamchai Road. | Grand Palace, Pranakorn, Bangkok 10200, Thailand', '10200', 13.746521, 100.493309, 'One of the oldest and largest temples in Bangkok features the famous Reclining Buddha, which is the largest in Thailand measuring more than 150 feet in length.\r\n', 'https://www.tripadvisor.ca/Attraction_Review-g293916-d311043-Reviews-Temple_of_the_Reclining_Buddha_Wat_Pho-Bangkok.html', 0, 0, 0, '+66 2 226 0335', 'media/location-images/Wat Pho (Temple of Reclining Buddha)-loc.jpg', 2, 1, 4),
(24, 'Museum of Contemporary Art (MOCA)', '499 Thanon Kamphaeng Phet 6 Road', '10220', 13.895024, 100.585884, 'This is the place where a long yet interesting history of Thai art is recorded and a perfect combination between the extraordinary traditional Thai art and the academic art known internationally is demonstrated. Inside contemporary art by Thai artists from different generations is exhibited so that from now on Thai uniqueness of art will be introduced worldwide.', 'ttps://www.tripadvisor.ca/Attraction_Review-g293916-d3367616-Reviews-Museum_of_Contemporary_Art_MOCA-Bangkok.html', 0, 0, 0, '+66 2 016 5666', 'media/location-images/Museum of Contemporary Art (MOCA)-loc.jpg', 2, 1, 4),
(25, 'Chocolate Museum', 'Bekecs u. 22', '1162', 47.532696, 19.210028, 'Unique place where you take a special culinary travel, can taste delicious, high quality chocolates. You dip marzipan balls to a chocolate fountain, make your own handmade chocolate, visit the nostalgic Square of Chocolates, the rustic Rakoczi Cellar and the museum-like Rakoczi Knight\'s Hall. You can listen to surprising information and stories related to chocolate.', 'https://www.tripadvisor.ca/Attraction_Review-g274887-d10522908-Reviews-Chocolate_Museum-Budapest_Central_Hungary.html', 0, 0, 0, '+36 30 822 1881', 'media/location-images/Chocolate Museum-loc.jpg', 3, 1, 4),
(26, 'St. Stephen\'s Basilica', 'Szent Istvan ter 1. | Pest, Budapest 1051, Hungary', '1051', 47.500870, 19.053995, 'Built between 1851 and 1905, this large parish church accommodates 8,500 people and features a magnificent 300-foot, neo-Renaissance dome.', 'https://www.tripadvisor.ca/Attraction_Review-g274887-d276822-Reviews-St_Stephen_s_Basilica_Szent_Istvan_Bazilika-Budapest_Central_Hungary.html', 0, 0, NULL, '+36 1 317 2859', 'media/location-images/St. Stephen\'s Basilica-loc.jpg', 3, 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `location_categories`
--

DROP TABLE IF EXISTS `location_categories`;
CREATE TABLE `location_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `location_categories`
--

INSERT INTO `location_categories` (`id`, `name`) VALUES
(1, 'Activities'),
(2, 'Accomodations'),
(3, 'Events'),
(4, 'Wifi');

-- --------------------------------------------------------

--
-- Table structure for table `phone_finder`
--

DROP TABLE IF EXISTS `phone_finder`;
CREATE TABLE `phone_finder` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `locations_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `description` mediumtext,
  `product_categories_id` int(11) NOT NULL,
  `locations_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

DROP TABLE IF EXISTS `product_categories`;
CREATE TABLE `product_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `search`
--

DROP TABLE IF EXISTS `search`;
CREATE TABLE `search` (
  `id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `description` varchar(300) NOT NULL,
  `url` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `search_history`
--

DROP TABLE IF EXISTS `search_history`;
CREATE TABLE `search_history` (
  `id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `query` longtext NOT NULL,
  `url` varchar(300) NOT NULL,
  `users_id` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `search_history`
--

INSERT INTO `search_history` (`id`, `date`, `query`, `url`, `users_id`) VALUES
(1, '2017-04-18 15:44:35', 'welcome', 'http://localhost/localGit/carmen-sandiego/Nomadic/forum.php?date=2017-04-18-15%3A44%3A35&userid=58e170347dca5&query=welcome&submit=Search', '58e170347dca5'),
(2, '2017-04-19 20:35:41', 'hello', 'http://localhost/localGit/carmen-sandiego/Nomadic/forum.php?date=2017-04-19-20%3A35%3A41&userid=58e05eb7e52f9&query=hello&submit=Search', '58e05eb7e52f9'),
(3, '2017-04-19 20:35:41', 'hello', 'http://localhost/localGit/carmen-sandiego/Nomadic/forum.php?date=2017-04-19-20%3A35%3A41&userid=58e05eb7e52f9&query=hello&submit=Search', '58e05eb7e52f9'),
(4, '2017-04-19 21:40:59', 'hello', 'http://localhost/localGit/carmen-sandiego/Nomadic/searchresults.php?date=2017-04-19-21%3A40%3A59&userid=58e05eb7e52f9&query=hello&submit=Search', '58e05eb7e52f9'),
(5, '2017-04-19 21:41:29', 'hello', 'http://localhost/localGit/carmen-sandiego/Nomadic/forum.php?date=2017-04-19-21%3A41%3A29&userid=58e05eb7e52f9&query=hello&submit=Search', '58e05eb7e52f9'),
(6, '2017-04-19 21:41:29', 'hello', 'http://localhost/localGit/carmen-sandiego/Nomadic/forum.php?date=2017-04-19-21%3A41%3A29&userid=58e05eb7e52f9&query=hello&submit=Search', '58e05eb7e52f9'),
(7, '2017-04-19 21:41:29', 'hello', 'http://localhost/localGit/carmen-sandiego/Nomadic/forum.php?date=2017-04-19-21%3A41%3A29&userid=58e05eb7e52f9&query=hello&submit=Search', '58e05eb7e52f9'),
(8, '2017-04-19 22:07:41', 'hello', 'http://localhost/localGit/carmen-sandiego/Nomadic/forum.php?date=2017-04-19-22%3A07%3A41&userid=58e05eb7e52f9&query=hello&submit=Search', '58e05eb7e52f9'),
(9, '2017-04-19 22:07:41', 'hello', 'http://localhost/localGit/carmen-sandiego/Nomadic/forum.php?date=2017-04-19-22%3A07%3A41&userid=58e05eb7e52f9&query=hello&submit=Search', '58e05eb7e52f9'),
(10, '2017-04-19 22:07:41', 'hello', 'http://localhost/localGit/carmen-sandiego/Nomadic/forum.php?date=2017-04-19-22%3A07%3A41&userid=58e05eb7e52f9&query=hello&submit=Search', '58e05eb7e52f9');

-- --------------------------------------------------------

--
-- Table structure for table `tips`
--

DROP TABLE IF EXISTS `tips`;
CREATE TABLE `tips` (
  `id` int(11) NOT NULL,
  `content` varchar(300) DEFAULT NULL,
  `date_added` varchar(60) NOT NULL,
  `date_edited` varchar(60) DEFAULT NULL,
  `users_id` varchar(13) NOT NULL,
  `destinations_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tips`
--

INSERT INTO `tips` (`id`, `content`, `date_added`, `date_edited`, `users_id`, `destinations_id`) VALUES
(1, 'i love it here never gonna leave', '2017-04-19 12:40:38AM CEST', NULL, '58e05eb7e52f9', 3),
(2, 'It&#39;s great here, so hot', '2017-04-19 02:48:29AM CEST', NULL, '58e170347dca5', 1),
(3, 'Fly so high like a G6', '2017-04-19 02:51:57AM CEST', NULL, '58e05eb7e52f9', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tw_accounts`
--

DROP TABLE IF EXISTS `tw_accounts`;
CREATE TABLE `tw_accounts` (
  `id` int(11) NOT NULL,
  `created` date DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  `balance` decimal(15,0) NOT NULL,
  `users_id` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tw_categories`
--

DROP TABLE IF EXISTS `tw_categories`;
CREATE TABLE `tw_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tw_transactions`
--

DROP TABLE IF EXISTS `tw_transactions`;
CREATE TABLE `tw_transactions` (
  `id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `amount` decimal(15,0) DEFAULT NULL,
  `tw_accounts_id` int(11) NOT NULL,
  `tw_categories_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` varchar(13) NOT NULL,
  `username` varchar(45) NOT NULL,
  `firstname` varchar(45) NOT NULL,
  `lastname` varchar(45) DEFAULT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(255) NOT NULL,
  `birthday` date DEFAULT NULL,
  `points` int(11) DEFAULT NULL,
  `passport` varchar(45) DEFAULT NULL,
  `user_roles_id` int(11) NOT NULL DEFAULT '2'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `firstname`, `lastname`, `email`, `password`, `birthday`, `points`, `passport`, `user_roles_id`) VALUES
('58e05eb7e52f9', 'helloworld', 'Hello', 'World', 'helloworld@example.com', '$2y$10$GZe/WZKIPkPFeHxL4BxJFuTy3bxnsvgwsqZjhBOQ9WB6NHKXQ6IF.', NULL, NULL, NULL, 2),
('58e170347dca5', 'masteradmin', 'Master', 'Admin', 'master@example.com', '$2y$10$PgIsSrwFEnm9MHTmpN6sh.eYwDMhMFA5.IP7pCbqn3uHHlewNwzBq', NULL, NULL, NULL, 1),
('58ecee6ddc5b7', 'advertman', 'Advert', 'Man', 'advertman@example.com', '$2y$10$I0bimrnb2ckwiE0YhgFvheOt2In/vhd8/D5bSm3Z9gHBI8ENWVlgO', NULL, NULL, NULL, 3);

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

DROP TABLE IF EXISTS `user_roles`;
CREATE TABLE `user_roles` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`id`, `name`) VALUES
(1, 'admin'),
(2, 'nomad'),
(3, 'advert');

-- --------------------------------------------------------

--
-- Table structure for table `vacations`
--

DROP TABLE IF EXISTS `vacations`;
CREATE TABLE `vacations` (
  `id` int(11) NOT NULL,
  `length` int(11) DEFAULT NULL,
  `name` varchar(75) NOT NULL,
  `date_start` date DEFAULT NULL,
  `date_end` date DEFAULT NULL,
  `users_id` varchar(13) NOT NULL,
  `destinations_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vacations`
--

INSERT INTO `vacations` (`id`, `length`, `name`, `date_start`, `date_end`, `users_id`, `destinations_id`) VALUES
(1, 5, '0000-00-00', '2017-01-01', '2017-01-05', '58e05eb7e52f9', 1),
(2, 5, '0000-00-00', '2017-01-01', '2017-01-05', '58e05eb7e52f9', 1);

-- --------------------------------------------------------

--
-- Table structure for table `wifi_finder`
--

DROP TABLE IF EXISTS `wifi_finder`;
CREATE TABLE `wifi_finder` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `locations_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`id`,`days_id`,`days_Vacations_id`),
  ADD KEY `fk_Activities_Days1_idx` (`days_id`,`days_Vacations_id`);

--
-- Indexes for table `ambassador_categories`
--
ALTER TABLE `ambassador_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `common_phrases`
--
ALTER TABLE `common_phrases`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idCommon_Phrases_UNIQUE` (`id`),
  ADD KEY `fk_Common_Phrases_Destinations1_idx` (`destinations_id`);

--
-- Indexes for table `contact_form`
--
ALTER TABLE `contact_form`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_contactForm_usersId` (`users_id`);

--
-- Indexes for table `days`
--
ALTER TABLE `days`
  ADD PRIMARY KEY (`id`,`vacations_id`),
  ADD KEY `fk_Days_Vacations1_idx` (`vacations_id`);

--
-- Indexes for table `destinations`
--
ALTER TABLE `destinations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idDestination_UNIQUE` (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `events_users_id` (`users_id`),
  ADD KEY `events_locations_id` (`locations_id`);

--
-- Indexes for table `events_active`
--
ALTER TABLE `events_active`
  ADD PRIMARY KEY (`events_id`,`token`);

--
-- Indexes for table `exp_levels`
--
ALTER TABLE `exp_levels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forum_categories`
--
ALTER TABLE `forum_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forum_replies`
--
ALTER TABLE `forum_replies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `forum_topics_id` (`forum_topics_id`),
  ADD KEY `users_id` (`users_id`);

--
-- Indexes for table `forum_topics`
--
ALTER TABLE `forum_topics`
  ADD PRIMARY KEY (`id`),
  ADD KEY `forum_categories_id` (`forum_categories_id`),
  ADD KEY `users_id` (`users_id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idInvoices_UNIQUE` (`id`),
  ADD KEY `fk_Invoices_Users1_idx` (`users_id`);

--
-- Indexes for table `invoice_line_items`
--
ALTER TABLE `invoice_line_items`
  ADD PRIMARY KEY (`id`,`invoices_id`),
  ADD KEY `fk_Invoice_Line_Items_Invoices1_idx` (`invoices_id`),
  ADD KEY `fk_Invoice_Line_Items_Products1_idx` (`products_id`);

--
-- Indexes for table `itinerary_items`
--
ALTER TABLE `itinerary_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_activities_vacations_fk` (`vacation_id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_destinations_id` (`destinations_id`),
  ADD KEY `id_exp_levels_id` (`exp_levels_id`),
  ADD KEY `id_location_categories_id` (`location_categories_id`);

--
-- Indexes for table `location_categories`
--
ALTER TABLE `location_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idLocation_Categories_UNIQUE` (`id`);

--
-- Indexes for table `phone_finder`
--
ALTER TABLE `phone_finder`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idPhone_Finder_UNIQUE` (`id`),
  ADD KEY `fk_Phone_Finder_Locations1_idx` (`locations_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`,`locations_id`),
  ADD KEY `fk_Products_Product_Categories1_idx` (`product_categories_id`),
  ADD KEY `fk_Products_Locations1_idx` (`locations_id`);

--
-- Indexes for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `search`
--
ALTER TABLE `search`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `search_history`
--
ALTER TABLE `search_history`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idSearch_History_UNIQUE` (`id`),
  ADD KEY `fk_Search_History_Users1_idx` (`users_id`);

--
-- Indexes for table `tips`
--
ALTER TABLE `tips`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_Tips_Users1_idx` (`users_id`),
  ADD KEY `fk_Tips_Destinations1_idx` (`destinations_id`);

--
-- Indexes for table `tw_accounts`
--
ALTER TABLE `tw_accounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_TW_Accounts_Users1_idx` (`users_id`);

--
-- Indexes for table `tw_categories`
--
ALTER TABLE `tw_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idTW_Category_UNIQUE` (`id`);

--
-- Indexes for table `tw_transactions`
--
ALTER TABLE `tw_transactions`
  ADD PRIMARY KEY (`id`,`tw_accounts_id`),
  ADD KEY `fk_TW_Transactions_TW_Accounts1_idx` (`tw_accounts_id`),
  ADD KEY `fk_TW_Transactions_TW_Categories1_idx` (`tw_categories_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idUser_UNIQUE` (`id`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`),
  ADD UNIQUE KEY `username_UNIQUE` (`username`),
  ADD KEY `fk_User_User_Roles_idx` (`user_roles_id`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vacations`
--
ALTER TABLE `vacations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_Vacations_Users1_idx` (`users_id`),
  ADD KEY `fk_Vacations_Destinations1_idx` (`destinations_id`);

--
-- Indexes for table `wifi_finder`
--
ALTER TABLE `wifi_finder`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idWifi_Finder_UNIQUE` (`id`),
  ADD KEY `fk_Wifi_Finder_Locations1_idx` (`locations_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activities`
--
ALTER TABLE `activities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ambassador_categories`
--
ALTER TABLE `ambassador_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `common_phrases`
--
ALTER TABLE `common_phrases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `contact_form`
--
ALTER TABLE `contact_form`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `days`
--
ALTER TABLE `days`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `destinations`
--
ALTER TABLE `destinations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `exp_levels`
--
ALTER TABLE `exp_levels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `forum_categories`
--
ALTER TABLE `forum_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `forum_replies`
--
ALTER TABLE `forum_replies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `forum_topics`
--
ALTER TABLE `forum_topics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `invoice_line_items`
--
ALTER TABLE `invoice_line_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `itinerary_items`
--
ALTER TABLE `itinerary_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `location_categories`
--
ALTER TABLE `location_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `phone_finder`
--
ALTER TABLE `phone_finder`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `search`
--
ALTER TABLE `search`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `search_history`
--
ALTER TABLE `search_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `tips`
--
ALTER TABLE `tips`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tw_accounts`
--
ALTER TABLE `tw_accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tw_categories`
--
ALTER TABLE `tw_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tw_transactions`
--
ALTER TABLE `tw_transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `vacations`
--
ALTER TABLE `vacations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `wifi_finder`
--
ALTER TABLE `wifi_finder`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `activities`
--
ALTER TABLE `activities`
  ADD CONSTRAINT `fk_Activities_Days1` FOREIGN KEY (`days_id`,`days_Vacations_id`) REFERENCES `days` (`id`, `vacations_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `common_phrases`
--
ALTER TABLE `common_phrases`
  ADD CONSTRAINT `fk_Common_Phrases_Destinations1` FOREIGN KEY (`destinations_id`) REFERENCES `destinations` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `contact_form`
--
ALTER TABLE `contact_form`
  ADD CONSTRAINT `fk_contactForm_usersId` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `days`
--
ALTER TABLE `days`
  ADD CONSTRAINT `fk_Days_Vacations1` FOREIGN KEY (`vacations_id`) REFERENCES `vacations` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_users_id` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `forum_replies`
--
ALTER TABLE `forum_replies`
  ADD CONSTRAINT `forum_replies_ibfk_1` FOREIGN KEY (`forum_topics_id`) REFERENCES `forum_topics` (`id`),
  ADD CONSTRAINT `forum_replies_ibfk_2` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `forum_topics`
--
ALTER TABLE `forum_topics`
  ADD CONSTRAINT `forum_topics_ibfk_1` FOREIGN KEY (`forum_categories_id`) REFERENCES `forum_categories` (`id`),
  ADD CONSTRAINT `forum_topics_ibfk_2` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `fk_Invoices_Users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `invoice_line_items`
--
ALTER TABLE `invoice_line_items`
  ADD CONSTRAINT `fk_Invoice_Line_Items_Invoices1` FOREIGN KEY (`invoices_id`) REFERENCES `invoices` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Invoice_Line_Items_Products1` FOREIGN KEY (`products_id`) REFERENCES `products` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `itinerary_items`
--
ALTER TABLE `itinerary_items`
  ADD CONSTRAINT `id_activities_vacations_fk` FOREIGN KEY (`vacation_id`) REFERENCES `vacations` (`id`);

--
-- Constraints for table `locations`
--
ALTER TABLE `locations`
  ADD CONSTRAINT `id_destinations_id` FOREIGN KEY (`destinations_id`) REFERENCES `destinations` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `id_exp_levels_id` FOREIGN KEY (`exp_levels_id`) REFERENCES `exp_levels` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `id_location_categories_id` FOREIGN KEY (`location_categories_id`) REFERENCES `location_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `phone_finder`
--
ALTER TABLE `phone_finder`
  ADD CONSTRAINT `fk_Phone_Finder_Locations1` FOREIGN KEY (`locations_id`) REFERENCES `locations` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_Products_Locations1` FOREIGN KEY (`locations_id`) REFERENCES `locations` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Products_Product_Categories1` FOREIGN KEY (`product_categories_id`) REFERENCES `product_categories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `search_history`
--
ALTER TABLE `search_history`
  ADD CONSTRAINT `fk_Search_History_Users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tips`
--
ALTER TABLE `tips`
  ADD CONSTRAINT `fk_Tips_Destinations1` FOREIGN KEY (`destinations_id`) REFERENCES `destinations` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Tips_Users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tw_accounts`
--
ALTER TABLE `tw_accounts`
  ADD CONSTRAINT `fk_TW_Accounts_Users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tw_transactions`
--
ALTER TABLE `tw_transactions`
  ADD CONSTRAINT `fk_TW_Transactions_TW_Accounts1` FOREIGN KEY (`tw_accounts_id`) REFERENCES `tw_accounts` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_TW_Transactions_TW_Categories1` FOREIGN KEY (`tw_categories_id`) REFERENCES `tw_categories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_User_User_Roles` FOREIGN KEY (`user_roles_id`) REFERENCES `user_roles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `vacations`
--
ALTER TABLE `vacations`
  ADD CONSTRAINT `fk_Vacations_Destinations1` FOREIGN KEY (`destinations_id`) REFERENCES `destinations` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Vacations_Users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `wifi_finder`
--
ALTER TABLE `wifi_finder`
  ADD CONSTRAINT `fk_Wifi_Finder_Locations1` FOREIGN KEY (`locations_id`) REFERENCES `locations` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
