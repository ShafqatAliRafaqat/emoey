function __log(e, data) {
    console.log("\n" + e + " " + (data || ''));
  }

  var audio_context;
  var recorder;
  var localstream;
  var currentbtn;
  var recordingstopped;

  function startUserMedia(stream) {
    recordingstopped = true;
    var input = audio_context.createMediaStreamSource(stream);
   __log('Media stream created.' );
	  __log("input sample rate " +input.context.sampleRate);

    // Feedback!
    //input.connect(audio_context.destination);
    __log('Input connected to audio context destination.');

    recorder = new Recorder(input, {
                  numChannels: 1
                });
    __log('Recorder initialised.');
   


    if(!stream.stop && stream.getTracks) {
    stream.stop = function(){         
      this.getTracks().forEach(function (track) {
         track.stop();
      });
    };
  }
   localstream = stream;

   __log('Speak Now...');

    recorder && recorder.record();
    __log('Recording...');

    setTimeout(stopRecording, 16000);
    stopwatch.reset();
     stopwatch.start();

  }
  function stoprecordingandsave()
  {
    stopRecording();
  }

  function stopRecording() {
    if(recordingstopped)
    {
      recordingstopped = false;
        if(typeof localstream != 'undefined')
      {
        localstream.stop();
      }
      recorder && recorder.stop();
      stopwatch.stop();
      disappearnav();
      $('#spinner').show();
      // create WAV download link using audio data blob
       createDownloadLink();
      recorder.clear();
    }
    else{
      recordingstopped = false;
    }

    
  }
   function createDownloadLink() {
    recorder && recorder.exportWAV(function(blob) {
      /*var url = URL.createObjectURL(blob);
      var li = document.createElement('li');
      var au = document.createElement('audio');
      var hf = document.createElement('a');

      au.controls = true;
      au.src = url;
      hf.href = url;
      hf.download = new Date().toISOString() + '.wav';
      hf.innerHTML = hf.download;
      li.appendChild(au);
      li.appendChild(hf);
      recordingslist.appendChild(li);*/
    });
  }

function closeNav()
{
    if(typeof localstream != 'undefined')
    {
      localstream.stop();
    }
    recorder && recorder.stop();
    stopwatch.stop();
    disappearnav();
}
function disappearnav()
{
   document.getElementById("recording_spinner").style.position = "";
    document.getElementById("myNav").style.width = "0%";
}


  function setuprecording()
  {
       try {
      window.AudioContext = window.AudioContext || window.webkitAudioContext;
      navigator.getUserMedia = ( navigator.getUserMedia ||
                       navigator.webkitGetUserMedia ||
                       navigator.mozGetUserMedia ||
                       navigator.msGetUserMedia);
      window.URL = window.URL || window.webkitURL;

      audio_context = new AudioContext;
      __log('Audio context set up.');
      __log('navigator.getUserMedia ' + (navigator.getUserMedia ? 'available.' : 'not present!'));
    } catch (e) {
      alert('No web audio support in this browser!');
    }

    navigator.getUserMedia({audio: true}, startUserMedia, function(e) {
      __log('No live audio input: ' + e);
    });
  }


  window.onload = function init() {

    stopwatch = new Stopwatch(
    document.querySelector('.stopwatch'),
    document.querySelector('.results'));
    

   $('#startrecording').click(function(){
    document.getElementById("myNav").style.width = "100%";
    document.getElementById("recording_spinner").style.position = "fixed";
    setuprecording();
    
    });
   $('#receiverConfirmed').click(function(){
    if(mp3BLOBlocal)
    {
      $('#spinner').show();
      uploadAudio();
    }
    else{
      alert('Nothing recorded yet.');
    }
    
   });
  };

  let stopwatch ;



  class Stopwatch {
    constructor(display, results) {
        this.running = false;
        this.display = display;
        this.results = results;
        this.laps = [];
        this.reset();
        this.print(this.times);
    }
    
    reset() {
        this.times = [ 0, 0, 0];
    }
    
    start() {
        if (!this.time) this.time = performance.now();
        if (!this.running) {
            this.running = true;
            requestAnimationFrame(this.step.bind(this));
        }

    }
    
    lap() {
        let times = this.times;
        if (this.running) {
            this.reset();
        }
        let li = document.createElement('li');
        li.innerText = this.format(times);
        this.results.appendChild(li);
    }
    
    stop() {
        this.running = false;
        this.time = null;
    }

    restart() {
        if (!this.time) this.time = performance.now();
        if (!this.running) {
            this.running = true;
            requestAnimationFrame(this.step.bind(this));
        }
        this.reset();
    }
    
    clear() {
        clearChildren(this.results);
    }
    
    step(timestamp) {
        if (!this.running) return;
        this.calculate(timestamp);
        this.time = timestamp;
        this.print();
        requestAnimationFrame(this.step.bind(this));
    }
    
    calculate(timestamp) {
        var diff = timestamp - this.time;
        // Hundredths of a second are 100 ms
        this.times[2] += diff / 10;
        // Seconds are 100 hundredths of a second
        if (this.times[2] >= 100) {
            this.times[1] += 1;
            this.times[2] -= 100;
        }
        // Minutes are 60 seconds
        if (this.times[1] >= 60) {
            this.times[0] += 1;
            this.times[1] -= 60;
        }
    }
    
    print() {
        this.display.innerText = this.format(this.times);
    }
    
    format(times) {
        return `\
${pad0(times[0], 2)}:\
${pad0(times[1], 2)}`;
    }
}

function pad0(value, count) {
    var result = value.toString();
    for (; result.length < count; --count)
        result = '0' + result;
    return result;
}

function clearChildren(node) {
    while (node.lastChild)
        node.removeChild(node.lastChild);
}


