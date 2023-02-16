// AJAX functions to update events
function AJAX_REMOVE_EVENT(rowId, optionKey, callback) {
  var ACTION = "cf7_remove_field";
  var ENDPOINT = mcp_ajax_config.endpoint;
  var DATA = {
    action: ACTION,
    rowId: rowId,
    optionKey: optionKey,
  };

  function onError(err) {
    mcp_alerts.error("Error removing your event: " + err);
  }

  function onSuccess(res) {
    if (res.success) {
      mcp_alerts.add("Event was removed successfully");
      callback && callback();
    } else {
      mcp_alerts.error("Error removing event: " + res.data);
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
  var ACTION = "cf7_save_fields";
  var ENDPOINT = mcp_ajax_config.endpoint;

  function handleSaveSuccess(res) {
    console.log("success", res);
    mcp_alerts.add("Event saved successfully!");
  }

  function handleSaveError(err) {
    mcp_alerts.error("There was an error saving your event:" + err);
    console.log(err);
  }

  jQuery.ajax({
    type: "POST",
    url: ENDPOINT,
    data: {
      action: ACTION,
      data: data,
      optionKey: optionKey,
    },
    success: handleSaveSuccess,
    error: handleSaveError,
  });
}
