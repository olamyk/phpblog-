$(document).ready(function(){

ClassicEditor
    .create( document.querySelector( '#body' ), {
        toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote' ],
        heading: {
            options: [
                { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' }
            ]
        }
    } )
    .catch( error => {
        
        console.log( error );
    });

    // alert('Hello word!');


    // CHECKED BOX CODE


$('#selectAllBoxes').click(function(event){

    if (this.checked) {

        $('.checkBoxes').each(function(){

            this.checked = true;
        });

    }else{

        $('.checkBoxes').each(function(){

            this.checked = false;
        });
    }
    });



// let div_box = "<div id='load-screen'><div id='loading'></div></div>";

// $("body").prepend(div_box);

// $('#load-screen').delay(700).fadeOut(600, function(){

//     $(this).remove();
// });

tinymce.init({selector:'textarea'});


});


// document.getElementsById('selectAllBoxes').onClick = function() {

//         var checkBox = document.getElementsByClassName('checkBoxes');
//         for (var checking of checkBox) {

//             checking.checked = this.checked;
//         }
// }



                                            // USING AJAX TO COUNT USERS ONLINE 

// function loadUsersOnline(){

//     $.get("functions.php?onlineusers=result",function(data){

//         $(".usersonline").text(data);

//     });
// }

// setInterval(function(){

//     loadUsersOnline();
// },500);



