-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 11, 2019 at 01:55 AM
-- Server version: 5.6.44-cll-lve
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pharmacy`
--

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `article` text NOT NULL,
  `date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `title`, `article`, `date`) VALUES
(3, 1, 'le post de reouven', 'text text text text text.', '2019-11-06 02:14:30'),
(4, 3, 'אמאלה איזה אתר !', 'טירוף !!!אמאלה', '2019-11-06 02:40:19'),
(5, 1, 'Post ', 'Post post post', '2019-11-06 04:15:46'),
(7, 7, 'How do you make mosquito bites go away faster?', 'Mosquito bites often result in a small bump that can be itchy and uncomfortable. Home remedies include applying ice, honey, or aloe vera to reduce irritation. Methods of prevention include using mosquito repellent and covering exposed skin.\r\n\r\nIn some parts of the world, mosquitoes can carry diseases. In the United States, it is unlikely that a mosquito bite will cause a disease. However, more disease-carrying mosquitoes are spreading to the U.S. due to factors, such as climate change. This means that the climate in some areas of the U.S. has become a suitable environment for some mosquitoes to live.\r\n\r\nFemale mosquitoes bite animals and humans to drink tiny amounts of their blood, which they need to produce their eggs. The itch that develops occurs because mosquitoes leave a small amount of saliva behind, and a person&#39;s immune system responds by triggering inflammation in the area. This often causes an itchy, uncomfortable bump to develop.\r\n\r\nHome remedies can help reduce the itchiness and discomfort of a mosquito bite. In this article, we examine six treatments that could bring quick relief.\r\n\r\n\r\n1. Ice\r\nCold temperatures slow the rate of inflammation.\r\n\r\nApplying an ice pack to the area as soon after a bite as possible will reduce inflammation, itching, and discomfort. Avoid putting ice directly on the skin, wrap it in a cloth or towel first.\r\n\r\n2. Antihistamines\r\nApplying a topical antihistamine to a bite may help treat itching.\r\nOne study suggested that some antihistamines might be an effective treatmentTrusted Source for mosquito bites.\r\n\r\nHistamine is a chemical that the body releases as part of the inflammatory response to a mosquito bite.\r\n\r\nIt is histamine that causes itching, and antihistamines help to prevent histamine from taking effect.\r\n\r\nPeople can take antihistamines in pill form, but other options include topical creams that a person can apply directly to the bite.\r\n\r\n\r\n3. Hydrocortisone\r\nHydrocortisone cream is a topical medication that can reduce inflammation and itching. Hydrocortisone is available over the counter and on prescription but may not be suitable for everyone. Children, pregnant women, or those with skin infections should not use hydrocortisone cream.\r\n\r\nPeople should use these creams in moderation and only over short periods, or for as long as a doctor recommends in the case of prescription hydrocortisone.\r\n\r\n4. Concentrated heat\r\nConcentrated forms of heat might be useful for treating mosquito bites. One study from 2011Trusted Source in Clinical, Cosmetic and Investigational Dermatology looked at the effectiveness of a device that emits concentrated heat. In most cases, the device was able to reduce the discomfort resulting from insect bites within 10 minutes of its application.\r\n\r\nThe study took place at beaches and bathing lakes in Germany. It is important to note, however, that of the 146 people in the study, only 33 had mosquito bites, with the majority having wasp stings.\r\n\r\n5. Aloe vera\r\nThere is some evidence that aloe vera can treat skin conditions, including psoriasis. It has a wide range of potential uses and people usually apply the gel to the skin to relieve burns, frostbite, and cold sores.\r\n\r\nSome research on ratsTrusted Source showed that Aloe littoralis, which is a close relative to aloe vera, might have anti-inflammatory and wound-healing properties. The scientists concluded that A. littoralis might help reduce the inflammation from mosquito bites and applying a gel may soothe the area, too.\r\n\r\n\r\n6. Honey\r\nHoney may have properties that make it useful for healing wounds. Applying honey to a bite may help reduce inflammation and prevent infection, and in a similar way to aloe, applying it to the skin may also help soothe the area.\r\n\r\nWhen to see a doctor\r\nA person should see a doctor if a bite lasts longer than a week or shows signs of infection.\r\nSometimes, mosquito bites and other insect stings can cause allergic reactions. This can lead to an anaphylactic shock in extreme cases.\r\n\r\nAnyone who experiences any of the following symptoms will require immediate medical attention:\r\n\r\nbreathing problems\r\nhives or swelling\r\nnausea\r\nvomiting\r\ndizziness\r\nIt is also possible for mosquito bites to cause an infection. If the bite lasts longer than a week or causes significant discomfort, consult a doctor.\r\n\r\nPrevention and takeaway\r\nAlthough it is difficult to avoid mosquito bites completely, people can reduce their chances of being bitten by:\r\n\r\nusing insect repellent\r\ncovering exposed skin as much as possible\r\nusing mosquito nets at night\r\ninstalling mosquito screens on windows and doors\r\nbeing aware of visiting places with a high density of mosquitoes or other insects\r\nAvoiding all mosquito bites can be difficult. However, home remedies can help reduce itchiness or irritation and provide comfort until a bite fully heals.\r\n\r\nBites and StingsComplementary Medicine / Alternative Medicine\r\n 10 sourcescollapsed\r\nMedically reviewed by Gerhard Whitworth, RN on November 19, 2018 — Written by Aaron Kandola\r\n\r\n', '2019-11-07 10:38:22'),
(8, 8, 'יצחק ', 'אתר מטורף אחשלי היקר המון הצלחה', '2019-11-07 12:18:45'),
(9, 7, 'Can one protein open the door to West Nile and Zika treatments?', 'The West Nile and Zika viruses are responsible for healthcare emergencies around the world, affecting hundreds of people. Currently, however, there are no antiviral treatments that specifically target these viruses. Can the findings from a new mouse study turn the table on West Nile and Zika?\r\n\r\nOver the past few years, researchers and medical professionals far and wide have joined forces to confront several viral outbreaks.\r\n\r\nTwo of the most concerning outbreaks have been of the West Nile and Zika viruses.\r\n\r\nThe West Nile virus is carried by mosquitoes, and it originally affected only regions in temperate and tropical regions.\r\n\r\nHowever, since it entered the United States in 1999, it has been a constant presence in the country. Rates of infection have been on the rise this past year, with 834 casesTrusted Source across 47 states and the District of Columbia having been reported to the Centers for Disease Control and Prevention (CDC).\r\n\r\nOf these, 65% were severe, leading to neuroinvasive conditions such as meningitis and encephalitis.\r\n\r\n', '2019-11-07 18:34:59'),
(10, 9, 'מהי הדרך הכי טובה להעלים כאבי שיניים?', 'הסיבות העיקריות לכאבי השיניים\r\n1. חורים (עששת) בשיניים: למרות המודעות לשמירה על היגיינת פה וביקורים אצל רופאי שיניים, חורים הם אכן בעיה רצינית. אבל הבעיה האמיתית היא שעד שמתחילים להרגיש את הכאב, מדובר כבר בחור גדול למדי ואז קיימת כבר רגישות לקור, חום או סוכר.\r\n\r\n \r\n\r\n2. דלקת: חור שלא מטפלים בו בזמן יכול להידרדר ולגרום לזיהום ולדלקת חמורה בשן. הדלקת יכולה לגרום לכאב חזק מאוד - בדיוק כזה שמעיר אוצנו בפתאומיות באמצע הלילה. לעתים דלקת כה חמורה יכולה להתפשט גם לחניכיים, לשורשי השיניים או לשיניים בריאות וסמוכות.\r\n\r\n \r\n\r\n3. שן סדוקה: לעתים קרובות השיניים נסדקות או נשברות בגלל מכה או נפילות. במקרים כאלה, הכאב הוא חזק מאוד ולוקח זמן רב עד שניתן לטפל בבעיה.', '2019-11-07 18:45:10');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstName` varchar(255) CHARACTER SET latin1 NOT NULL,
  `lastName` varchar(255) CHARACTER SET latin1 NOT NULL,
  `email` varchar(255) CHARACTER SET latin1 NOT NULL,
  `password` varchar(255) CHARACTER SET latin1 NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstName`, `lastName`, `email`, `password`) VALUES
