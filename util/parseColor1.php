
<?php
// Исходная строка
//$str = "[01test1] [11test2]";

// Функция для замены кодов цветов на соответствующие цвета
function replaceColors($input) {
    // Массив соответствия кодов цветов и их HTML-представлений
    $colors = array(
		'0' => '#000000',   // Black
		'1' => '#0000AA',   // Dark Blue
		'2' => '#00AA00',   // Dark Green
		'3' => '#00AAAA',   // Dark Aqua
		'4' => '#AA0000',   // Dark Red
		'5' => '#AA00AA',   // Dark Purple
		'6' => '#FFAA00',   // Gold
		'7' => '#AAAAAA',   // Gray
		'8' => '#555555',   // Dark Gray
		'9' => '#5555FF',   // Blue
		'a' => '#55FF55',   // Green
		'b' => '#55FFFF',   // Aqua
		'c' => '#FF5555',   // Red
		'd' => '#FF55FF',   // Light Purple
		'e' => '#FFFF55',   // Yellow
		'f' => '#FFFFFF'    // White
	);

    // Разбиваем строку на символы
    $characters = str_split($input);

    // Инициализируем переменные для хранения результата
    $result = "";
    $foreground = null;
    $background = null;
	$skipCount = 0;

    // Проходим по каждому символу
    foreach ($characters as $char) {
        if ($char === '[') {
            // Начало кода цветов
			array_shift($characters); // Пропускаем символ '['
            $foreground = array_shift($characters);
            $background = array_shift($characters);
			$skipCount = 2; // Пропустить два символа 
            $result .= "<span style=\"color: {$colors[$foreground]}; background-color: {$colors[$background]};\">";
        } else if ($char === ']') {
            // Конец кода цветов
            $result .= "</span>";
        } else if ($skipCount > 0) {
            // Пропускаем символы
            $skipCount--;
        } else {
            // Обычный текст
            $result .= $char;
        }
    }
    return $result;
}

// Вызываем функцию для замены кодов цветов
//$result = replaceColors($str);

// Выводим результат
//echo $result;

//#1

///Исходная строка
// $str = "[01test1] [11test2]";

////Функция для замены кодов цветов на соответствующие цвета
// function replaceColors($matches) {
    ////Словарь соответствия кодов цветов и их HTML-представлений
    // $colors = array(
        // '0' => 'black',
        // '1' => 'red',
        // '2' => 'green',
        // '3' => 'yellow',
        // '4' => 'blue',
        // '5' => 'magenta',
        // '6' => 'cyan',
        // '7' => 'white',
        // '8' => 'black',
        // '9' => 'red',
        // 'a' => 'green',
        // 'b' => 'yellow',
        // 'c' => 'blue',
        // 'd' => 'magenta',
        // 'e' => 'cyan',
        // 'f' => 'white'
    // );

    ////Извлекаем коды цветов из совпадений
    // $foreground = $matches[1];
    // $background = $matches[2];

    ////Переводим коды цветов в HTML-представления
    // $foregroundColor = $colors[$foreground];
    // $backgroundColor = $colors[$background];

    ////Формируем готовую строку с цветами
    // return "<span style=\"color: $foregroundColor; background-color: $backgroundColor;\">{$matches[3]}</span>";
// }

////Применяем регулярное выражение с обратным вызовом для замены
// $result = preg_replace_callback('/\[(\w)(\w)(.*?)\]/', 'replaceColors', $str);

////Выводим результат
// echo $result;
?>
