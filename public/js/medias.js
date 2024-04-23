// media_form.js

$(document).ready(function () {
  // Function to add additional file input for images
  $('#add-image-btn').click(function () {
    $('#image-field').append('<input type="file" name="trick[image][]" class="form-control mb-3">');
  });

  // Function to add additional file input for videos
  $('#add-video-btn').click(function () {
    $('#videoUrl-field').append('<input type="text" name="trick[videoUrl][]" class="form-control mb-3">');
  });
});