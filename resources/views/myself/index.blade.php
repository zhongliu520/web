<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>自己玩</title>
</head>
<style>
    body
    {
        margin: 0;
        padding: 0;
    }

    .main {
        min-width: 640px;
        margin: 0 auto;
    }

    .top
    {
        height: 80px;
        width: 100%;
        background: indianred;
        margin: 0;

    }

    .body
    {
        width: 100%;
        background: darkgoldenrod;
        height: 700px;
    }

    .img_li{
        width: 33%;
        float: left;
    }

</style>
<body>
<div class="main">
    <div class="top"></div>
    <div class="body">
        <input type="file" accept="image/gif,image/jpeg,image/jpg,image/png,image/svg" onchange="upImg(this)" />
        <div class="img_list">


        </div>
    </div>
</div>

</body>
</html>

<script>

    function upImg(obj){
        var imgFile = obj.files[0];
        console.log(imgFile);
        var img = new Image();
        var fr = new FileReader();

        console.log(fr.result);
        fr.onload = function(){
            var tag = document.getElementsByClassName("img_list")[0].innerHTML;

            tag += "<div class=\"img_li\"><img src=\""+fr.result+"\" /></div>";

            document.getElementsByClassName("img_list")[0].innerHTML = tag;
            console.log(fr.result);
        }
        fr.readAsDataURL(imgFile);
    }
</script>
