class MCPEvents {
  constructor() {
    this.api = new MCPApi();
    this.fields = {
      location: 'input[name="cf7_custom_field_name[]"]',
      eventId: 'input[name="cf7_custom_field_eventId[]"]',
      date: 'input[name="cf7_custom_field_date[]"]',
      time: 'input[name="cf7_custom_field_time[]"]',
    };
  }

  getOptionKey(e) {
    return e.target.dataset.scope;
  }

  remove = (e) => {
    e.preventDefault();
    const optionKey = this.getOptionKey(e);
    const tableRow = e.target.closest(".custom-field-row");
    const tableRows = document.querySelectorAll(".custom-field-row");
    const rowId = tableRow.dataset.id;
    const isDraft = !rowId;
    const isTableMultiRow = tableRows.length > 1;
    const isTableSingleRow = tableRows.length === 1;
    const isAlertVisible = MCPAlerts.isVisible();
    const msg_warn = "Hmm there should be at least one row in the table";
    const msg_confirm = "Are you sure you want to remove this event?";

    if (isDraft) {
      if (isTableMultiRow) tableRow.remove();
      if (isTableSingleRow && !isAlertVisible) mcp_alerts.warn(msg_warn);
      return;
    }

    if (confirm(msg_confirm)) {
      this.api.removeEvent(rowId, optionKey, () => tableRow.remove());
    }
  };

  save = (e) => {
    e.preventDefault();
    const data = [];
    const optionKey = this.getOptionKey(e);
    const msg_error = "All fields are required";
    const tableRows = document.querySelectorAll("tbody tr");
    let shouldSave = true;

    for (const row of tableRows) {
      const item = {
        location: row.querySelector(this.fields.location).value,
        eventId: row.querySelector(this.fields.eventId).value,
        date: row.querySelector(this.fields.date).value,
        time: row.querySelector(this.fields.time).value,
      };
      const hasEmptyVal = MCPUtils.objHasEmptyValues(item);
      if (hasEmptyVal) {
        shouldSave = false;
        break;
      } else {
        data.push(item);
      }
    }

    if (shouldSave) this.api.saveEvents(data, optionKey);
    else mcp_alerts.error(msg_error);
  };
}
