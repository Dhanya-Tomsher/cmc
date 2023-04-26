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