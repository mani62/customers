$(document).ready(function(){
    $("#add-note-form").submit(function(event){
        event.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            url: "addNote.php",
            type: "POST",
            data: formData,
            success: function(response){
                const data = JSON.parse(response);
                const alertClass = document.getElementsByClassName('alert');
                if(data.code == 200){
                    alertClass[0].classList.add('alert-success');
                    alertClass[0].classList.remove('d-none');
                } else{
                    alertClass[0].classList.add('alert-danger');
                    alertClass[0].classList.remove('d-none');
                }
                $("#add-note-form")[0].reset();
                $("#success-message").html(data.message);
            }
        });
    });
});