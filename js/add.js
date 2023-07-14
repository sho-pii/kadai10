
let recognition;

function startSpeechRecognition() {
  recognition = new webkitSpeechRecognition();
  recognition.lang = 'ja-JP';
  recognition.interimResults = true;
  recognition.onresult = function(event) {
    const result = event.results[event.results.length - 1];
    const transcript = result[0].transcript;

    console.log('結果:', transcript);
  };

  recognition.start();
}

function stopSpeechRecognition() {
  if (recognition) {
    recognition.stop();
  }
}

maru.onmousedown = () =>{
  const microphoneIcon = document.querySelector('.fa-solid.fa-microphone.fa-2xl.i-mic');
  microphoneIcon.classList.add('fa-beat');
  maru.style.backgroundColor = 'red';
  maru.style.textDecoration = 'none';
  maru.style.boxShadow = '0 0 #0023b7';
  maru.style.transform = 'translateY(5px)';
  console.log('マウスがクリック中です')
  // 音声認識を開始
  startSpeechRecognition();
} 

maru.onmouseup = () =>{ 
  const microphoneIcon = document.querySelector('.fa-solid.fa-microphone.fa-2xl.i-mic');
  microphoneIcon.classList.remove('fa-beat');
  maru.style.backgroundColor = '';
  maru.style.textDecoration = '';
  maru.style.boxShadow = '';
  maru.style.transform = '';
  console.log('マウスがクリックが離れました')
  // 音声認識を停止
  stopSpeechRecognition();
}

