// AJAX functions to update events
function AJAX_REMOVE_EVENT(rowId, optionKey, callback) {
  var ENDPOINT = mcp_ajax_object.ajax_url;
  var DATA = {
    action: "cf7_remove_field",
    rowId: rowId,
    optionKey: optionKey,
  };

  function onError(error) {
    mcp_alerts.error("Error removing your event");
  }

  function onSuccess(response) {
    if (response.success) {
      mcp_alerts.add("Success: Event removed");
      if (callback) callback();
    } else {
      mcp_alerts.error("Error removing event:" + response.data);
    }
  }

  jQuery.ajax({
    type: "POST",
    url: ENDPOINT,
    data: DATA,
    success: onSuccess,
    error: onError,
  });
}

function AJAX_SAVE_EVENTS(data, optionKey) {
  var ENDPOINT = mcp_ajax_object.ajax_url;
  function handleSaveSuccess(response) {
    console.log("success", response);
    mcp_alerts.add("Event saved successfully!");
  }

  function handleSaveError(error) {
    mcp_alerts.error("There was an error saving your event:" + error);
    console.log(error);
  }

  jQuery.ajax({
    type: "POST",
    url: ENDPOINT,
    data: {
      action: "cf7_save_fields",
      data: data,
      optionKey: optionKey,
    },
    success: handleSaveSuccess,
    error: handleSaveError,
  });
}
