
    !(function (a) {
  var t, p;
  a(document).ready(function () {
    function o(a) {
      for (
        var t = a + "=", p = document.cookie.split(";"), o = 0;
        o < p.length;
        o++
      ) {
        for (var n = p[o]; " " == n.charAt(0); ) n = n.substring(1);
        if (0 == n.indexOf(t)) return n.substring(t.length, n.length);
      }
      return "";
    }
    a(".wa__btn_popup").on("click", function () {
      a(".wa__popup_chat_box").hasClass("wa__active")
        ? (a(".wa__popup_chat_box").removeClass("wa__active"),
          a(".wa__btn_popup").removeClass("wa__active"),
          clearTimeout(p),
          a(".wa__popup_chat_box").hasClass("wa__lauch") &&
            (t = setTimeout(function () {
              a(".wa__popup_chat_box").removeClass("wa__pending"),
                a(".wa__popup_chat_box").removeClass("wa__lauch");
            }, 400)))
        : (a(".wa__popup_chat_box").addClass("wa__pending"),
          a(".wa__popup_chat_box").addClass("wa__active"),
          a(".wa__btn_popup").addClass("wa__active"),
          clearTimeout(t),
          a(".wa__popup_chat_box").hasClass("wa__lauch") ||
            (p = setTimeout(function () {
              a(".wa__popup_chat_box").addClass("wa__lauch");
            }, 100)));
    }),
      a("#nta-wa-gdpr").change(function () {
        if (this.checked) {
          var t, p;
          (t = new Date()).setTime(t.getTime() + 2592e6),
            (p = "expires=" + t.toUTCString()),
            (document.cookie = "nta-wa-gdpr=accept;" + p + ";path=/"),
            "" != o("nta-wa-gdpr") &&
              (a(".nta-wa-gdpr").hide(500),
              a(".wa__popup_content_item").each(function () {
                a(this).removeClass("pointer-disable"),
                  a(".wa__popup_content_list").off("click");
              }));
        }
      }),
      "" != o("nta-wa-gdpr")
        ? a(".wa__popup_content_list").off("click")
        : a(".wa__popup_content_list").click(function () {
            a(".nta-wa-gdpr")
              .delay(500)
              .css({ background: "red", color: "#fff" });
          });
  });
})(jQuery);
// close out script


