<?php
$api_key    = '1b57b4142bmsh067b3b000ebb751p1a1dc4jsn78aadfb943e1';
$business_id = 'ChIJLbCYAzht1moRhRhKBSTAd6I';
$place_id    = 'ChIJLbCYAzht1moRhRhKBSTAd6I';
$country     = 'au';
$lang        = 'en';
$limit       = 7;
$sort        = 'Relevant';

$url = "https://maps-data.p.rapidapi.com/reviews.php?" . http_build_query([
    'business_id' => $business_id,
    'place_id'    => $place_id,
    'country'     => $country,
    'lang'        => $lang,
    'limit'       => $limit,
    'sort'        => $sort
]);

$ch = curl_init();

curl_setopt_array($ch, [
    CURLOPT_URL            => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER     => [
        "x-rapidapi-host: maps-data.p.rapidapi.com",
        "x-rapidapi-key: $api_key"
    ]
]);

$response = curl_exec($ch);
curl_close($ch);

if ($response === false) {
    http_response_code(500);
    echo 'Error fetching reviews.';
    exit;
}

$data = json_decode($response, true);

if (isset($data['data']['reviews']) && is_array($data['data']['reviews'])) {
    foreach ($data['data']['reviews'] as $review) {
        $name   = htmlspecialchars($review['user_name']);
        $rating = (int) $review['review_rate'];
        $text   = nl2br(htmlspecialchars($review['review_text']));

        
        if (isset($review['review_time'])) {
            $rawTime = $review['review_time'];
            if (is_numeric($rawTime)) {
                $timestamp = (int) ($rawTime > 9999999999 ? $rawTime / 1000 : $rawTime);
            } else {
                $timestamp = strtotime($rawTime);
            }
        } else {
            $timestamp = time();
        }

        $date = date("F j, Y", $timestamp);

        echo "<div class='reviewSlide' style='display:none;'>";
        echo "<h3>$name</h3>";
        echo "<p class='rating'>Rating: " . str_repeat("★", $rating) . str_repeat("☆", 5 - $rating) . "</p>";
        echo "<p class='reviewText'>$text</p>";
        echo "<p class='reviewDate'><small>$date</small></p>";
        echo "</div>";
    }
} else {
    echo "No reviews found.";
}
?>
