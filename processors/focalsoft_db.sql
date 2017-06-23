-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 20, 2017 at 10:30 AM
-- Server version: 10.0.30-MariaDB-cll-lve
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `focalsoft_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `contact_person` varchar(255) NOT NULL,
  `contact_number` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `website` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `name`, `contact_person`, `contact_number`, `email`, `website`, `type`, `status`) VALUES
(1, 'Justg Services', 'Sandile Gazu', '0734626608', 'sandile@justg.co.za', 'justg.co.za', 'partner', ''),
(2, 'Twinkle Partys', 'Palesa Dlamini', '', '', '', '', ''),
(3, 'Makatini Group', 'Futhi Nkabinde', '', 'nnkabinde@makatini.com', 'solbeth.co.za', '', ''),
(4, 'Ethekwini Kanvas', 'Sandile Khanyile', '', '', 'ethekwinikanvas.co.za', '', ''),
(5, 'The Empire', 'Andile Thusi', '0769699399', '', 'thempire.co.za', 'partner', ''),
(6, 'the modern man', 'Mluleki Qwabe', '', '', '', '', ''),
(7, 'Shalom Diamonds', 'Matha Mvelase', '', '', '', '', ''),
(8, 'black unicorn', 'Senzo Myeza', '', '', '', '', ''),
(9, 'kp33 business solutions', 'mashego', '', '', '', '', ''),
(10, 'zwilezawesome', 'Senama Thusi', '', '', '', '', ''),
(11, 'forex daily', 'Nhlanhla Ndwandwe', '', '', '', '', ''),
(12, 'azania le beauty spa', 'Nonkazimulo Ngcobo', '', '', '', '', ''),
(13, 'factory automation services', 'Michelle', '', '', 'fas-sa.co.za', '', ''),
(14, 'off campus homes', 'Kwanele Mngoma', '', '', 'offcampushomes.co.za', '', ''),
(15, 'thaboys', 'Thabile Bukhosini', '', '', 'thaboys.co.za', '', ''),
(16, 'black diamond', 'Mthethwa', '', '', '', '', ''),
(17, 'ubuntu kapital', 'Mluleki Qwabe', '', '', '', '', ''),
(18, 'Qwabe Store', 'Mluleki Qwabe', '', '', '', '', ''),
(19, 'sparkle', 'Nondumiso', '', '', 'houseofsparkle.co.za', '', ''),
(20, 'Spirit Motion', 'Moses N Mokgoko', '0760114359', 'info@spiritmotion.co.za', 'blackmotionmusic.com', '', ''),
(21, 'Beyond Classics', 'Samuel Wyne Gumbi', '060 748 0151', '', '', '', ''),
(22, 'Kudzai', 'Kudzai', '', '', '', '', ''),
(23, 'Sweet Green', 'King Mathe', '', '', '', '', ''),
(24, 'Uvolwethu Communications', 'Mfundo Shozi', '', '', '', '', 'partner'),
(25, 'Dinu Afrika', 'Mawande Nzama', '', '', 'dinuafrika.com', '', 'partner'),
(26, 'OCH', 'Kwanele Mngoma', '', '', '', '', ''),
(27, 'Maboni', 'Maboni Ngcobo', '', '', '', '', ''),
(28, 'Life Renewal Church', 'Mr SM Mdletshe', '', '', '', '', ''),
(29, '', 'Yommy Jireh', '0748343898', 'yommyyjazzy@gmail.com', '', '', 'lead'),
(30, '', 'Praise Khumalo', '0760114359', 'creamhninks@gmail.com', '', '', 'lead'),
(31, 'Kazoo Black', 'Nkululeko Khumalo', '071 725 3423', '', '', '', ''),
(32, 'Isiziba Sensindiso', 'Zemfundo Zulu', '071 940 2879', '', '', '', ''),
(33, '', 'Kwanele Mngoma', '0710816162', 'kwanele@focalsoft.co.za', '', '', 'lead'),
(34, 'AFRi-ESM', 'Mthokozisi', '', '', '', '', ''),
(35, 'SG Forex Institute', 'Sbongiseni Zondi', '', '', 'sgforexinstitute.co.za', '', ''),
(36, 'The Empire', 'Andile Thusi', '0769699399', '', '', '', ''),
(37, 'Awina', 'Awina Bawuthi', '0785264019', 'awina.bawuthi@gmail.com', '', '', 'lead'),
(38, 'amanda asanda construction and projects', 'philanigoodboy', '0721111419', 'nomndayi033@gmail.com', '', '', 'lead'),
(39, '', 'Praise', '0760114359', 'creaminks@gmail.com', '', '', 'lead'),
(40, 'start-up', 'simphiwe', '0839759373', 'varsityvibecarwash@gmail.com', '', '', 'lead');

-- --------------------------------------------------------

--
-- Table structure for table `leads`
--

CREATE TABLE `leads` (
  `id` int(11) NOT NULL,
  `package` varchar(255) NOT NULL,
  `service_type` varchar(355) NOT NULL,
  `date` varchar(250) NOT NULL,
  `owner` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `leads`
--

INSERT INTO `leads` (`id`, `package`, `service_type`, `date`, `owner`) VALUES
(1, '', 'logo-design', '1495708304', 38),
(2, 'startup starter', '', '', 39),
(3, '', 'website-development', '1497620469', 40);

-- --------------------------------------------------------

--
-- Table structure for table `work`
--

CREATE TABLE `work` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `start_date` varchar(255) NOT NULL,
  `end_date` varchar(255) NOT NULL,
  `views` int(11) NOT NULL,
  `client` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work`
