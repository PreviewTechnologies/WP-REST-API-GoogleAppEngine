####WP REST API via Google App Engine
Serve your wordpress site's POST with WP REST API + Google App Engine (as reverse proxy theoritically) to your visitors.

Super-fast, static-like webpage with your backend WP data.

#### Usage
Just clone this repo. 

- Signup to Google Cloud Platform,  
- Create APP engine project.
- Change Wordpress site url from `public/index.php`
- Change service name to default or whatever your want in `app.yaml` file

Deploy the application in your App Engine by issuing the following command.

`gcloud app deploy --project=YOUR-GOOGLECLOUD-PROJECTID --version=whateverYOUWANT`

Now it's done! you can now browse your Google APP Engine app url something like `****.appspot.com`.

Use this as your WP REST API endpoint and start using. Enjoy serving static pages
with this REST API JSON data.

Facing any trouble, contact me anytime at `shaharia@previewtechs.com`

My article about this implementation are available on [https://blog.shaharia.com/supercharge-wp-rest-api-with-google-app-engine](https://blog.shaharia.com/supercharge-wp-rest-api-with-google-app-engine) 