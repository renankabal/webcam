<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Tirar Fotos</title>
<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<style>
        video { border: 1px solid #ccc; display: block; margin: 0 0 20px 0; }
        #canvas { margin-top: 20px; border: 1px solid #ccc; display: block; }
</style>
</head>
<body>
<div>
	<form name="foto" method="post" action="fotossalvar.php" enctype="multipart/form-data">
	<div><textarea name="imagem" id="foto" style="display:none;"></textarea></div>
	<div><input type="submit" value="Enviar"></div>
	</form>
    <div><video id="video" width="354" height="472" autoplay></video></div>
    <div><button id="snap">Tirar Foto</button></div>
    <div><button id="save">Salvar Foto</button></div>
    <div><canvas id="canvas" width="354" height="472"></canvas></div>
<script>
    window.addEventListener("DOMContentLoaded", function() {
        var canvas = document.getElementById("canvas"),
        context = canvas.getContext("2d"),
        video = document.getElementById("video"),
        videoObj = { "video": true },
        errBack = function(error) {
                console.log("Video capture error: ", error.code); 
        };  
        if(navigator.getUserMedia) {
            navigator.getUserMedia(videoObj, function(stream) {
                video.src = stream;
                video.play();
            }, errBack);
        } else if(navigator.webkitGetUserMedia) {
            navigator.webkitGetUserMedia(videoObj, function(stream){
                video.src = window.webkitURL.createObjectURL(stream);
                video.play();
            }, errBack);
        }
        else if(navigator.mozGetUserMedia) {
            navigator.mozGetUserMedia(videoObj, function(stream){
                video.src = window.URL.createObjectURL(stream);
                video.play();
            }, errBack);
        }
    }, false);
    document.getElementById("snap").addEventListener("click", function() {      
        canvas.getContext("2d").drawImage(video, 0, 0, 354, 472);       
        // alert(canvas.toDataURL());
        $('[name="imagem"]').val('');
        $('[name="imagem"]').val(canvas.toDataURL());
    });
    document.getElementById("save").addEventListener("click", function() {     
        // $('#foto').val('teste');
        $('#foto').val(canvas.toDataURL());
        $.post('fotossalvar.php', $('#foto').val(), function(data){
        },'json');
    });
</script>    
</body>
</html>