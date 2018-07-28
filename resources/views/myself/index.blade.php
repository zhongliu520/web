<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>自己玩</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=0.5, maximum-scale=2.0, user-scalable=yes" />
</head>
<style>
    body
    {
        margin: 0;
        padding: 0;
    }

    .main {
        max-width: 640px;
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

    .img_list
    {
        width: 100%;
    }


    .img_li{
        width: 33%;
        float: left;
        overflow: hidden;
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
