# Скрипт проверки корректности строки
Скрипт проверяет строку со скобками на соответствие условиям: 
1) Каждой открывающей скобке должна соответствовать своя закрывающая
2) Количество открывающих и закрывающих скобок должно быть одинаковым

## Установка
Работа скрипта проводилась на PHP v.7.2.24. Расположить все файлы из репозитория в одной папке на вебсервере и обращаться к index.php.

## Работа со скриптом
На вход скрипту посылается POST запрос с параметром string в body запроса. В параметре должны присутствовать только скобки, в случае наличия любых других символов скрипт вернет ошибку.
Если на вход скрипту приходит корректная строка, то скрипт вернет ответ с кодом 200 и текстом "Ok" в теле.
В случае ошибки в строке или неправильном запросе скрипт возвращает ответ с кодом 400 и текстом ошибки в теле.

## Описание функций
### checkParenthesis

Функция получает на вход body post запроса проверяет его на наличие параметра string и отсутствие других параметров. После чего проводит проверку на соответствие правильность строки со скобками. 
Также принимает на вход опциональный параметр $option, который может принимать 2 значения:
 - 0 - значение по умолчанию, для проверки будут использоваться регулярные выражения и preg_match
 - 1 - проход по строке и проверка количества символов.