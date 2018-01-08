MongoDB library installed using composer.

Initial install using homebrew did not work on MacOS and was giving segfault errors every time the mongoDB library was used.
This was because the homebrew version of mongoDB used the incorrect version of openSSL.

This was fixed by downloading the PECL version of MongoDB and then manually building the code specifying the correct version of openSSL.

Using the api to write to the DB tested using postman with POST request in the format shown below.

POST /simple-api/score HTTP/1.1
Host: localhost:8080
Content-Type: application/json
Cache-Control: no-cache
Postman-Token: f18231ba-64bc-725c-ac45-c4768c3e9888

{
"id":2,
"title":"ssdfsafsaf dfsfaf",
"score":5.0,
"timestamp": 1412180887
}