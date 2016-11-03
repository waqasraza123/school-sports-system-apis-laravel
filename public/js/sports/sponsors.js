$(document).ready(function () {

    var accessToken = null;

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

                    FB.api(facebookUrl, function(response) {
                        //alert(response.error.code);
                        console.log(response);
                        if(!response.name){
                            alert('Facebook url is not valid')
                        }
                    });
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

        /*send ajax request to save the data in db*/


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