// public
class WPMCP_Utils {
  constructor() {
    this.select = {
      assign: (target, source) => {
        if (target && source) {
          Array.from(source.options).forEach((option) => {
            target.append(option);
          });
          target.selectedIndex = 0;
        }
      },
      targets: {
        live: document.querySelector(".mcp_workshops_target"),
        webinar: document.querySelector(".mcp_webinars_target"),
      },
      source: {
        live: document.querySelector(".mcp_live_events"),
        webinar: document.querySelector(".mcp_webinar_events"),
      },
    };
  }

  init() {
    const keys = Object.keys(this.select.targets);
    keys.forEach((key) => {
      const target = this.select.targets[key];
      const source = this.select.source[key];
      this.select.assign(target, source);
    });
  }
}

document.addEventListener("DOMContentLoaded", () => {
  window.wpmcp_utils = new WPMCP_Utils();
});
