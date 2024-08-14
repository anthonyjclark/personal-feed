<?php

if (isset($_POST)) {

    include_once("Feed.php");

    $body = trim(file_get_contents("php://input"));

    $data = json_decode($body, true);

    $url = $data['url'];
    $type = $data['type'];

    $feed_items = array();
    $error_message = "";

    try {

        if ($type == 'rss') {
            $feed = Feed::loadRss($url);
            $item_list = $feed->item;
        } else {
            $feed = Feed::loadAtom($url);
            $item_list = $feed->entry;
        }

        $blog = htmlspecialchars($feed->title);

        foreach ($item_list as $item) {

            $title = htmlspecialchars($item->title);
            $date = date('D M j Y', (int) $item->timestamp);

            if ($type == 'rss') {
                $link = htmlspecialchars($item->link);
            } else {
                $link = htmlspecialchars($item->link['href']);
            }

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
