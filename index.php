<html>
<head>
  <style>
    .shapeCanvas {
      margin: 0px;
      padding: 0px;
      border: 1px solid #d3d3d3;
    }

    .wrapper {
      text-align: center;
    }

    .button {
      border: none;
      color: white;
      padding: 15px 32px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      font-size: 16px;
      margin: 4px 2px;
      cursor: pointer;
    }

    .record {
      background-color: #4CAF50;
    }

    .stopRecord {
      background-color: #f44336;
    }
  </style>
</head>
<body>
  <canvas id="shapeCanvas" class="shapeCanvas"></canvas>
  <div class=wrapper>
    <p>
      <button id=record class="center button record">Start</button>
      <button id=stopRecord class="center button stopRecord" disabled>Stop</button>
    </p>
  </div>

  <?php include 'shape.php';?>
  <?php include 'record.php';?>
</body>
</html>


<!-- <html>
<head>
  <style>
    #record {
      background-color: red; /* Green */
      border-width: medium;
      border-color: black;
      color: white;
      padding: 20px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      font-size: 16px;
      margin: 4px 2px;
      cursor: pointer;
      max-width: 50%;
      max-height: 15%;
      border-radius: 50%;
      left: 100px;
      right: 100px;
      position: relative;
    }

    #stopRecord {
      background-color: green; /* Green */
      border-width: medium;
      border-color: black;
      color: white;
      padding: 20px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      font-size: 16px;
      margin: 4px 2px;
      cursor: pointer;
      max-width: 50%;
      max-height: 15%;
      border-radius: 50%;
      left: 100px;
      right: 100px;
      position: relative;
    }

    #recordedAudio {
      left: 100px;
      right: 100px;
      position: relative;
    }
  </style>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
  <p>
    <button id=record></button>
    <button id=stopRecord disabled>Stop</button>
  </p>
  <p>
    <audio id=recordedAudio></audio>
  </p>

  <script>
    navigator.mediaDevices.getUserMedia({audio:true})
      .then(stream => {handlerFunction(stream)})


    function handlerFunction(stream) {
      rec = new MediaRecorder(stream);
      rec.ondataavailable = e => {
        audioChunks.push(e.data);
        if (rec.state == "inactive"){
          let blob = new Blob(audioChunks,{type:'audio/wav'});
          recordedAudio.src = URL.createObjectURL(blob);
          recordedAudio.controls=true;
          recordedAudio.autoplay=true;
          sendData(blob)
        }
      }
    }
            
    function sendData(soundBlob) {
      var xhr = new XMLHttpRequest();
      xhr.onload=function(e) {
          if(this.readyState === 4) {
              console.log("Server returned: ",e.target.responseText);
          }
      };
      var fd = new FormData();
      fd.append("audio_data",soundBlob, 'test');
      xhr.open("POST","upload.php",true);
      xhr.send(fd);
    }

    record.onclick = e => {
      console.log('I was clicked')
      record.disabled = true;
      record.style.backgroundColor = "blue"
      stopRecord.disabled=false;
      audioChunks = [];
      rec.start();
    }
    
    stopRecord.onclick = e => {
      console.log("I was clicked")
      record.disabled = false;
      stop.disabled=true;
      record.style.backgroundColor = "red"
      rec.stop();
    }
  </script>
</body>
</html> -->