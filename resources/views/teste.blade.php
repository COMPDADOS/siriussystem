<html>
<head>
<link rel="stylesheet" type="text/css" href="upload_style.css">
<script src="https://code.jquery.com/jquery-3.6.0.js" ></script>
</head>
<body>
<div id="wrapper">
 <input type="file">
 <div id="drop-area">
  <h3 class="drop-text">Drag and Drop Images Here</h3>
 </div>
</div>

<script>
$(document).ready(function()
{
 $("#drop-area").on('dragenter', function (e){
  e.preventDefault();
  $(this).css('background', '#BBD5B8');
 });

 $("#drop-area").on('dragover', function (e){
  e.preventDefault();
 });

 $("#drop-area").on('drop', function (e){
  $(this).css('background', '#D8F9D3');
  e.preventDefault();
  var image = e.originalEvent.dataTransfer.files;
  createFormData(image);
 });
});

function createFormData(image)
{
 var formImage = new FormData();
 formImage.append('userImage', image[0]);
 uploadFormData(formImage);
}

function uploadFormData(formData) 
{
 $.ajax({
 url: "upload_image.php",
 type: "POST",
 data: formData,
 contentType:false,
 cache: false,
 processData: false,
 success: function(data){
  $('#drop-area').html(data);
 }});
}
</script>
</body>
</html>