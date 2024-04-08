<?php

// TODO: no feed?
// "https://blog.m-ou.se/feed.xml",
// "https://www.righto.com/feeds/posts/default",
// "https://engineeringmedia.com/blog-index.xml"

// TODO: add error handling for no feed or changed feed

include_once("Feed.php");

$ARTICLES_PER_FEED = 10;
$ARTICLES_TO_DISPLAY = 20;

$feed_items = array();

$error_items = array();

$rss_urls = array(
    "https://andrewkelley.me/rss.xml",
    "https://xeiaso.net/blog.rss",
    "https://www.gingerbill.org/article/index.xml",
    "https://fasterthanli.me/index.xml",
    "https://briancallahan.net/blog/feed.xml",
    "https://www.yet-another-blog.com/index.xml"
);

foreach ($rss_urls as $url) {

    try {
        $rss = Feed::loadRss($url);
    } catch (FeedException $e) {
        array_push($error_items, $url);
        continue;
    }

    $blog = htmlspecialchars($rss->title);

    $count = 0;

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

        $count++;
        if ($count >= $ARTICLES_PER_FEED) {
            break;
        }

    }
}

$atom_urls = array(
    "https://jvns.ca/atom.xml",
    "https://xkcd.com/atom.xml",
    "https://css-tricks.com/feed/",
    "https://nullprogram.com/feed/",
    "https://eli.thegreenplace.net/feeds/all.atom.xml",
    "https://raphlinus.github.io/feed.xml",
    "https://jalammar.github.io/feed.xml",
    "https://ciechanow.ski/atom.xml",
    "https://matklad.github.io/feed.xml",
    "http://wingolog.org/feed/atom"
);

foreach ($atom_urls as $url) {

    try {
        $atom = Feed::loadAtom($url);
    } catch (FeedException $e) {
        array_push($error_items, $url);
        continue;
    }

    $blog = htmlspecialchars($atom->title);

    $count = 0;

    foreach ($atom->entry as $entry) {

        $title = htmlspecialchars($entry->title);
        $link = htmlspecialchars($entry->link['href']);
        $date = date('D M j Y', (int) $entry->timestamp);

        array_push($feed_items, array(
            'blog' => $blog,
            'title' => $title,
            'link' => $link,
            'date' => $date
        ));

        $count++;
        if ($count >= $ARTICLES_PER_FEED) {
            break;
        }

    }
}

usort($feed_items, function ($a, $b) {
    return strtotime($b['date']) - strtotime($a['date']);
});

$feed_html = '';

$count = 0;

foreach ($feed_items as $item) {

    $feed_html .= "<div class='feed-item'>\n";
    $feed_html .= "  <h4><a href='$item[link]'>$item[title]</a></h4>\n";
    $feed_html .= "  <p>$item[date]</p>\n";
    $feed_html .= "  <p>$item[blog]</p>\n";
    $feed_html .= "</div>\n";

    $count++;
    if ($count >= $ARTICLES_TO_DISPLAY) {
        break;
    }

}

$error_html = '';

foreach ($error_items as $item) {
    $error_html .= "<li>Error loading feed: $item</li>\n";
}

// Return feed_html feed and error list
$return_json = array(
    'feed_html' => $feed_html,
    'error_html' => $error_html
);

echo json_encode($return_json);

?>
