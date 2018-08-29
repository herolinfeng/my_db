function LoadImg(imgID, width_s, height_s) {
    var image = new Image();
    image.src = imgID.src;
    if (image.width > 0 && image.height > 0) {
        flag = true;
        if (image.width / image.height <= width_s / height_s) {
            imgID.width = width_s;
            var height = (image.height * width_s) / image.width;
            imgID.height = height;
            imgID.style.marginTop = -(height - height_s) / 2 + "px";
            // alert("marginTop：" + imgID.style.marginTop);
        } else {
            imgID.height = height_s;
            var width = (image.width * height_s) / image.height;
            imgID.width = width;
            imgID.style.marginLeft = -(width - width_s) / 2 + "px";
            // imgID.style.marginTop = "-16px";
            // alert("marginLeft：" + imgID.style.marginLeft);
        }
    }
}

// https://www.cnblogs.com/yuqingfamily/articles/5798928.html
function printObject(obj) {
    //obj = {"cid":"C0","ctext":"区县"}; 
    var temp = "";
    for (var i in obj) { //用javascript的for/in循环遍历对象的属性 
        temp += i + ":" + obj[i] + "\n";
    }
    alert(temp);
    console.log(temp); //结果：cid:C0 \n ctext:区县 
}