<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="color-scheme" content="light dark" />

    <title>Personal Feed</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css" />

    <style>
        .feed-item h4 {
            margin-top: 0.5rem;
        }
        .feed-item h4, .feed-item p {
            margin-bottom: 0;
        }
    </style>

</head>

<body>
    <main class="container">

        <!--
            Libraries:
            - using: https://github.com/dg/rss-php
            - https://github.com/simplepie/simplepie
            - https://github.com/RSS-Bridge/rss-bridge
            - https://github.com/FreshRSS/FreshRSS

            TODO:
            - add more feeds
            - add feeds to array
            - sort array by date

            // "https://andrewkelley.me/rss.xml",
            // "https://jvns.ca/atom.xml",
            // "https://css-tricks.com/archives/feed/",
            // "https://xeiaso.net/blog/feed.xml",
            // "https://nullprogram.com/index.rss",
            // "https://eli.thegreenplace.net/feeds/all.atom.xml",
            // "https://blog.m-ou.se/feed.xml",
            // "https://raphlinus.github.io/feed.xml",
            // "https://jalammar.github.io/feed.xml",
            // "https://growtika.com/blog/feed.xml",
            // "https://www.righto.com/feeds/posts/default",
            // "https://www.gingerbill.org/article/feed.xml",
            // "https://fasterthanli.me/articles/feed.xml",
            // "https://briancallahan.net/blog/feed.xml",
            // "https://ciechanow.ski/feed.xml",
            // "https://www.yet-another-blog.com/feed.xml",
            // "https://engineeringmedia.com/blog-index.xml"
            // xkcd

         -->

        <h1>Personal Feed</h1>

        <?php
        include_once("Feed.php");

        $ARTICLES_PER_FEED = 10;
        $ARTICLES_TO_DISPLAY = 20;

        $feed_items = array();

        $url = "https://andrewkelley.me/rss.xml";
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

            // if (isset($item->{'content:encoded'})) {
            //     $html .= "<div class='item-content'>$item->{'content:encoded'}</div>";
            // } else {
            //     $html .= "<p class='item-description'>$item->description</p>";
            // }

            $count++;
            if ($count >= $ARTICLES_PER_FEED) {
                break;
            }

        }

        $atom_urls = array(
            "https://jvns.ca/atom.xml",
            "https://xkcd.com/atom.xml"
        );

        // loop through atom feeds
        foreach ($atom_urls as $url) {
            $atom = Feed::loadAtom($url);
            $blog = htmlspecialchars($atom->title);

            $count = 0;
            foreach ($atom->entry as $entry) {

                $title = htmlspecialchars($entry->title);
                $link = htmlspecialchars($entry->link['href']);
                $date = date('D M j Y', (int) $entry->timestamp);

                // TODO: show/hide xkcd hover text

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

        // Sort feed items by date
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

            if ($count >= $ARTICLES_TO_DISPLAY) {
                break;
            }

        }

        echo $html;

        ?>

        <script>

    </main >
</body >

</html >
