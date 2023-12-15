<?php
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
	
    // Инициализируем переменные для хранения результата
    $result = "";
    $foreground = null;
	$skipCount = 0;
	
	for ($index = 0; $index < strlen($input); $index++) {
		$char = $input[$index];
		if ($char === '[') {
            // Начало кода цветов
			$skipCount = 1;
            $foreground = $colors[$input[$index+1]];
            $result .= "<span style=\"color: $foreground;\">";
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

function replaceColorsTwo($input) {
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
	
	// Инициализируем переменные для хранения результата
	$result = "";
    $foreground = null;
	$background = null;
	$skipCount = 0;
	
	for ($index = 0; $index < strlen($input); $index++) {
		$char = $input[$index];
		if ($char === '[') {
            // Начало кода цветов
			$skipCount = 2;
            $foreground = $colors[$input[$index+1]];
			$background = $colors[$input[$index+2]];
            $result .= "<span style=\"color: $foreground; background-color: $background;\">";
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
?>
