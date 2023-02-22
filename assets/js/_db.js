// AJAX functions to update events
class MCPApi {
  constructor() {
    this.endpoint = mcp_ajax_config.endpoint;
  }

  connect(data, onSuccess, onError) {
    const ENDPOINT = this.endpoint;
    jQuery.ajax({
      type: "POST",
      url: ENDPOINT,
      data,
      success: onSuccess,
      error: onError,
    });
  }

  removeEvent(rowId, optionKey, callback) {
    const ACTION = "cf7_remove_field";
    const ENDPOINT = this.endpoint;
    const DATA = {
      action: ACTION,
      rowId,
      optionKey,
    };

    const onError = (err) => {
      mcp_alerts.error("Error removing your event: " + err);
    };

    const onSuccess = (res) => {
      if (res.success) {
        mcp_alerts.add("Event was removed successfully");
        callback && callback();
      } else {
        mcp_alerts.error("Error removing event: " + res.data);
      }
    };

    this.connect(DATA, onSuccess, onError);
  }

  saveEvents(data, optionKey) {
    const ACTION = "cf7_save_fields";
    const ENDPOINT = this.endpoint;
    const DATA = {
      action: ACTION,
      data,
      optionKey,
    };

    const onSuccess = (res) => {
      console.log("success", res);
      window.alert("Event saved successfully!");
      window.location.reload();
    };

    const onError = (err) => {
      console.log(err);
      mcp_alerts.error("There was an error saving your event:" + err);
    };

    this.connect(DATA, onSuccess, onError);
  }
}
