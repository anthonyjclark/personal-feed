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

$rss_urls = array(
    "https://andrewkelley.me/rss.xml",
    "https://xeiaso.net/blog.rss",
    "https://www.gingerbill.org/article/index.xml",
    // "https://fasterthanli.me/index.xml", TODO: broken?
    // "https://briancallahan.net/blog/feed.xml", TODO: broken?
    "https://www.yet-another-blog.com/index.xml"
);

foreach ($rss_urls as $url) {

    $rss = Feed::loadRss($url);
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
    // "https://css-tricks.com/feed/" TODO: broken?
    "https://nullprogram.com/feed/",
    "https://eli.thegreenplace.net/feeds/all.atom.xml",
    "https://raphlinus.github.io/feed.xml",
    "https://jalammar.github.io/feed.xml",
    "https://ciechanow.ski/atom.xml",
    "https://matklad.github.io/feed.xml",
    "http://wingolog.org/feed/atom"
);

foreach ($atom_urls as $url) {

    $atom = Feed::loadAtom($url);
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

$html = '';

$count = 0;

foreach ($feed_items as $item) {

    $html .= "<div class='feed-item'>\n";
    $html .= "  <h4><a href='$item[link]'>$item[title]</a></h4>\n";
    $html .= "  <p>$item[date]</p>\n";
    $html .= "  <p>$item[blog]</p>\n";
    $html .= "</div>\n";

    $count++;
    if ($count >= $ARTICLES_TO_DISPLAY) {
        break;
    }

}

echo $html;

?>
