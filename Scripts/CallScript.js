let isMuted = false;
let isVideoOn = true;

function startCall(contactName) {
  const status = document.getElementById("call-status");
  const callerName = document.getElementById("caller-name");

  status.textContent = `In Call with ${contactName}`;
  callerName.textContent = contactName;
  document.getElementById("call-area").style.backgroundColor = "#e6f7ff";
}

function toggleMute() {
  isMuted = !isMuted;
  const muteButton = document.getElementById("mute-button");
  muteButton.innerHTML = isMuted
    ? '<i class="fas fa-microphone-slash"></i>'
    : '<i class="fas fa-microphone"></i>';
}

function toggleVideo() {
  isVideoOn = !isVideoOn;
  const videoButton = document.getElementById("video-button");
  videoButton.innerHTML = isVideoOn
    ? '<i class="fas fa-video"></i>'
    : '<i class="fas fa-video-slash"></i>';
}

function endCall() {
  const status = document.getElementById("call-status");
  const callerName = document.getElementById("caller-name");

  status.textContent = "No Active Call";
  callerName.textContent = "Select a Contact to Start Calling";
  document.getElementById("call-area").style.backgroundColor = "#f9f9f9";
}
