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
