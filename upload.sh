#!/usr/bin/env sh

rsync -ariv index.html sites:/home/ajcsites/public_html/feed/
# rsync -ariv feed_generator.php sites:/home/ajcsites/public_html/feed/
rsync -ariv GetFeed.php sites:/home/ajcsites/public_html/feed/
rsync -ariv Feed.php sites:/home/ajcsites/public_html/feed/
