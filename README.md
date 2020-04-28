## Jonas's Journey

Simple blog web app using Laravel developed to document Jonas's every day life from day 0.

### Writing and publishing posts

Posts are stored in `/storage/app/blog-posts` folder. All `*.md` files there are published
in alphabetical order, so ideally filename = timestamp for ordering is desirable.

First line ought to be a post heading, otherwise exception is thrown.

For private stuff, use 

```
@private
that stuff that only you want to see
images, videos

@endprivate
```

Only users logged in as admin user are able to see those bits.