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
      hide: function () {
        const workshop = this.source.workshop;
        const webinar = this.source.webinar;
        [workshop, webinar].forEach((className) => {
          document.querySelector(className).style.display = "none";
        });
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
      const targetClassName = this.select.targets[key];
      const sourceClassName = this.select.source[key];
      const target = document.querySelector(targetClassName);
      const source = document.querySelector(sourceClassName);
      if (target && source) {
        this.select.assign(target, source);
        source.style.display = "none";
      }
    });
  }
}

document.addEventListener("DOMContentLoaded", () => {
  window.wpmcp_utils = new WPMCP_Utils();
});