(8, 'Itshak', 'Benitah', 'itshak09@gmail.com', '$2y$10$Pzv91OYRJ16lxWh9yj2jpeOeCvgjeNwHdJNGR03Fv40Z.10V9k.LC'),
(7, 'Reuven', 'Benitah', 'reu@gmail.com', '$2y$10$CYiP/gEsk1vUg3wcaWlTfe2wyEZxcKfiwb8pMeBPBvTlwfb5Dp60a'),
(6, 'Shimi', 'levi', 'shlo@gmail.com', '$2y$10$Vc9fMudoaeiNoHAMgIfotuBn0sF473zYO0KKLvqeY0ks5f6qRC/AK'),
(3, 'Liran', 'Rouzentur', 'liran@gmail.com', '$2y$10$Ta.hvWN6i8D6Yw9krIPTveYmJuYz.rfUa4yC2Uv3yShicyHkiTv3O'),
(4, 'Dor', 'Levy', 'ddl105095@gmail.com', '$2y$10$83ZbDUktVX7ed4DQg.vdhOgvvdeuw/PbC.NMdFBxmC2sHQPQQIdP.'),
(9, 'Verd', 'levi', 'verd@gmail.com', '$2y$10$KoprRYPV3VVo08RKX98wKue7crgeAPEcAIEaduqBPZHPAbkCBqvg2'),
(10, 'moshe', 'cohen', 'moshe@gmail.com', '$2y$10$.K2bwluEmMB0ObxkZZ6NtelGtbAUtixAUlYD/.68XApfe.Udo4m7G');

-- --------------------------------------------------------

--
-- Table structure for table `users_profile`
--

CREATE TABLE `users_profile` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `profile_image` varchar(255) CHARACTER SET latin1 NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_profile`
--

INSERT INTO `users_profile` (`id`, `user_id`, `profile_image`) VALUES
(1, 1, '2019.11.07.13.09.56-reu.png'),
(2, 2, '2019.11.06.06.19.03-2E8056FF-053A-4FCC-9C66-7A3996642421.jpeg'),
(3, 3, 'defult_profile.png'),
(4, 4, 'defult_profile.png'),
(5, 5, '2019.11.07.13.20.08-0-98.jpg'),
(6, 6, '2019.11.07.14.12.10-reu.png'),
(7, 0, '2019.11.07.15.41.36-defult_profil.png'),
(8, 0, '2019.11.07.15.45.23-image.jpg'),
(9, 7, '2019.11.07.17.37.43-reu.png'),
(10, 0, '2019.11.07.17.39.33-defult_profil.png'),
(11, 8, 'defult_profile.png'),
(12, 9, '2019.11.08.01.44.24-doll-2371117_640.jpg'),
(13, 10, 'defult_profile.png'),
(14, 0, '2019.11.07.17.37.43-reu.png'),
(15, 0, '2019.11.07.17.37.43-reu.png'),
(16, 0, '2019.11.07.17.37.43-reu.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_profile`
--
ALTER TABLE `users_profile`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users_profile`
--
ALTER TABLE `users_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
