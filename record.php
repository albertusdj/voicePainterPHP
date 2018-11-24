<script>
  navigator.mediaDevices.getUserMedia({audio:true})
      .then(stream => {handlerFunction(stream)})


    function handlerFunction(stream) {
      rec = new MediaRecorder(stream);
      rec.ondataavailable = e => {
        audioChunks.push(e.data);
        if (rec.state == "inactive"){
          let blob = new Blob(audioChunks,{type:'audio/wav'});
          sendData(blob)
        }
      }
    }
            
    function sendData(soundBlob) {
      var xhr = new XMLHttpRequest();
      xhr.onload=function(e) {
          if(this.readyState === 4) {
              const json = JSON.parse(xhr.responseText);
              const command = json['command'];

              if (command === "DRAW CIRCLE ONE") {
                addCircle();
              }
              else if (command === "DRAW CIRCLE TWO") {
                addCircle();
                addCircle();
              }
              else if (command === "DRAW CIRCLE THREE") {
                addCircle();
                addCircle();
                addCircle();
              }
              else if (command === "DRAW SQUARE ONE") {
                addRectangle();
              }
              else if (command === "DRAW SQUARE TWO") {
                addRectangle();
                addRectangle();
              }
              else if (command === "DRAW SQUARE THREE") {
                addRectangle();
                addRectangle();
                addRectangle();
              }
              else if (command === "DRAW TRIANGLE ONE") {
                addTriangle();
              }
              else if (command === "DRAW TRIANGLE TWO") {
                addTriangle();
                addTriangle();
              }
              else if (command === "DRAW TRIANGLE THREE") {
                addTriangle();
                addTriangle();
                addTriangle();
              }
              else if (command === "ZOOM IN") {
                zoomIn();
              }
              else if (command === "ZOOM OUT") {
                zoomOut();
              }
              else if (command === "FILL CIRCLE RED") {
                fillCircle(red);
              }
              else if (command === "FILL CIRCLE BLUE") {
                fillCircle(blue);
              }
              else if (command === "FILL CIRCLE GREEN") {
                fillCircle(green);
              }
              else if (command === "FILL SQUARE RED") {
                fillRectangle(red);
              }
              else if (command === "FILL SQUARE BLUE") {
                fillRectangle(blue);
              }
              else if (command === "FILL SQUARE GREEN") {
                fillRectangle(green);
              }
              else if (command === "FILL TRIANGLE RED") {
                fillTriangle(red);
              }
              else if (command === "FILL TRIANGLE BLUE") {
                fillTriangle(blue);
              }
              else if (command === "FILL TRIANGLE GREEN") {
                fillTriangle(green);
              }
              else if (command === "ERASE CIRCLE") {
                eraseCircle();
              }
              else if (command === "ERASE SQUARE") {
                eraseRectangle();
              }
              else if (command === "ERASE TRIANGLE") {
                eraseTriangle();
              }
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
      stopRecord.disabled=false;
      audioChunks = [];
      rec.start();
    }
    
    stopRecord.onclick = e => {
      console.log("I was clicked")
      record.disabled = false;
      stop.disabled = true;
      rec.stop();
    }
</script>