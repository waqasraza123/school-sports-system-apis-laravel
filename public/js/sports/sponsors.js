$(document).ready(function () {


    /*function searchTwitter(query) {
        $.ajax({
            url: '/sponsors',
            dataType: 'jsonp',
            data: {name: 'chaudhrywaqas12zxsfs'},
            success: function(data) {
                console.log(data)
            },
            error: function (error) {
                console.log(error)
            }
        });
    }
    searchTwitter("he")*/

    var accessToken = null;
    var facebookError = false;
    var twitterError = false;
    var instaError = false;

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

    //when submit button is clicked
    $("#submit_sponsor").click(function (event) {
        event.preventDefault();
        var facebookUrl = ($("#facebook").val()).trim();

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
            if(($("#create_sponsor").val()) == 1){
                var formdata = new FormData($('form')[0]);
                formdata.append('photo', $(".photo")[0]);
                formdata.append('logo', $(".logo")[0]);
                $.ajax({
                    'url': '/sponsors',
                    'method': 'post',
                    'data': formdata,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        console.log(data);
                        $(".alert-custom-success").show('slow');
                        $(".alert-custom-success").text("Sponsor Saved Successfully");
                        $(".alert-custom-success").delay(2000).hide('slow');
                    },
                    error: function (data) {
                        $(".alert-custom-error").show('slow');
                        $.each(data.responseJSON, function (index, value) {
                            $(".alert-custom-error").html('<ul>'+value[0]+'</ul>')
                        });
                        $(".alert-custom-error").delay(2000).hide('slow');
                        console.log(data);
                    }
                })
            }
            //else update the sponsor
            else{
                var sponsorId = $("#sponsor_id").val();
                var formdata = new FormData($('form')[0]);
                formdata.append('photo', $(".photo")[0]);
                formdata.append('logo', $(".logo")[0]);
                $.ajax({
                    'url': '/sponsors/'+sponsorId,
                    'type': 'post',
                    'data': formdata,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        $(".alert-custom-success").show('slow');
                        $(".alert-custom-success").text("Sponsor Updated Successfully");
                        $(".alert-custom-success").delay(2000).hide('slow');
                    },
                    error: function (data) {
                        $(".alert-custom-error").show('slow');
                        $.each(data.responseJSON, function (index, value) {
                            $(".alert-custom-error").html('<ul>'+value[0]+'</ul>')
                        });
                        $(".alert-custom-error").delay(2000).hide('slow');
                        console.log(data);
                    }
                })
            }
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