var mcp_utils = {
  select: {
    assign: function (target, source) {
      if (target && source) {
        Array.from(source.options).forEach(function (option) {
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
  },
  init() {
    var keys = Object.keys(mcp_utils.select.targets);
    keys.forEach(function (key) {
      var target = mcp_utils.select.targets[key];
      var source = mcp_utils.select.source[key];
      mcp_utils.select.assign(target, source);
    });
  },
};
