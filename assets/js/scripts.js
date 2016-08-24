(function($){

  if($('#liveButton').length >0){//run livebutton is present.

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

    var canvas = document.getElementById('canvas-source'),
        context = canvas.getContext('2d'),
        source = document.getElementById('source-stream'),
        vendorUrl = window.URL || window.webkitURL;

        navigator.getMedia  = navigator.getUserMedia ||
                            navigator.webkitGetUserMedia ||
                            navigator.mozGetUserMedia ||
                            navigator.msGetUserMedia;

    navigator.getMedia({
      video:true,
      audio:true
    }, function(stream){
      source.src = vendorUrl.createObjectURL(stream);
      //source.src = 'fallback.webm';
      source.onloadedmetadata = function(e) {
        document.getElementById('led').style.visibility = "visible";
        source.play();
      };
    }, function (error){
      console.log(error);
    });

    source.addEventListener('play',function(){
      draw(this,context,500,400);
    },false);

    function draw(source, context, width, height){
      context.drawImage(source, 0, 0,width, height);
      setTimeout(draw,10,source, context, width, height);
    }
  }

  $('#fb-login-btn').click(function(){
    logInWithFacebook();
  });

  $('#create-event').click(function(){
    var event = {
      name: 'Sample Event API',
      description: 'Sample event test using API',
      location: 'Manila Hotel',
      start_time: Math.round(new Date().getTime()/1000.0), // Example Start Date
      end_time: Math.round(new Date().getTime()/1000.0)+86400 // Example End Date
    };

    FB.api('/me/events', 'post', event, function (result) {
      console.log(result);
    });
  });

})(jQuery);
