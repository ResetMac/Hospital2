-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Ноя 18 2017 г., 20:44
-- Версия сервера: 5.5.53
-- Версия PHP: 5.6.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `med_organisations`
--

-- --------------------------------------------------------

--
-- Структура таблицы `academic_degrees`
--

CREATE TABLE `academic_degrees` (
  `id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `academic_degrees`
--

INSERT INTO `academic_degrees` (`id`, `name`) VALUES
(1, 'нет'),
(2, 'кандидат медицинских наук'),
(3, 'доктор медицинских наук');

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='категории врачей';

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Акушер'),
(2, 'Андролог'),
(3, 'Анестезиолог'),
(4, 'Венеролог'),
(5, 'Вирусолог'),
(6, 'Врач общей практики'),
(7, 'Врач скорой помощи'),
(8, 'Врач УЗИ'),
(9, 'Гастроэнтеролог'),
(10, 'Гинеколог'),
(11, 'Дерматолог'),
(12, 'Диетолог'),
(13, 'Зубной врач'),
(14, 'Кардиолог'),
(15, 'Кардиохирург'),
(16, 'Косметолог'),
(17, 'ЛОР'),
(18, 'Мануальный терапевт'),
(19, 'Нарколог'),
(20, 'Невролог'),
(21, 'Невропатолог'),
(22, 'Нейрохирург'),
(23, 'Окулист'),
(24, 'Онколог'),
(25, 'Ортодонт'),
(26, 'Ортопед'),
(27, 'Отоларинголог'),
(28, 'Офтальмолог'),
(29, 'Педиатр'),
(30, 'Проктолог'),
(31, 'Психиатр'),
(32, 'Психолог'),
(33, 'Психотерапевт'),
(34, 'Реаниматолог'),
(35, 'Рентгенолог'),
(36, 'Сексолог'),
(37, 'Терапевт'),
(38, 'Травматолог'),
(39, 'Хирург'),
(40, 'Эндокринолог');

-- --------------------------------------------------------

--
-- Структура таблицы `chambers`
--

CREATE TABLE `chambers` (
  `id` int(10) NOT NULL,
  `numb` varchar(100) NOT NULL,
  `id_department` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='палаты';

--
-- Дамп данных таблицы `chambers`
--

INSERT INTO `chambers` (`id`, `numb`, `id_department`) VALUES
(1, '1-201', 1),
(2, '1-202', 1),
(3, '2-301', 2),
(5, '2-302', 2),
(6, '3-401', 3),
(7, '101', 4),
(8, '102', 4);

-- --------------------------------------------------------

--
-- Структура таблицы `cots`
--

CREATE TABLE `cots` (
  `id` int(10) NOT NULL,
  `numb` varchar(100) NOT NULL,
  `occupied_from` date NOT NULL,
  `occupied_to` date NOT NULL,
  `id_chamber` int(10) NOT NULL,
  `id_patient` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `cots`
--

INSERT INTO `cots` (`id`, `numb`, `occupied_from`, `occupied_to`, `id_chamber`, `id_patient`) VALUES
(2, '201-1', '0000-00-00', '0000-00-00', 1, 1),
(3, '201-2', '2017-11-11', '2017-11-18', 1, 7),
(4, '202-2', '0000-00-00', '0000-00-00', 2, 1),
(5, '202-1', '2017-11-12', '2017-11-23', 2, 3),
(6, '301-1', '2017-11-14', '2017-11-20', 3, 5),
(7, '301-2', '0000-00-00', '0000-00-00', 3, 1),
(8, '302-1', '0000-00-00', '0000-00-00', 5, 1),
(9, '401-1', '2017-11-14', '2017-11-20', 6, 4),
(10, '401-2', '0000-00-00', '0000-00-00', 6, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `departments`
--

CREATE TABLE `departments` (
  `id` int(10) NOT NULL,
  `id_specialization` int(10) NOT NULL,
  `id_housing` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `departments`
--

INSERT INTO `departments` (`id`, `id_specialization`, `id_housing`) VALUES
(1, 5, 1),
(2, 1, 1),
(3, 2, 2),
(4, 6, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `doctors`
--

CREATE TABLE `doctors` (
  `id` int(10) NOT NULL,
  `surname` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `birthdate` date NOT NULL,
  `hiring_date` date NOT NULL,
  `salary` float NOT NULL,
  `last_vacation_from` date NOT NULL,
  `last_vacation_to` date NOT NULL,
  `id_degree` int(10) NOT NULL,
  `id_rank` int(10) NOT NULL,
  `id_category` int(10) NOT NULL,
  `next_vacation_from` date NOT NULL,
  `next_vacation_to` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='врачи';

--
-- Дамп данных таблицы `doctors`
--

INSERT INTO `doctors` (`id`, `surname`, `name`, `lastname`, `birthdate`, `hiring_date`, `salary`, `last_vacation_from`, `last_vacation_to`, `id_degree`, `id_rank`, `id_category`, `next_vacation_from`, `next_vacation_to`) VALUES
(1, 'Кирилов', 'Алексей', 'Анатольевич', '1995-02-14', '2015-09-21', 13200.4, '2017-02-17', '2017-02-28', 2, 3, 6, '2018-03-03', '2018-03-17'),
(2, 'Прилуцкая', 'Виктория', 'Павловна', '1984-11-18', '1997-12-03', 17800.8, '2017-02-14', '2017-02-28', 3, 2, 14, '2018-02-06', '2018-02-18'),
(3, 'Мистякова', 'Яна', 'Олеговна', '1990-07-14', '2005-11-17', 16357.2, '2017-05-19', '2017-06-03', 2, 3, 11, '2018-01-13', '2018-01-28'),
(4, 'Фомичев', 'Вячеслав', 'Петрович', '1986-01-22', '2003-04-26', 18754, '2017-06-18', '2017-07-02', 3, 2, 29, '0000-00-00', '0000-00-00'),
(5, 'Степнёва', 'Анна', 'Михайловна', '1984-03-18', '2000-06-21', 17548.4, '2017-04-25', '2017-05-08', 2, 3, 40, '2018-04-12', '2018-04-26'),
(6, 'Воронец', 'Павел', 'Максимович', '1991-08-15', '2017-08-04', 14568.7, '0000-00-00', '0000-00-00', 1, 1, 39, '0000-00-00', '0000-00-00'),
(7, 'Дмитренко', 'Ирина', 'Анатольевна', '1987-08-17', '2001-09-05', 14259.1, '0000-00-00', '0000-00-00', 2, 3, 21, '2018-02-18', '2018-03-01'),
(8, 'Баньков', 'Максим', 'Викторович', '1989-12-12', '2006-06-28', 18759.6, '2017-01-12', '2017-01-26', 2, 3, 33, '2018-03-03', '2018-03-17');

-- --------------------------------------------------------

--
-- Структура таблицы `doctors_departments`
--

CREATE TABLE `doctors_departments` (
  `id` int(10) NOT NULL,
  `id_doctor` int(10) NOT NULL,
  `id_department` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `doctors_departments`
--

INSERT INTO `doctors_departments` (`id`, `id_doctor`, `id_department`) VALUES
(1, 1, 1),
(2, 1, 3),
(3, 4, 3),
(4, 6, 2),
(5, 3, 1),
(6, 5, 1),
(7, 2, 3),
(8, 7, 4),
(9, 8, 4);

-- --------------------------------------------------------

--
-- Структура таблицы `features`
--

CREATE TABLE `features` (
  `id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='особенности';

--
-- Дамп данных таблицы `features`
--

INSERT INTO `features` (`id`, `name`) VALUES
(1, 'коэффициент к заработной плате (в процентах)'),
(2, 'более длительный отпуск (дней)');

-- --------------------------------------------------------

--
-- Структура таблицы `features_of_categories`
--

CREATE TABLE `features_of_categories` (
  `id` int(10) NOT NULL,
  `value` float NOT NULL,
  `id_category` int(10) NOT NULL,
  `id_feature` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `features_of_categories`
--

INSERT INTO `features_of_categories` (`id`, `value`, `id_category`, `id_feature`) VALUES
(1, 7, 31, 2),
(2, 20, 35, 1),
(3, 10, 3, 1),
(4, 20, 13, 1),
(5, 7, 15, 2),
(6, 20, 15, 1),
(7, 8, 10, 2),
(8, 5, 34, 2),
(9, 7, 38, 2),
(10, 7, 39, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `histories`
--

CREATE TABLE `histories` (
  `id` int(10) NOT NULL,
  `id_pacient` int(10) NOT NULL,
  `date_in` datetime NOT NULL,
  `date_out` datetime NOT NULL,
  `id_doctor` int(10) NOT NULL,
  `diagnosis` varchar(100) NOT NULL,
  `appointment` text NOT NULL,
  `treatment_result` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='истории болезней пациентов';

--
-- Дамп данных таблицы `histories`
--

INSERT INTO `histories` (`id`, `id_pacient`, `date_in`, `date_out`, `id_doctor`, `diagnosis`, `appointment`, `treatment_result`) VALUES
(4, 2, '2017-09-02 11:24:00', '2017-12-03 12:00:00', 8, 'Невротические, связанные со стрессом и соматоформные расстройства', 'Посещение сеансов с психотерапевтом и психологом дважды в неделю в течении месяца', 'Значительное улучшение психосоматического состояния пациента.'),
(5, 3, '2017-02-14 14:20:00', '2017-02-27 16:37:00', 6, 'Перелом пятой пястной кости правой руки без смещения', 'Исключить нагрузки на повреждённую конечность; употреблять кальциесодержащие продукты и витамины.', 'Контролируемое сростание сломанной кости.'),
(6, 4, '2017-08-19 14:22:00', '2017-12-01 12:00:00', 4, 'Искривление позвоночника в районе четвёртого шейного позвонка', 'Упражнения с физиотерапевтом, специализированный массаж, сеанс с мануальным терапевтом.', 'Частичное устранение искривления позвоночника в районе четвёртого шейного позвонка'),
(7, 5, '2017-07-19 10:35:00', '2017-08-28 17:38:00', 6, 'Открытый перелом большого пальца правой ноги', 'Исключить нагрузки на повреждённую ногу; употреблять кальциесодержащие продукты и витамины.', 'Контролируемое сростание сломанной кости, устранение болевых ощущений.'),
(8, 7, '2017-09-11 11:21:00', '2017-09-23 13:47:00', 1, 'Тяжёлая форма простуды', 'Антибиотики цефалоспоринового ряда (Цефиксим (Супракс, Панцеф, Иксим Люпин), Цефуроксим аксетил (Зинацеф, Суперо, Аксетин, Зиннат).', 'Устранение симптомов и последствий простуды.'),
(9, 3, '2016-11-19 17:42:00', '2016-12-03 14:52:00', 6, 'Перелом пятой пястной кости левой руки без смещения', 'Исключить нагрузки на повреждённую конечность; употреблять кальциесодержащие продукты и витамины.', 'Контролируемое сростание сломанной кости.');

-- --------------------------------------------------------

--
-- Структура таблицы `hospitals`
--

CREATE TABLE `hospitals` (
  `id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `hospital` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `hospitals`
--

INSERT INTO `hospitals` (`id`, `name`, `hospital`) VALUES
(1, 'центральная городская больница', 1),
(2, 'городская поликлиника №16', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `housings`
--

CREATE TABLE `housings` (
  `id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `id_hospital` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='корпуса';

--
-- Дамп данных таблицы `housings`
--

INSERT INTO `housings` (`id`, `name`, `id_hospital`) VALUES
(1, 'главный корпус', 1),
(2, 'корпус педиатрии', 1),
(3, 'основной корпус', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `labs`
--

CREATE TABLE `labs` (
  `id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `id_hospital` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='лаборатории';

--
-- Дамп данных таблицы `labs`
--

INSERT INTO `labs` (`id`, `name`, `id_hospital`) VALUES
(1, 'invitro', 1),
(2, 'эталон', 2),
(3, 'KDL', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `occupies`
--

CREATE TABLE `occupies` (
  `id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `occupies`
--

INSERT INTO `occupies` (`id`, `name`) VALUES
(1, 'санитар'),
(2, 'лаборант'),
(3, 'медсестра');

-- --------------------------------------------------------

--
-- Структура таблицы `operations`
--

CREATE TABLE `operations` (
  `id` int(10) NOT NULL,
  `description` text NOT NULL,
  `surname` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `deth` tinyint(1) NOT NULL,
  `id_doctor` int(10) NOT NULL,
  `beginning_time` datetime NOT NULL,
  `ending_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `operations`
--

INSERT INTO `operations` (`id`, `description`, `surname`, `name`, `lastname`, `deth`, `id_doctor`, `beginning_time`, `ending_time`) VALUES
(1, 'У пациента наблюдалась паталогическая мобильность на поврежденном уровне, как следствие перелома позвонка и отклонение от физиологического лордоза. Как результат, предоперационной КТ исследование могло быть только ограниченно использовано для навигации, а 2D флюорография не давала информации в аксиальной проекции. Система O-arm® в комплексе с навигационной станцией StealthStation® позволили хирургу визуализировать процесс подготовки каналов для установки траспедикулярных винтов и саму установку винтов на всех запланированных уровнях. Дополнительно указанная система снизила лучевую нагрузку на хирурга и медицинский персонал.\nПосле установки всех винтов и обоих стержней хирург проконтролировал коррекцию положения фрагментированного позвонка и восстановление физиологического лордоза. В данном примере хирург обнаружил, что фрагмент не вернулся в нормальное положение и принял решение о более агрессивной коррекции. Таким образом, система O-arm позволила избежать второй операции, которая грозила дополнительными расходами для больницы и пациента, но требовалась для улучшения клинических результатов. Дополнительно, это позволило хирургу обеспечить высочайший уровень хирургической помощи пациенту, убедившись, что фрагмент не остался в спинно-мозговом канале.', 'Гродина', 'Ксения', 'Степановна', 0, 6, '2017-02-14 14:28:00', '2017-02-14 17:42:00'),
(2, 'Во время процедуры установки винта хирург может использовать либо две С-дуги, либо одну С-дугу, позиционированную в проекции входа и выхода для визуализации точки входа. Этот частный тип винта устанавливают в область малого таза, что достаточно сложно.\r\nСистема O-arm® была размещена около пациента для трехмерного сканирования области хирургического вмешательства. 3D изображение было передано на навигационную станцию сразу после сканирования. Навигационная станция StealthStation позволила хирургу визуализировать переднюю колонну подвздошной кости и хирургические инструменты еще на этапе прокола кожи, что позволило заранее прицелить инструмент вдоль требуемой траектории ввода винта. Это может помочь снизить риск некорректной установки винта – потенциально улучшить точность и клинический результат проведенного хирургического вмешательства. Возможность использовать O-arm для подтверждения установки винтов интраоперационной имеет огромное значение для пациента, больницы и хирурга, потенциально минимизируя риск возникновения ситуаций, требующих ревизионных хирургических вмешательств.', 'Плетнёв', 'Артур', 'Петрович', 1, 1, '2017-05-11 09:12:00', '2017-05-11 11:58:00'),
(3, 'Для стабилизации пациента требовалось провести фиксацию на три уровня выше и ниже ранее сформированного костного блока. Эту длинную конструкцию требовалось провести через тонкий слой рубцовой ткани, возникшей в результате проводившегося ранее множества операций и облучения. Подготовка к операции проводилась стандартным образом для заднего доступа, использовался операционный стол Джексона. Гентри системы O-arm® было задрапировано и установлено в ногах пациента для облегчения доступа к пациенту и для проведения быстрого повторного сканирования.\r\nПосле драпировки пациента небольшой разрез был сделан над остистым отростком позвонка T5 для установки референционной рамки пациента. Навигационная камера была установлена в голове пациента. Было проведено КТ сканирование с помощью O-arm и данные были загружены на навигацию. Навигационный зонд использовался для аккуратной разметки, дабы избежать повреждения твердой мозговой оболочки и спинного мозга, а также для определения траектории ввода транспедикулярных винтов.\r\nБыла занавигирована дрель с помощью навигационной рамки SureTrak®. С помощью дрели под навигационным контролем были сформированы каналы для винтов. Винты также были установлены под навигационным контролем с помощью навигируемых метчиков и отвертки. После установки винтов было проведено повторное КТ сканирование с помощью O-arm (без навигации) для проверки правильности установки винтов.\r\nРеференционная рамку переместили на остистый отросток позвонка L5, навигационную камеру переместили в ноги пациента. Заново провели КТ сканирование с помощью O-arm нового оперируемого участка анатомии, повторно повторили шаги, описанные ранее для грудного отдела позвоночника. После установки винтов на поясничном отделе заново было проведено КТ сканирование (без навигации) для проверки корректности их установки. У хирурга была возможность безопасно и точно провести винты через обе ножки, и ипсилатерально и контралатерально. Используя систему O-arm с навигацией, становится возможным эффективно проводить эту процедуру, стоя с одной стороны от пациента.', 'Коноренко', 'Дарья', 'Марковна', 0, 6, '2017-09-21 17:15:00', '2017-09-21 17:34:00');

-- --------------------------------------------------------

--
-- Структура таблицы `patients`
--

CREATE TABLE `patients` (
  `id` int(10) NOT NULL,
  `surname` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `birthdate` date NOT NULL,
  `id_department` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `patients`
--

INSERT INTO `patients` (`id`, `surname`, `name`, `lastname`, `birthdate`, `id_department`) VALUES
(1, '-', '-', '-', '0001-01-01', 1),
(2, 'Киреев', 'Семён', 'Петрович', '1988-07-22', 4),
(3, 'Прилуцкий', 'Евгений', 'Павлович', '1992-11-22', 2),
(4, 'Астахова', 'Анна', 'Сергеевна', '2012-02-14', 3),
(5, 'Губченко', 'Валентин', 'Гаврилович', '1995-12-27', 2),
(7, 'Мироненко', 'Мария', 'Власовна', '1986-07-14', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `ranks`
--

CREATE TABLE `ranks` (
  `id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='звания';

--
-- Дамп данных таблицы `ranks`
--

INSERT INTO `ranks` (`id`, `name`) VALUES
(1, 'нет'),
(2, 'профессор'),
(3, 'доцент');

-- --------------------------------------------------------

--
-- Структура таблицы `sections`
--

CREATE TABLE `sections` (
  `id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `id_lab` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='профили лабораторий';

--
-- Дамп данных таблицы `sections`
--

INSERT INTO `sections` (`id`, `name`, `id_lab`) VALUES
(1, 'биохимические исследования', 1),
(2, 'физиологические исследования', 1),
(3, 'химические исследования', 3),
(4, 'биохимические исследования', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `specializations`
--

CREATE TABLE `specializations` (
  `id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `specializations`
--

INSERT INTO `specializations` (`id`, `name`) VALUES
(1, 'травматология'),
(2, 'физиотерапия'),
(3, 'пластическая хирургия'),
(4, 'венерические заболевания'),
(5, 'терапия'),
(6, 'неврология'),
(7, 'кардиология'),
(8, 'гастроэнтерология'),
(9, 'гинекология'),
(10, 'урология');

-- --------------------------------------------------------

--
-- Структура таблицы `staff`
--

CREATE TABLE `staff` (
  `id` int(10) NOT NULL,
  `surname` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `birthdate` date NOT NULL,
  `hiring_date` date NOT NULL,
  `salary` float NOT NULL,
  `last_vacation_from` date NOT NULL,
  `last_vacation_to` date NOT NULL,
  `next_vacation_from` date NOT NULL,
  `next_vacation_to` date NOT NULL,
  `id_occupy` int(10) NOT NULL,
  `id_department` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='обслуживающий персонал';

--
-- Дамп данных таблицы `staff`
--

INSERT INTO `staff` (`id`, `surname`, `name`, `lastname`, `birthdate`, `hiring_date`, `salary`, `last_vacation_from`, `last_vacation_to`, `next_vacation_from`, `next_vacation_to`, `id_occupy`, `id_department`) VALUES
(2, 'Степанков', 'Вячеслав', 'Викторович', '1991-08-14', '2013-03-18', 7854.5, '2017-07-12', '2017-07-26', '2018-08-14', '2018-08-28', 1, 2),
(3, 'Клименко', 'Екатерина', 'Сергеевна', '1990-09-09', '2017-09-24', 9684.9, '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 3, 3),
(4, 'Фок', 'Виктория', 'Ивановна', '1989-11-26', '2017-10-18', 8953.8, '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 3, 2),
(5, 'Газманов', 'Иван', 'Сергеевич', '1987-12-24', '2017-09-17', 7874.9, '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 2, 1),
(6, 'Берия', 'Павел', 'Игоревич', '1988-06-17', '2007-11-12', 7568.7, '2017-08-12', '2017-08-26', '2018-08-19', '2018-09-03', 1, 1),
(7, 'Вольнова', 'Яна', 'Вячеславовна', '1989-12-19', '2009-07-22', 9874.2, '2017-09-18', '2017-09-30', '2018-10-14', '2018-10-29', 3, 4);

-- --------------------------------------------------------

--
-- Структура таблицы `surveys`
--

CREATE TABLE `surveys` (
  `id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `id_lab` int(10) NOT NULL,
  `date_survey` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `surveys`
--

INSERT INTO `surveys` (`id`, `name`, `id_lab`, `date_survey`) VALUES
(1, 'общий анализ крови', 1, '2017-10-14'),
(2, 'общий анализ крови', 1, '2017-10-14'),
(3, 'общий анализ крови', 1, '2017-10-15'),
(4, 'общий анализ крови', 1, '2017-10-16'),
(5, 'анализ спинномозговой жидкости', 2, '2017-10-15');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `login` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `email`) VALUES
(1, 'nufflin', '123456', 'nufflin@ya.ru');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `academic_degrees`
--
ALTER TABLE `academic_degrees`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `chambers`
--
ALTER TABLE `chambers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_department` (`id_department`);

--
-- Индексы таблицы `cots`
--
ALTER TABLE `cots`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_chamber` (`id_chamber`),
  ADD KEY `id_patient` (`id_patient`);

--
-- Индексы таблицы `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_specialization` (`id_specialization`),
  ADD KEY `id_housing` (`id_housing`);

--
-- Индексы таблицы `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_degree` (`id_degree`),
  ADD KEY `id_rank` (`id_rank`),
  ADD KEY `id_category` (`id_category`);

--
-- Индексы таблицы `doctors_departments`
--
ALTER TABLE `doctors_departments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_doctor` (`id_doctor`),
  ADD KEY `id_department` (`id_department`);

--
-- Индексы таблицы `features`
--
ALTER TABLE `features`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `features_of_categories`
--
ALTER TABLE `features_of_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_category` (`id_category`),
  ADD KEY `id_feature` (`id_feature`);

--
-- Индексы таблицы `histories`
--
ALTER TABLE `histories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pacient` (`id_pacient`);

--
-- Индексы таблицы `hospitals`
--
ALTER TABLE `hospitals`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `housings`
--
ALTER TABLE `housings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_hospital` (`id_hospital`);

--
-- Индексы таблицы `labs`
--
ALTER TABLE `labs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_hospital` (`id_hospital`);

--
-- Индексы таблицы `occupies`
--
ALTER TABLE `occupies`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `operations`
--
ALTER TABLE `operations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_doctor` (`id_doctor`);

--
-- Индексы таблицы `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_department` (`id_department`);

--
-- Индексы таблицы `ranks`
--
ALTER TABLE `ranks`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_lab` (`id_lab`);

--
-- Индексы таблицы `specializations`
--
ALTER TABLE `specializations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_occupy` (`id_occupy`),
  ADD KEY `id_department` (`id_department`);

--
-- Индексы таблицы `surveys`
--
ALTER TABLE `surveys`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_lab` (`id_lab`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `academic_degrees`
--
ALTER TABLE `academic_degrees`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT для таблицы `chambers`
--
ALTER TABLE `chambers`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT для таблицы `cots`
--
ALTER TABLE `cots`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT для таблицы `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT для таблицы `doctors_departments`
--
ALTER TABLE `doctors_departments`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT для таблицы `features`
--
ALTER TABLE `features`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `features_of_categories`
--
ALTER TABLE `features_of_categories`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT для таблицы `histories`
--
ALTER TABLE `histories`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT для таблицы `hospitals`
--
ALTER TABLE `hospitals`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `housings`
--
ALTER TABLE `housings`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `labs`
--
ALTER TABLE `labs`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `occupies`
--
ALTER TABLE `occupies`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `operations`
--
ALTER TABLE `operations`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `patients`
--
ALTER TABLE `patients`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT для таблицы `ranks`
--
ALTER TABLE `ranks`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `sections`
--
ALTER TABLE `sections`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `specializations`
--
ALTER TABLE `specializations`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT для таблицы `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT для таблицы `surveys`
--
ALTER TABLE `surveys`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `chambers`
--
ALTER TABLE `chambers`
  ADD CONSTRAINT `chambers_ibfk_1` FOREIGN KEY (`id_department`) REFERENCES `departments` (`id`);

--
-- Ограничения внешнего ключа таблицы `cots`
--
ALTER TABLE `cots`
  ADD CONSTRAINT `cots_ibfk_1` FOREIGN KEY (`id_patient`) REFERENCES `patients` (`id`),
  ADD CONSTRAINT `cots_ibfk_2` FOREIGN KEY (`id_chamber`) REFERENCES `chambers` (`id`);

--
-- Ограничения внешнего ключа таблицы `departments`
--
ALTER TABLE `departments`
  ADD CONSTRAINT `departments_ibfk_1` FOREIGN KEY (`id_specialization`) REFERENCES `specializations` (`id`),
  ADD CONSTRAINT `departments_ibfk_2` FOREIGN KEY (`id_housing`) REFERENCES `housings` (`id`);

--
-- Ограничения внешнего ключа таблицы `doctors`
--
ALTER TABLE `doctors`
  ADD CONSTRAINT `doctors_ibfk_1` FOREIGN KEY (`id_degree`) REFERENCES `academic_degrees` (`id`),
  ADD CONSTRAINT `doctors_ibfk_2` FOREIGN KEY (`id_category`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `doctors_ibfk_3` FOREIGN KEY (`id_rank`) REFERENCES `ranks` (`id`);

--
-- Ограничения внешнего ключа таблицы `doctors_departments`
--
ALTER TABLE `doctors_departments`
  ADD CONSTRAINT `doctors_departments_ibfk_1` FOREIGN KEY (`id_department`) REFERENCES `departments` (`id`),
  ADD CONSTRAINT `doctors_departments_ibfk_2` FOREIGN KEY (`id_doctor`) REFERENCES `doctors` (`id`);

--
-- Ограничения внешнего ключа таблицы `features_of_categories`
--
ALTER TABLE `features_of_categories`
  ADD CONSTRAINT `features_of_categories_ibfk_1` FOREIGN KEY (`id_category`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `features_of_categories_ibfk_2` FOREIGN KEY (`id_feature`) REFERENCES `features` (`id`);

--
-- Ограничения внешнего ключа таблицы `histories`
--
ALTER TABLE `histories`
  ADD CONSTRAINT `histories_ibfk_1` FOREIGN KEY (`id_pacient`) REFERENCES `patients` (`id`);

--
-- Ограничения внешнего ключа таблицы `housings`
--
ALTER TABLE `housings`
  ADD CONSTRAINT `housings_ibfk_1` FOREIGN KEY (`id_hospital`) REFERENCES `hospitals` (`id`);

--
-- Ограничения внешнего ключа таблицы `labs`
--
ALTER TABLE `labs`
  ADD CONSTRAINT `labs_ibfk_1` FOREIGN KEY (`id_hospital`) REFERENCES `hospitals` (`id`);

--
-- Ограничения внешнего ключа таблицы `operations`
--
ALTER TABLE `operations`
  ADD CONSTRAINT `operations_ibfk_1` FOREIGN KEY (`id_doctor`) REFERENCES `doctors` (`id`);

--
-- Ограничения внешнего ключа таблицы `sections`
--
ALTER TABLE `sections`
  ADD CONSTRAINT `sections_ibfk_1` FOREIGN KEY (`id_lab`) REFERENCES `labs` (`id`);

--
-- Ограничения внешнего ключа таблицы `staff`
--
ALTER TABLE `staff`
  ADD CONSTRAINT `staff_ibfk_1` FOREIGN KEY (`id_occupy`) REFERENCES `occupies` (`id`),
  ADD CONSTRAINT `staff_ibfk_2` FOREIGN KEY (`id_department`) REFERENCES `departments` (`id`);

--
-- Ограничения внешнего ключа таблицы `surveys`
--
ALTER TABLE `surveys`
  ADD CONSTRAINT `surveys_ibfk_1` FOREIGN KEY (`id_lab`) REFERENCES `labs` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
