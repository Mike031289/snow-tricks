// media_form.js

document.getElementById('add-image-btn').addEventListener('click', function () {
  document.getElementById('trick_pictures').style.display = 'block';
  document.getElementById('trick_videos').style.display = 'none';
});

document.getElementById('add-video-btn').addEventListener('click', function () {
  document.getElementById('trick_videos').style.display = 'block';
  document.getElementById('trick_pictures').style.display = 'none';
});
