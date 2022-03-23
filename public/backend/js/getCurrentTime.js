$(function(){
    currentTime = function()
    {
        var date = new Date(); // today
        console.log(date);
        var thisday=date.getDay();
        var thismonth=date.getMonth();
        var thisdate=date.getDate();
        var thisyear=date.getFullYear();
        var thisminute = String(date.getMinutes()).padStart(2, "0");
        var thishour = String(date.getHours()).padStart(2, "0")
        var thisseconds = String(date.getSeconds()).padStart(2, "0");
        var months = new Array("Tháng Một", "Tháng Hai", "Tháng Ba", "Tháng Tư", "Tháng Năm", "Tháng Sáu", "Tháng Bảy", "Tháng Tám", "Tháng Chín", "Tháng Mười", "Tháng Mười Một", "Tháng Mười Hai");
        var name_of_days = new Array("Chủ nhật", "Thứ Hai", "Thứ Ba", "Thứ Tư", "Thứ Năm", "Thứ Sáu", "Thứ Bảy");
        var day_name = name_of_days[thisday];
        var monthname = months[thismonth];
        var time = day_name+", "+thisdate+" "+monthname+" "+thisyear +', '+ thishour+': '+ thisminute+': ' +thisseconds;

        document.getElementById('getTCurrentTime').innerHTML = time;
    }

    show = function() {
        currentTime();
    }
    show();
    loadTime = function(){
        currentTime();
        setTimeout(loadTime, 1)
    }
    loadTime();
})