-- phpMyAdmin SQL Dump
-- version 4.7.1
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Июн 09 2017 г., 08:36
-- Версия сервера: 10.0.29-MariaDB-0ubuntu0.16.04.1
-- Версия PHP: 7.0.15-0ubuntu0.16.04.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `eav`
--

-- --------------------------------------------------------

--
-- Структура таблицы `attributes`
--

CREATE TABLE `attributes` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('text','checkbox','select','radio','textarea') COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `attributes`
--

INSERT INTO `attributes` (`id`, `name`, `slug`, `type`, `options`, `created_at`, `updated_at`) VALUES
(41, 'Size', 'size', 'checkbox', '{\"l\":\"L\",\"s\":\"S\",\"m\":\"M\",\"xl\":\"XL\",\"xxl\":\"XXL\"}', '2017-06-07 20:10:28', '2017-06-07 20:15:16'),
(42, 'Colors', 'colors', 'select', '{\"red\":\"Red\",\"green\":\"Green\"}', '2017-06-07 20:17:22', '2017-06-07 20:17:22'),
(44, 'Display', 'display', 'select', '{\"1\":\"IPS\",\"2\":\"TFT\"}', '2017-06-08 13:54:59', '2017-06-08 13:54:59'),
(48, 'Text', 'text', 'text', '[]', '2017-06-08 17:47:45', '2017-06-08 17:47:45'),
(49, 'Checkbox', 'checkbox', 'checkbox', '{\"key1\":\"value1\",\"key2\":\"value2\",\"key3\":\"value3\"}', '2017-06-08 17:48:39', '2017-06-08 17:48:39'),
(50, 'Select', 'select', 'select', '{\"key1\":\"VALUE1\",\"key2\":\"VALUE2\",\"key3\":\"VALUE3\",\"key4\":\"VALUE4\"}', '2017-06-08 17:49:32', '2017-06-08 18:21:20'),
(51, 'Radio', 'radio', 'radio', '{\"key1\":\"value1\",\"key2\":\"value2\"}', '2017-06-08 17:50:00', '2017-06-08 17:50:00'),
(52, 'TextArea', 'textarea', 'textarea', '[]', '2017-06-08 17:50:17', '2017-06-08 17:50:17');

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `description` text,
  `attributes` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `attributes`, `created_at`, `updated_at`) VALUES
(3, 'PC2', 'Описание товара:\r\n* быстро\r\n* дешево\r\n\r\nДоставка.', '[41]', '2017-06-08 14:54:26', '2017-06-08 16:34:15'),
(4, 'TV', NULL, '[44,48,49,50,51,52]', '2017-06-08 15:00:46', '2017-06-08 18:18:00');

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2017_06_06_210936_create_categories_table', 1),
(5, '2017_06_06_211644_create_products_table', 2),
(6, '2017_06_07_162146_create_params_table', 3);

-- --------------------------------------------------------

--
-- Структура таблицы `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `category_id` int(10) UNSIGNED DEFAULT NULL,
  `s_description` text,
  `img` varchar(191) DEFAULT 'noimage..jpg',
  `status` tinyint(3) UNSIGNED NOT NULL,
  `quantity` int(10) UNSIGNED DEFAULT NULL,
  `price` float DEFAULT NULL,
  `params` text,
  `description` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `name`, `category_id`, `s_description`, `img`, `status`, `quantity`, `price`, `params`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Iphone', 3, 'Short Description', 'noimage..jpg', 1, 10, 2500, '{\"41\":[\"l\", \"xxl\"],\"42\":\"dsdsad\",\"40\":[\"l\",\"s\"]}', 'Description', '2017-06-08 19:38:36', '2017-06-08 19:38:36'),
(2, 'Macbook pro 2017', 4, 'Short Description', 'noimage..jpg', 1, 5, 3000.5, '{\n  \"48\": \"Bla Bla Bla\",\n  \"49\": [\n    \"key1\",\n    \"key3\"\n  ],\n  \"50\": \"key1\",\n  \"51\": \"key2\",\n  \"52\": \"bla, bla\\ndsadkksad\\nasddsad\"\n}', 'Description', '2017-06-08 20:59:18', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `attributes`
--
ALTER TABLE `attributes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `params_slug_unique` (`slug`);

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_categories_fk` (`category_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `attributes`
--
ALTER TABLE `attributes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_categories_fk` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
