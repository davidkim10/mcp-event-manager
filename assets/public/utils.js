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
        workshop: ".mcp_workshops_target",
        webinar: ".mcp_webinars_target",
      },
      source: {
        workshop: ".mcp_workshops_field",
        webinar: ".mcp_webinars_field",
      },
    };
  }

  init() {
    const keys = Object.keys(this.select.targets);
    keys.forEach((key) => {
      source.style.display = "none";
      const targetClassName = this.select.targets[key];
      const sourceClassName = this.select.source[key];
      const target = document.querySelector(targetClassName);
      const source = document.querySelector(sourceClassName);
      this.select.assign(target, source);
    });
  }
}

document.addEventListener("DOMContentLoaded", () => {
  window.wpmcp_utils = new WPMCP_Utils();
});
