function toggle_table_remove_btn() {
  var rows = jQuery(".custom-field-row");
  var btn = jQuery(".custom-field-row:not(.db_exist) .cf7-remove-field");
  if (rows.length > 1) {
    btn.fadeIn(100);
  } else {
    btn.fadeOut(300);
  }
}

function mcp_remove_event(e) {
  e.preventDefault();
  var $ = jQuery;
  var remove_button = $(e.currentTarget);
  var row = remove_button.closest(".custom-field-row");
  var id = row.find('input[name="cf7_custom_field_id[]"]').val();
  var optionKey = e.target.dataset.scope;

  if (id) {
    var isConfirmed = confirm("Are you sure you want to remove this event?");
    if (!isConfirmed) return;
    $.ajax({
      type: "POST",
      url: mcp_ajax_object.ajax_url,
      data: { action: "cf7_remove_field", id: id, optionKey: optionKey },
      success: function (response) {
        console.log("response", response.data);
        if (response.success) {
          row.remove();
          mcp_alerts.add("Event removed");
        } else {
          mcp_alerts.error("Error removing event:" + response.data);
        }
      },
      error: function (error) {
        mcp_alerts.error("Error removing your event");
        console.log("Error:", error);
      },
    });
  } else {
    if ($(".custom-field-row").length > 1) {
      row.remove();
    } else {
      if (!mcp_alerts.isVisible()) {
        mcp_alerts.warn("Hmm there should be at least one row in the table");
      }
    }
  }
}

function mcp_save_events(e) {
  e.preventDefault();
  var $ = jQuery;
  var data = [];
  var optionKey = e.target.dataset.scope;
  var hasEmpty = false;
  $("tbody tr").each(function () {
    var location = $(this).find('input[name="cf7_custom_field_name[]"]').val();
    var id = $(this).find('input[name="cf7_custom_field_id[]"]').val();
    var date = $(this).find('input[name="cf7_custom_field_date[]"]').val();
    var time = $(this).find('input[name="cf7_custom_field_time[]"]').val();

    if ([location, id, date, time].filter(Boolean).length === 4) {
      data.push({
        location: location,
        id: id,
        date: date,
        time: time,
      });
    } else {
      hasEmpty = true;
      return false;
    }
  });

  if (!data.length || hasEmpty) {
    mcp_alerts.error("All fields are required");
    return;
  }
  $.ajax({
    type: "POST",
    url: mcp_ajax_object.ajax_url,
    data: {
      action: "cf7_save_fields",
      data: data,
      optionKey: optionKey,
    },
    success: function (response) {
      console.log("success", response);
      mcp_alerts.add("Event saved successfully... page will refresh");
      setTimeout(function () {
        window.location.reload();
      }, 2500);
    },
    error: function (error) {
      mcp_alerts.error("There was an error saving your event:" + error);
      console.log(error);
    },
  });
}
