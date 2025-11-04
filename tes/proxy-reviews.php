<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *'); // Engedélyezi a CORS-t

$url = 'https://smart-home.guru/review/latestreviews';
$html = file_get_contents($url);

if ($html === FALSE) {
    echo json_encode(['error' => 'Nem sikerült lekérdezni az értékeléseket.']);
    exit;
}

$reviews = [];
$dom = new DOMDocument();
@$dom->loadHTML($html); // Az @ elnyomja a HTML parsolási hibákat
$xpath = new DOMXPath($dom);

// Az értékelés blokkok kinyerése a megadott HTML struktúra alapján
$reviewBlocks = $xpath->query('//div[contains(@class, "swiper-slide") and contains(@class, "tp-rating-swiper-slide")]');

foreach ($reviewBlocks as $block) {
    $nameElement = $xpath->query('.//div[contains(@class, "common-text-small-bold")]', $block)->item(0);
    $dateElement = $xpath->query('.//span[contains(@class, "padding-left-10") and contains(@class, "common-text-small")]', $block)->item(0);
    $textElement = $xpath->query('.//div[contains(@class, "padding-top-10") and contains(@class, "common-text") and contains(@class, "user-input-html")]', $block)->item(0);
    $imageElement = $xpath->query('.//img[contains(@class, "rating-user-avatar")]', $block)->item(0);

    $name = $nameElement ? trim($nameElement->textContent) : '';
    $date = $dateElement ? trim($dateElement->textContent) : '';
    $text = $textElement ? trim($textElement->textContent) : '';
    $imageUrl = $imageElement ? $imageElement->getAttribute('src') : '';

    // Base64 képek kezelése: ha az src "data:image/jpeg;base64,"-gyel kezdődik, üres stringet adunk vissza
    if (strpos($imageUrl, 'data:image/jpeg;base64,') === 0) {
        $imageUrl = '';
    }
    // Relatív URL-ek abszolúttá alakítása, ha szükséges
    if ($imageUrl && strpos($imageUrl, 'http') !== 0) {
        $imageUrl = 'https://smart-home.guru' . $imageUrl;
    }

    $reviews[] = [
        'name' => $name,
        'date' => $date,
        'text' => $text,
        'imageUrl' => $imageUrl
    ];
}

echo json_encode($reviews);
?>