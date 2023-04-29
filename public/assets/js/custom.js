// Profile image
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#imagePreview').css('background-image', 'url('+e.target.result +')');
            $('#imagePreview').hide();
            $('#imagePreview').fadeIn(650);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$("#imageUpload").change(function() {
    readURL(this);
});


// Yes or No Disable
$(document).ready(function(){
    $('input[name="showHideTextbox"]').on('click',function(){
        if($(this).val() === 'show'){
            $('#input1').show();
        }else{
            $('#input1').val('').hide();
        }
    });


    $('input[name="showHideTextbox2"]').on('click',function(){
        if($(this).val() === 'show'){
            $('#input2').show();
        }else{
            $('#input2').val('').hide();
        }
    });

    $('input[name="showHideTextbox"]').on('click',function(){
        console.log($(this).val());
        if($(this).val() === 'hide'){
            $('#input3').show();
        }else{
            $('#input3').val('').hide();
        }
    });


    $('input[name="GenderName"]').on('click',function(){
        if($(this).val() === 'show'){
            $('.input4').show();
        }else{
            $('.input4').val('').hide();
        }
    });

    $('input[name="GenderName"]').on('click',function(){
        if($(this).val() === 'hide'){
            $('.input5').show();
        }else{
            $('.input5').val('').hide();
        }
    });



    
});
    function getPreviousDay(date){
        var date = new Date(date);
        date.setDate(date.getDate() - 1);
        return formatDate(date);
    }

    function formatDate(date) {
        var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();
        if (month.length < 2) 
            month = '0' + month;
        if (day.length < 2) 
            day = '0' + day;

        return [year, month, day].join('-');
    }

    function convertMsToTime(milliseconds) {
        let seconds = Math.floor(milliseconds / 1000);
        let minutes = Math.floor(seconds / 60);
        let hours = Math.floor(minutes / 60);

        seconds = seconds % 60;
        minutes = minutes % 60;
        hours = hours % 24;

        return `${padTo2Digits(hours)}:${padTo2Digits(minutes)}`;
    }

    function padTo2Digits(num) {
        return num.toString().padStart(2, '0');
    }

    function getDatesBetween(startDate, endDate){
        let start_date = new Date(startDate);
        let end_date = new Date(endDate);
        let dates = [];

        let tempDate = new Date(start_date.getTime());
        while(tempDate <= end_date){
            dates.push(formatDate(new Date(tempDate)));
            tempDate.setDate(tempDate.getDate() + 1);
        }
        return dates;
    }

  
    function getDateFormatted(date){
        date = new Date(date);
        year = date.getFullYear();
        month = date.getMonth()+1;
        dt = date.getDate();

        if (dt < 10) {
        dt = '0' + dt;
        }
        if (month < 10) {
        month = '0' + month;
        }
        return year+'-' + month + '-'+dt;
    }
    //get date without the time of day
    function getDateWithoutTime(dts)
    {
        dts.setHours(0,0,0,0);
        return dts;
    }

// function readURL(input) {
//     if (input.files && input.files[0]) {
//         var reader = new FileReader();
//         reader.onload = function(e) {
//             $('#imagePreview').css('background-image', 'url('+e.target.result +')');
//             $('#imagePreview').hide();
//             $('#imagePreview').fadeIn(650);
//         }
//         reader.readAsDataURL(input.files[0]);
//     }
// }
// $("#imageUpload").change(function() {
//     readURL(this);
// });



// $(document).ready(function(){
//     $('input[name="outer-group[0][customRadioInline11]"]').on('click',function(){
//         if($(this).val() === 'show'){
//             $('#input1').show();
//         }else{
//             $('#input1').val('').hide();
//         }
//     });
// });



// $(document).ready(function(){
//     $('input[name="showHideTextbox"]').on('click',function(){
//         if($(this).val() === 'show'){
//             $('#input1').show();
//         }else{
//             $('#input1').val('').hide();
//         }
//     });
// });