--

INSERT INTO `work` (`id`, `name`, `image`, `type`, `description`, `start_date`, `end_date`, `views`, `client`) VALUES
(1, 'abner group', 'abner-group.jpg', '1', 'The client required a logo that would represent its client well as a company.', '13 May 2016', '13 May 2016', 0, 1),
(2, 'twinkle partyz', 'twinkle.jpg', '1', 'The client needed a logo redesign for a fresher new look.', '16 June 2016', '16 June 2016', 0, 2),
(3, 'parkies project & civils', 'parkies.jpg', '1', 'The client required a logo that would represent its client well as a company.', '', '', 0, 1),
(4, 'solbeth', 'solbeth.jpg', '1', 'The client needed a logo redesign for a fresher new look.', '15 October 2016', '15 October 2016', 0, 3),
(5, 'ethekwini kanvas', 'ethekwini-kanvas.jpg', '1', 'The client required a logo that would represent it as company.', '', '', 0, 4),
(6, 'PLD', 'pld.jpg', '1', ' The client required a logo that would represent it as company.', '', '', 0, 5),
(7, 'the modern man', 'modern-man.jpg', '1', ' The client required a logo that would represent it as company.', '', '', 0, 6),
(8, 'shalom diamonds', 'shalom-diamonds.jpg', '1', 'The client required a logo that would represent it as company.', '', '', 0, 7),
(9, 'black unicorn', 'black-unicorn.jpg', '1', 'The client required a logo that would represent it as company.', '', '', 0, 8),
(10, 'kp33 business solutions', 'kp33.jpg', '1', 'The client required a logo that would represent it as company.', '', '', 0, 9),
(11, 'Galelo', 'galelo-website.jpg', '3', 'The client required a website design and development for online sales.', '', '', 0, 10),
(12, 'forex daily', 'forex-daily.jpg', '1', 'The client required a logo that would represent it as company.', '', '', 0, 11),
(13, 'zanilele construction', 'zanilele.jpg', '1', 'The client required a logo that would represent its client well as a company.', '', '', 0, 1),
(14, 'kp33 business solutions', 'kp33-stationary.jpg', '4', 'The client required a logo that would represent its client well as a company.', '', '', 0, 9),
(15, 'azania le beauty spa', 'azania-spa.jpg', '1', '', '', '', 0, 12),
(16, 'factory automation services', 'fas-sa-website.jpg', '2', ' The client required a basic website design and development to serve as an online brochure.', '', '', 0, 13),
(17, 'mazibs', 'mazibs.jpg', '1', 'The client required a logo that would represent its client well as a company.', '', '', 0, 1),
(18, 'demazane properties', 'demazane.jpg', '1', 'The client required a logo that would represent its client well as a company.', '', '', 0, 1),
(19, 'concrete structure', 'subbie.jpg', '1', 'The client required a logo that would represent its client well as a company.', '', '', 0, 1),
(20, 'off campus homes', 'och.jpg', '1', 'The client required a logo that would represent it as company.', '', '', 0, 14),
(21, 'thaboys', 'thaboys.jpg', '1', 'The client required a logo that would represent it as company.', '', '', 0, 15),
(22, 'black diamond', 'black-diamond.jpg', '1', 'The client needed a logo redesign for a fresher new look.', '', '', 0, 16),
(23, 'fish and fried', 'fish-fried.jpg', '1', 'The client required a logo that would represent it as company.', '', '', 0, 1),
(24, 'ubuntu kapital', 'ubuntu-kapital.jpg', '1', 'The client required a logo that would represent it as company.', '', '', 0, 17),
(25, 'kassie flops', 'kassie-flops.jpg', '4', 'Our client need a eye-candy poster for his new kassie flops.', '', '', 0, 10),
(26, 'aquadeem', 'aquadeem.jpg', '1', 'The client required a logo that would represent it as company.', '', '', 0, 1),
(27, 'qwabe store', 'qwabe-store.jpg', '1', 'Our client needed a logo that would represent it as company.', '', '', 0, 0),
(28, 'sparkle', 'sparkle.jpg', '1', 'The client required a logo that would represent it as company.', '', '', 0, 17),
(29, 'Galelo Online Store', 'galelo-logo.jpg', '1', 'Our long-time client wanted to build a new online store for his business, so he requested that we design him a logo that would represent his company. It had to be simple, yet professional.', '', '', 0, 10),
(30, 'Beyond Classic', 'beyond-classic.jpg', '1', 'Beyond Classic needed a logo that would represent it as a gentleman company. The look had to be simple and elegant, with white and black you can\'t go wrong.', '', '', 0, 21),
(31, 'Leather Products', 'kudzai-poster.jpg', '4', '', '', '', 0, 22),
(32, 'Oyigugu', 'oyigugu.jpg', '1', '', '', '', 0, 1),
(33, 'SAFX', 'safx.jpg', '1', '', '', '', 0, 24),
(34, 'KP33', 'kp33-website.jpg', '2', '', '', '', 0, 9),
(35, 'Sweet Green', 'sweetgreen.jpg', '1', '', '', '', 0, 23),
(36, 'Sweet Green', 'sweetgreen-website.jpg', '2', '', '', '', 0, 23),
(37, 'Just G', 'justg.jpg', '4', '', '', '', 0, 1),
(38, 'MMCSA', 'mmcsa-website.jpg', '2', '', '', '', 0, 25),
(39, 'OCH', 'och-website.jpg', '2', '', '', '', 0, 26),
(40, 'L United FC', 'lfc.jpg', '4', '', '', '', 0, 24),
(41, 'The Modern Man', 'tmm-website.jpg', '2', '', '', '', 0, 6),
(42, 'The Empire', 'thempire.jpg', '1', '', '', '', 0, 5),
(43, 'Black Motion', 'blackmotion-website.jpg', '2', 'One of the most progressive band in South Africa, approached us to build them a website that would be a platform where their fans could interact more with them. The website had to be vibrant yet simple. ', '', '', 0, 20),
(44, 'Life Renewal Centre', 'lrc-shoot.jpg', '5', '', '', '', 0, 28),
(45, 'Mr & Mrs Ngcobo', 'first-wedding-shoot.jpg', '5', '', '', '', 0, 27),
(46, 'Mrs Xulu Birthday', 'xulu-birthday-shoot.jpg', '5', '', '', '', 0, 3),
(47, 'Makatini Group', 'makatini-group-event.jpg', '5', '', '', '', 0, 3),
(48, 'The Modern Man', 'tmm-gateway-shoot.jpg', '5', '', '', '', 0, 6),
(49, 'Solbeth', 'solbeth-branding.jpg', '4', '', '', '', 0, 6),
(50, 'Kazooblack', 'kazoo.jpg', '1', 'A new clothing label company, requested us to design them a very simple yet distinctive logo. The color-scheme had to be black and white.', '', '', 0, 31),
(51, 'Isiziba Sensindiso', 'isiziba.jpg', '1', '', '', '', 0, 32),
(52, 'Sport First', 'sport-first.jpg', '1', '', '', '', 0, 24),
(53, 'AFRI-ESM First Meetup', 'afri-esm.jpg', '5', '', '', '', 0, 34),
(54, 'The Modern Man Photoshoot', 'mlu-mpilo.jpg', '5', 'The Modern Man is one of our key clients and strategic partner. This shoot, Mpilonhle was featured as a guest model for the March publication on The Modern Man <a href=\"http://www.themodernman.co.za/post/10/the-simply-guy\">website</a> ', '', '', 0, 6),
(55, 'Black Diamond Launch', 'black-diamond-shoot.jpg', '5', 'Our client was a launching a new fashion brand. So they needed to make a statement of what they stand for as a brand and what they represent', '', '', 0, 16),
(56, 'SG Forex Website', 'sgforex.jpg', '2', '', '', '', 0, 35),
(57, 'Qwabo Security', 'qwabo.jpg', '2', '', '', '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `work_type`
--

CREATE TABLE `work_type` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `visibility` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_type`
--

INSERT INTO `work_type` (`id`, `name`, `visibility`) VALUES
(1, 'Logo Design', 'show'),
(2, 'Website', 'show'),
(3, 'Ecommerce Website', 'show'),
(4, 'Branding', 'show'),
(5, 'photography', 'show');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leads`
--
ALTER TABLE `leads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `work`
--
ALTER TABLE `work`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `work_type`
--
ALTER TABLE `work_type`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `leads`
--
ALTER TABLE `leads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `work`
--
ALTER TABLE `work`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
--
-- AUTO_INCREMENT for table `work_type`
--
ALTER TABLE `work_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
