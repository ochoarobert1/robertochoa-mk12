(function ($) {
  // Store the original quick edit function
  var $wp_inline_edit = inlineEditPost.edit;

  // Override the quick edit function
  inlineEditPost.edit = function (id) {
    // Call the original function
    $wp_inline_edit.apply(this, arguments);

    // Get the post ID
    var post_id = 0;
    if (typeof id === "object") {
      post_id = parseInt(this.getId(id));
    }

    if (post_id > 0) {
      // Get the row with the post
      var $edit_row = $("#edit-" + post_id);
      var $post_row = $("#post-" + post_id);

      // Get featured status from the hidden data or icon
      var is_featured =
        $post_row.find(".column-featured .dashicons-yes").length > 0;

      // Check the box if featured
      $edit_row.find('input[name="ro_featured"]').prop("checked", is_featured);
    }
  };

  // Add bulk edit functionality
  $("#bulk_edit").on("click", function () {
    // Get the selected value
    var featured_value = $('select[name="ro_featured_bulk"]').val();

    // Only proceed if a change was requested
    if (featured_value === "-1") {
      return;
    }

    // Get the post IDs
    var post_ids = [];
    $('input[name="post[]"]:checked').each(function () {
      post_ids.push($(this).val());
    });

    if (post_ids.length === 0) {
      return;
    }

    // Save via AJAX
    $.ajax({
      url: ajaxurl,
      type: "POST",
      data: {
        action: "save_bulk_edit_featured",
        post_ids: post_ids.join(","),
        featured_value: featured_value,
      },
      success: function (response) {
        if (response.indexOf("success") !== -1) {
          // Reload the page to show updated values
          //location.reload();
        }
      },
    });
  });
})(jQuery);
