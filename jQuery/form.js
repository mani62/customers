$(document).ready(function(){
    $("#add-form").submit(function(event){
        var validation = validateForm();
        event.preventDefault();
        if (validation === true) {
            var formData = $(this).serialize();
            $.ajax({
                url: "add.php",
                type: "POST",
                data: formData,
                success: function (response) {
                    const data = JSON.parse(response);
                    const alertClass = document.getElementsByClassName('alert');
                    if (data.code == 200) {
                        alertClass[0].classList.add('alert-success');
                        alertClass[0].classList.remove('d-none');
                    } else {
                        alertClass[0].classList.add('alert-danger');
                        alertClass[0].classList.remove('d-none');
                    }
                    $("#add-form")[0].reset();
                    $("#success-message").html(data.message);
                }
            });
        };
    });

    $("#edit-form").submit(function(event){
        var validation = validateForm();
        event.preventDefault();
        if (validation === true) {
            var formData = $(this).serialize();
            $.ajax({
                url: "edit.php",
                type: "POST",
                data: formData,
                success: function (response) {
                    const data = JSON.parse(response);
                    const alertClass = document.getElementsByClassName('alert');
                    if (data.code == 200) {
                        alertClass[0].classList.add('alert-success');
                        alertClass[0].classList.remove('d-none');
                        $("#name").val(data.name);
                        $("#address").val(data.address);
                        $("#telephone").val(data.telephone);
                        $("#email").val(data.email);
                    } else {
                        alertClass[0].classList.add('alert-danger');
                        alertClass[0].classList.remove('d-none');
                    }
                    $("#edit-form")[0].reset();
                    $("#success-message").html(data.message);
                }
            });
        };
    });
});