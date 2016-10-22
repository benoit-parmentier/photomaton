  <div style="display: inline-block; margin: 40px;">
    <video id="video" width="1024" height="768" autoplay></video>
  </div>

  <div style="display: inline-block;">
    <div style="margin: 20px;">
      <canvas id="canvas1" width="480" height="320"></canvas>
    </div>
    <div style="margin: 20px;" >
      <canvas id="canvas2" width="480" height="320"></canvas>
    </div>
  <div id="time" style="font-size: 100px">Photomaton : 5</div>
  </div>

  <script>

    // Put event listeners into place
    window.addEventListener("DOMContentLoaded", function() {
      // Grab elements, create settings, etc.
            var canvas = document.getElementById('canvas');
            var context1 = canvas1.getContext('2d');
            var context2 = canvas2.getContext('2d');
            var video = document.getElementById('video');
            var mediaConfig =  { video: true };
            var errBack = function(e) {
              console.log('An error has occurred!', e)
            };

      // Put video listeners into place
            if(navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
                navigator.mediaDevices.getUserMedia(mediaConfig).then(function(stream) {
                    video.src = window.URL.createObjectURL(stream);
                    video.play();
                });
            }

            /* Legacy code below! */
            else if(navigator.getUserMedia) { // Standard
        navigator.getUserMedia(mediaConfig, function(stream) {
          video.src = stream;
          video.play();
        }, errBack);
      } else if(navigator.webkitGetUserMedia) { // WebKit-prefixed
        navigator.webkitGetUserMedia(mediaConfig, function(stream){
          video.src = window.webkitURL.createObjectURL(stream);
          video.play();
        }, errBack);
      } else if(navigator.mozGetUserMedia) { // Mozilla-prefixed
        navigator.mozGetUserMedia(mediaConfig, function(stream){
          video.src = window.URL.createObjectURL(stream);
          video.play();
        }, errBack);
      }

      var i = 0;
      var time = 5;

      window.setInterval(function () {
        if(time == 0){
          if(i==0){
            context1.drawImage(video, 0, 0, 480, 320)
            i++;
          }else if(i==1){
            context2.drawImage(video, 0, 0, 480, 320);
            i=0;
          }
          time = 5;
        }else{
          time--;
        }
        if(time == 0 || time == 1){
          document.getElementById('time').innerHTML = "CHEESE !!!!!";
        }else{
          document.getElementById('time').innerHTML = "Photomaton : " + time;
        }
      }, 1000);
    }, false);

  </script>
