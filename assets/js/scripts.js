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
  var optionKey = e.target.dataset.scope;
  var tableRow = $(e.currentTarget).closest(".custom-field-row");
  var tableRows = $(".custom-field-row");
  var rowId = tableRow.data("id");

  if (!rowId) {
    switch (true) {
      case tableRows.length > 1:
        tableRow.remove();
        break;
      case tableRows.length === 1 && !mcp_alerts.isVisible():
        mcp_alerts.warn("Hmm there should be at least one row in the table");
        break;
    }
    return;
  }

  var confirmRemove = confirm("Are you sure you want to remove this event?");
  if (confirmRemove) {
    AJAX_REMOVE_EVENT(rowId, optionKey, function () {
      tableRow.remove();
    });
  }
}

function mcp_save_events(e) {
  e.preventDefault();
  var $ = jQuery;
  var DATA = [];
  var OPTION_KEY = e.target.dataset.scope;
  var shouldSaveEvents = false;
  $("tbody tr").each(function () {
    var dataItem = {
      location: $(this).find('input[name="cf7_custom_field_name[]"]').val(),
      eventId: $(this).find('input[name="cf7_custom_field_eventId[]"]').val(),
      date: $(this).find('input[name="cf7_custom_field_date[]"]').val(),
      time: $(this).find('input[name="cf7_custom_field_time[]"]').val(),
    };
    var hasEmptyVal = mcp_utils.objHasEmptyVal(dataItem);
    hasEmpty = hasEmptyVal;

    if (!hasEmptyVal) {
      DATA.push(dataItem);
    }
    shouldSaveEvents = DATA.length && !hasEmptyVal;
  });

  if (shouldSaveEvents) {
    AJAX_SAVE_EVENTS(DATA, OPTION_KEY);
  } else {
    mcp_alerts.error("All fields are required");
  }
}
