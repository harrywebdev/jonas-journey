## Jonas's Journey

Simple blog web app using Laravel developed to document Jonas's every day life from day 0.

### Writing and publishing posts

Posts are stored in `/storage/app/blog-posts` folder. All `*.md` files there are published
in alphabetical order, so some kind of prefix `001-` for ordering is desirable.

First line ought to be a post heading, otherwise exception is thrown.

### TODO

[ ] Caching of FS posts
[ ] Custom block parsers/markdown customizations