var mcp_alerts = {
  target: jQuery(".cf7-mcp-alerts"),
  container: jQuery(".cf7-mcp-alerts .container"),
  add: function (msg, type = "success") {
    this.type(type);
    this.show();
    this.container.text(msg);
    setTimeout(mcp_alerts.hide, 5000);
  },
  error: function (msg) {
    this.add(msg, "error");
  },
  warn: function (msg) {
    this.add(msg, "warning");
  },
  hide: function () {
    mcp_alerts.target.slideUp(400, function () {
      mcp_alerts.reset();
    });
  },
  isVisible: function () {
    return jQuery(".cf7-mcp-alerts:visible").length === 1;
  },
  show: function () {
    this.target.slideDown();
  },
  reset: function () {
    this.container.text("");
    this.target.removeClass();
    this.target.addClass("cf7-mcp-alerts");
  },
  type: function (type) {
    this.target.addClass(type);
  },
};

var mcp_utils = {
  isEmptyRow: _mcp_isEmptyRow,
  getEmptyRows: _mcp_getEmptyRows,
  objHasEmptyVal: function (obj) {
    return Object.values(obj).some((val) => !val);
  },
};

function mcpCopyToClipBoard(event) {
  var inputElement = event.target.previousElementSibling;
  inputElement.select();
  document.execCommand("Copy");
  // alert("Copied the text: " + inputElement.value);
  mcp_alerts.add("Copied to clipboard");
}

function _mcp_isEmptyRow(row) {
  var input = row.querySelector("input[name='cf7_custom_field_name[]']");
  return !input.value;
}

function _mcp_getEmptyRows() {
  return jQuery(".custom-field-row")
    .toArray()
    .filter((row) => _mcp_isEmptyRow(row));
}
