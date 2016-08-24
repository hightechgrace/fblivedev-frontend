<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Facebook Live!</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.0/css/font-awesome.min.css" rel="stylesheet" >
    <link href="assets/css/mdb.min.css" rel="stylesheet">
    <link href="assets/css/styles.css" rel="stylesheet">
  </head>
  <body>
    <script>
      logInWithFacebook = function() {
        FB.login(function(response) {
          if (response.authResponse) {
            update_name_fb(response.authResponse.userID);
          } else {
            document.getElementById('fb-login-btn').style.display = 'block';
            document.getElementById('user-info').style.display = 'none';
            alert('User cancelled login or did not fully authorize.');
          }
        });
        return false;
      };

    function update_name_fb(uid) {
      if(uid){
        var pic = 'http://graph.facebook.com/'+uid+'/picture?type=square';
        document.getElementById('fbpic').src  = pic;
      }

      FB.api('/me', function(response) {
        document.getElementById('fb-name').innerHTML  = response.name;
        document.getElementById('fb-login-btn').style.display = 'none';
        document.getElementById('user-info').style.display = 'block';
      });
    }

      window.fbAsyncInit = function() {
        FB.init({
          appId      : '1600275956936839',
          xfbml      : true,
          version    : 'v2.7'
        });

        FB.getLoginStatus(function(response) {
          if (response.status === 'connected') {
            update_name_fb(response.authResponse.userID);
          //} else if (response.status === 'not_authorized') {
          } else {
            document.getElementById('fb-login-btn').style.display = 'block';
            document.getElementById('user-info').style.display = 'none';
          }
        });
      };


      (function(d, s, id){
         var js, fjs = d.getElementsByTagName(s)[0];
         if (d.getElementById(id)) {return;}
         js = d.createElement(s); js.id = id;
         js.src = "//connect.facebook.net/en_US/sdk.js";
         fjs.parentNode.insertBefore(js, fjs);
       }(document, 'script', 'facebook-jssdk'));
    </script>
    <div class="container">

        <!--<div class="jumbotron">
          <h1>Facebook Live Api Test</h1>
          <div class="booth">
            <video id="source-stream" width="500" height="400" autoplay></video>
            <canvas id="canvas-source" width="500" height="400"></canvas>
            <div id="led"></div>
          </div>
          <p><button type="button" class="btn btn-success" id="liveButton">Create FB Live Stream</button></p>
        </div>-->
        <div class="fb-event">
          <div class="jumbotron">
            <h3>Facebook Live</h3>
            <!--<button id="auth-check" type="button" class="btn btn-primary">Check Auth</button>-->
            <button id="fb-login-btn" type="button" class="btn btn-fb"><i class="fa fa-facebook left"></i> Login to Facebook</button>
            <div id="user-info" class="alert alert-info" role="alert">Logged in as: <img width="24" height="24" id="fbpic" src="assets/img/fb.png"/> <span id="fb-name"></span></div>
            <button id="liveButton" type="button" class="btn btn-success">Go Live!</button>
          </div>
          <div class="card" style="display:none">
              <img class="img-fluid" src="http://mdbootstrap.com/images/regular/nature/img%20(28).jpg" alt="Card image cap">
              <div class="card-block">
                  <!--Title-->
                  <h4 class="card-title">New Event</h4>
                  <!--Text-->
                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>

                  <!--<div class="md-form">
                      <i class="fa fa-calendar-o prefix"></i>
                      <input type="text" id="e_name" class="form-control">
                      <label for="e_name">Event Name</label>
                  </div>
                  <div class="md-form">
                      <i class="fa fa-compass prefix"></i>
                      <input type="text" id="e_loc" class="form-control">
                      <label for="e_loc">Location</label>
                  </div>-->
                  <form class="form-horizontal">
                    <div class="form-group">
                      <div class="col-sm-12">
                        <input type="text" class="form-control" id="inputPassword3" placeholder="Event Name">
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-sm-12">
                        <input type="text" class="form-control" id="inputPassword3" placeholder="Location">
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-sm-12">
                        <input type="text" class="form-control" id="inputPassword3" placeholder="Event Name">
                      </div>
                    </div>
                  </form>

              </div>
          </div>
        </div>
    </div>
    <script>
    document.getElementById('liveButton').onclick = function() {
      FB.ui({
        display: 'popup',
        method: 'live_broadcast',
        phase: 'create',
    }, function(response) {
        if (!response.id) {
          alert('dialog canceled');
          return;
        }
        alert('stream url:' + response.secure_stream_url);
        FB.ui({
          display: 'popup',
          method: 'live_broadcast',
          phase: 'publish',
          broadcast_data: response,
        }, function(response) {
        alert("video status: \n" + response.status);
        });
      });
    };
    </script>
    <script src="assets/js/jquery-2.2.3.min.js"></script>
    <script src="assets/js/tether.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/scripts.js"></script>
  </body>
</html>
