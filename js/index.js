/**
 * Created by JacksonM on 2017-01-18.
 */


 var urlArticle = "https://api.nytimes.com/svc/search/v2/articlesearch.json";
 parameterArticle = {
    'api-key': "7755f142b80f445bac80a3a3c1a88a16",
    'q': "how to save money",
    'fl': "web_url,headline,snippet"
};
/**
 * this esection gets all the article
 */
$.get(urlArticle,parameterArticle,function (data) {
       var dataString = JSON.stringify(data);
    postAny(home+"controller/indexController.php",{articles:dataString},".articles",null)
    });