-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: MySQL-8.2
-- Время создания: Окт 21 2024 г., 16:17
-- Версия сервера: 8.2.0
-- Версия PHP: 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `sofiaRecipe`
--

-- --------------------------------------------------------

--
-- Структура таблицы `admins`
--

CREATE TABLE `admins` (
  `id` int NOT NULL,
  `admin_login` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `admin_password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `admins`
--

INSERT INTO `admins` (`id`, `admin_login`, `admin_password`) VALUES
(1, '1', '1');

-- --------------------------------------------------------

--
-- Структура таблицы `countries`
--

CREATE TABLE `countries` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `countries`
--

INSERT INTO `countries` (`id`, `name`) VALUES
(1, 'Россия'),
(2, 'Италия'),
(3, 'Франция'),
(4, 'Грузия'),
(5, 'Япония');

-- --------------------------------------------------------

--
-- Структура таблицы `ingredients`
--

CREATE TABLE `ingredients` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `ingredients`
--

INSERT INTO `ingredients` (`id`, `name`) VALUES
(1, 'Мука'),
(2, 'Сахар'),
(3, 'Яйцо'),
(4, '222'),
(5, 'dsadd'),
(6, 'Молоко'),
(7, 'блин'),
(8, '22'),
(9, 'ммм'),
(10, '322'),
(11, 'кАРТОШКА'),
(12, 'Свекла'),
(13, 'ВОда'),
(14, '33'),
(15, 'КАПЦО');

-- --------------------------------------------------------

--
-- Структура таблицы `measurements`
--

CREATE TABLE `measurements` (
  `id` int NOT NULL,
  `unit` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `measurements`
--

INSERT INTO `measurements` (`id`, `unit`) VALUES
(1, 'гр'),
(2, 'мл'),
(3, 'шт');

-- --------------------------------------------------------

--
-- Структура таблицы `recipes`
--

CREATE TABLE `recipes` (
  `id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text,
  `instructions` text,
  `country_id` int DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `recipes`
--

INSERT INTO `recipes` (`id`, `title`, `description`, `instructions`, `country_id`, `image_path`, `created_at`) VALUES
(12, 'Борщ', 'Борщ вкувныый', 'БОрщ борщБОрщ борщБОрщ борщБОрщ борщБОрщ борщБОрщ борщБОрщ борщ', 1, '../images/recipe/recipe_6716143b969cf3.53687474_', '2024-10-21 13:43:39'),
(13, 'Блины', 'Блины — это тонкие лепешки, популярные в русской и многих других кухнях мира. Они могут быть сладкими или солеными, подаются с различными начинками и соусами. Блины традиционно готовят на сковороде, используя муку, яйца и молоко в качестве основных ингредиентов. Они отлично сочетаются с медом, вареньем, сметаной, творогом, икрой и многими другими начинками.', 'Приготовление:\r\nПриготовление теста:\r\n\r\nВ глубокой миске взбейте яйца с сахаром и солью до однородности.\r\nПостепенно добавляйте молоко, продолжая взбивать.\r\nПросейте муку и добавьте её в смесь. Перемешайте, чтобы не было комочков.\r\nВведите растительное масло и тщательно перемешайте тесто. Оно должно быть достаточно жидким.\r\nЖарка блинов:\r\n\r\nРазогрейте сковороду на среднем огне и добавьте немного растительного масла.\r\nНалейте половник теста на сковороду и равномерно распределите его, поворачивая сковороду.\r\nЖарьте блин до золотистой корочки (примерно 1-2 минуты), затем переверните и жарьте с другой стороны еще минуту.\r\nПовторяйте процесс, пока тесто не закончится.\r\nПодача:\r\n\r\nПодавайте блины горячими с вашими любимыми начинками или соусами. Это может быть сметана, мед, варенье, творог или икра.', 1, '../images/recipe/recipe_671618154a19a7.01258996_', '2024-10-21 14:00:05'),
(15, 'Яичница', 'блюдо, приготовляемое на сковороде из разбитых яиц. В русском языке различаются яичница-глазунья, в которой желток должен по возможности остаться целым и сырым, и яичница-болтунья, в которой яйца перемешиваются. Яичница-болтунья, к которой добавляется молоко или другая жидкость, называется омлет', 'блюдо, приготовляемое на сковороде из разбитых яиц. В русском языке различаются яичница-глазунья, в которой желток должен по возможности остаться целым и сырым, и яичница-болтунья, в которой яйца перемешиваются. Яичница-болтунья, к которой добавляется молоко или другая жидкость, называется омлет\r\nблюдо, приготовляемое на сковороде из разбитых яиц. В русском языке различаются яичница-глазунья, в которой желток должен по возможности остаться целым и сырым, и яичница-болтунья, в которой яйца перемешиваются. Яичница-болтунья, к которой добавляется молоко или другая жидкость, называется омлет', 1, '../images/recipe/recipe_67162af9c31ce2.63684476_', '2024-10-21 15:20:41'),
(16, 'Яичница', 'Неверный логин или парольНеверный логин или парольНеверный логин или парольНеверный логин или парольНеверный логин или пароль', 'Неверный логин или парольНеверный логин или парольНеверный логин или парольНеверный логин или парольНеверный логин или парольНеверный логин или парольНеверный логин или парольНеверный логин или парольНеверный логин или парольНеверный логин или парольНеверный логин или парольНеверный логин или парольНеверный логин или парольНеверный логин или парольНеверный логин или парольНеверный логин или парольНеверный логин или парольНеверный логин или парольНеверный логин или парольНеверный логин или парольНеверный логин или парольНеверный логин или парольНеверный логин или парольНеверный логин или пароль', 3, '../images/recipe/recipe_67162b4501aaa2.73443863_', '2024-10-21 15:21:57');

-- --------------------------------------------------------

--
-- Структура таблицы `recipe_ingredients`
--

CREATE TABLE `recipe_ingredients` (
  `id` int NOT NULL,
  `recipe_id` int DEFAULT NULL,
  `ingredient_id` int DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `measurement_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `recipe_ingredients`
--

INSERT INTO `recipe_ingredients` (`id`, `recipe_id`, `ingredient_id`, `amount`, `measurement_id`) VALUES
(15, 12, 11, 2, 3),
(16, 12, 12, 200, 1),
(17, 12, 13, 100, 2),
(18, 13, 6, 200, 2),
(19, 13, 3, 2, 3),
(20, 13, 1, 400, 1),
(22, 15, 3, 3, 3),
(23, 16, 3, 2, 1),
(24, 16, 15, 3, 3);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `ingredients`
--
ALTER TABLE `ingredients`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `measurements`
--
ALTER TABLE `measurements`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `recipes`
--
ALTER TABLE `recipes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `country_id` (`country_id`);

--
-- Индексы таблицы `recipe_ingredients`
--
ALTER TABLE `recipe_ingredients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `recipe_id` (`recipe_id`),
  ADD KEY `ingredient_id` (`ingredient_id`),
  ADD KEY `measurement_id` (`measurement_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `ingredients`
--
ALTER TABLE `ingredients`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT для таблицы `measurements`
--
ALTER TABLE `measurements`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `recipes`
--
ALTER TABLE `recipes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT для таблицы `recipe_ingredients`
--
ALTER TABLE `recipe_ingredients`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `recipes`
--
ALTER TABLE `recipes`
  ADD CONSTRAINT `recipes_ibfk_1` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`);

--
-- Ограничения внешнего ключа таблицы `recipe_ingredients`
--
ALTER TABLE `recipe_ingredients`
  ADD CONSTRAINT `recipe_ingredients_ibfk_1` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`id`),
  ADD CONSTRAINT `recipe_ingredients_ibfk_2` FOREIGN KEY (`ingredient_id`) REFERENCES `ingredients` (`id`),
  ADD CONSTRAINT `recipe_ingredients_ibfk_3` FOREIGN KEY (`measurement_id`) REFERENCES `measurements` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
