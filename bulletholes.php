<html>


<style>
#container {
    width: 300px;
    height: 300px;
    background-color: #FFF;
}

#target {
    height: 100%;
    background-color: #C00;
    border-radius: 50%;
    position: relative;
    cursor: crosshair;
}

.bullet-hole {
    width: 50px;
    height: 50px;
    background-image: url('https://i.imgur.com/YOjHYjH.gif');
    background-size: cover;
    position: absolute;
}
</style>



<body>

<div id="container">
    <div id="target"></div>
</div>


<script>
$('#target').click(function(e) {
    $('<div />').addClass('bullet-hole').css({
        top: e.offsetY - 5,
        left: e.offsetX - 5
    }).appendTo('#target');
    setTimeout(removeBulletHole, 5000);
});

function removeBulletHole() {
	$('#target .bullet-hole:not(:animated):first').fadeOut(function() {
    	$(this).remove();
    });
}
</script>

</body>
</html>