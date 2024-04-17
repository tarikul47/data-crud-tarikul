jQuery(document).ready(function ($) {
  $(".delete-entry").on("click", function (event) {
    event.preventDefault();
    var entryId = $(this).data("id");
    if (confirm("Are you sure you want to delete this entry?")) {
      deleteEntry(entryId);
    }
  });

  function deleteEntry(entryId) {
    var data = {
      action: "db_crud_delete_entry",
      id: entryId,
    };
    $.post(ajaxurl, data, function (response) {
      // Handle success or error response
      if (response.success) {
        // For example, remove the deleted entry from the DOM
        console.log(response);
        window.location.href = response.data.new_url;
      } else {
        alert("Error: " + response.data.message);
      }
    }).fail(function (jqXHR, textStatus, errorThrown) {
      console.error("Error:", errorThrown);
      alert("An error occurred while deleting the entry.");
    });
  }
});
