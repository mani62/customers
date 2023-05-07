$( document ).ready(function() {
    function showDeleteModal(id) {
      $('#deleteModal').data('id', id);
      $('#deleteModal').modal('show');
    }
    
    $('.delete-btn').click(function() {
      var id = $(this).data('id');
      showDeleteModal(id);
    });
    
    $('#confirm-delete-btn').click(function() {
      var id = $('#deleteModal').data('id');
      $.ajax({
        url: 'delete.php',
        type: 'post',
        data: { id: id },
        success: function(data) {
          location.reload();
        }
      });
    });
})