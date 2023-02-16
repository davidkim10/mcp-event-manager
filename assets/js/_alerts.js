class MCPAlerts {
  constructor() {
    this.target = jQuery(".cf7-mcp-alerts");
    this.container = jQuery(".cf7-mcp-alerts .container");
  }

  static isVisible() {
    return jQuery(".cf7-mcp-alerts:visible").length >= 1;
  }

  add(msg, type = "success") {
    this.type(type);
    this.show();
    this.container.text(msg);
    setTimeout(this.hide.bind(this), 5000);
  }

  error(msg) {
    this.add(msg, "error");
  }

  warn(msg) {
    this.add(msg, "warning");
  }

  hide() {
    this.target.slideUp(400, () => this.reset());
  }

  show() {
    this.target.slideDown();
  }

  reset() {
    this.container.text("");
    this.target.removeClass();
    this.target.addClass("cf7-mcp-alerts");
  }

  type(type) {
    this.target.addClass(type);
  }
}

const mcp_alerts = new MCPAlerts();
