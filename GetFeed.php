<?php

if (isset($_POST)) {

    include_once("Feed.php");

    $body = trim(file_get_contents("php://input"));

    $data = json_decode($body, true);

    $url = $data['url'];

    $feed_items = array();
    $error_message = "";

    try {

        $rss = Feed::loadRss($url);

        $blog = htmlspecialchars($rss->title);

        foreach ($rss->item as $item) {

            $title = htmlspecialchars($item->title);
            $link = htmlspecialchars($item->link);
            $date = date('D M j Y', (int) $item->timestamp);

            array_push($feed_items, array(
                'blog' => $blog,
                'title' => $title,
                'link' => $link,
                'date' => $date
            ));

        }

    } catch (FeedException $e) {

        $error_message = $e->getMessage();
        $error_message .= " <a href='$url'>$url</a>";

    }

    $json_data = json_encode([
        "feed_items" => $feed_items,
        "error_html" => $error_message
    ]);

    echo $json_data;

}

?>
