$(document).ready(function () {


    /*function httpGetAsync(theUrl, callback)
    {
        var xmlHttp = new XMLHttpRequest();
        xmlHttp.onreadystatechange = function() {
            if (xmlHttp.readyState == 4 && xmlHttp.status == 200)
                callback(xmlHttp.responseText);
        }
        xmlHttp.open("GET", theUrl, true); // true for asynchronous
        xmlHttp.send(null);
    }
    httpGetAsync('https://twitter.com/chaudhrywaqas12', function (response) {
        alert(response);
    });*/

    var accessToken = null;
    var facebookError = false;
    var twitterError = false;
    var instaError = false;

    //when submit button is clicked
    $("#submit_sponsor").click(function (event) {
        event.preventDefault();
        var facebookUrl = ($("#facebook").val()).trim();

        //initialize the facebook api
        window.fbAsyncInit = function() {
            FB.init({
                appId      : '1350095405009348',
                xfbml      : true,
                version    : 'v2.8'
            });
            FB.AppEvents.logPageView();

            FB.login(function(response) {
                if (response.authResponse.accessToken) {
                    var access_token =   FB.getAuthResponse()['accessToken'];
                    console.log('Access Token = '+ access_token);
                    accessToken = access_token;
                } else {
                    console.log('User cancelled login or did not fully authorize.');
                }
            }, {scope: ''});

        };

        (function(d, s, id){
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) {return;}
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/en_US/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));

        if(facebookUrl.includes('facebook.com')){
            FB.api(facebookUrl+'?access_token='+accessToken, function(response) {
                //alert(response.error.code);
                console.log(response);
                if(!response.name){
                    alert('Facebook url is not valid')
                }
            });
        }
        else{
            alert('Facebook url is not valid');
            facebookError = true;
        }

        /*send ajax request to save the data in db*/
        if(!(facebookError && twitterError && instaError)){
            $.ajax({
                'url': '/sponsors',
                'method': 'post',
                'data': $("#sponsor_form").serialize(),
                success: function (data) {
                    $(".alert-success").show('slow');
                    $(".alert-success").text("Sponsor Saved Successfully");
                    $(".alert-success").delay(2000).hide('slow');
                },
                error: function (data) {
                    $(".alert-error").show('slow');
                    $.each(data.responseJSON, function (index, value) {
                        $(".alert").html('<ul>'+value[0]+'</ul>')
                    });
                    $(".alert-error").delay(2000).hide('slow');
                    console.log(data);
                }
            })
        }

    })

    /**
     * check facebook url
     * @param facebookUrl
     */
    function validateFacebookLink(facebookUrl) {
        var fbUrlCheck = '/^(https?:\/\/)?(www\.)?facebook.com\/[a-zA-Z0-9(\.\?)?]/';
        var secondCheck = '/home((\/)?\.[a-zA-Z0-9])?/';
        var validUrl = facebookUrl;
        var result = validUrl.match(fbUrlCheck);
        alert(validUrl);
        if(validUrl.match(fbUrlCheck) == 1 && validUrl.match(secondCheck) == 0) {
            alert ('Facebook URL is valid!');
        } else {
            alert ('Facebook URL is not valid!');
        }
    }
})