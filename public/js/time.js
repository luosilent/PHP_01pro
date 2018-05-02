function show(){
    var now = new Date(); 
    var hour = now.getHours()<10 ? '0'+now.getHours() : now.getHours();
    var minute = now.getMinutes()<10 ? '0'+now.getMinutes() : now.getMinutes();
    var second = now.getSeconds()<10 ? '0'+now.getSeconds() : now.getSeconds();
    var time = now.getFullYear()+"年"+(now.getMonth()+1)+"月"+now.getDate()+"日\r"+"星期"+'日一二三四五六'.charAt(now.getDay())+"\r"+hour+":"+minute+":"+second;
    document.all.time.innerHTML = time;
    setTimeout("show()",1000);
}