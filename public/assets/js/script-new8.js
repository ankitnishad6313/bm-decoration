try {
    const dynamicLinkPlus = document.querySelectorAll(".alink-holder");
    dynamicLinkPlus.forEach((e) => {
        e.addEventListener("click", () => {
            const nextElem = e.nextElementSibling;
            if (nextElem) {
                const img = e.querySelector("img");
                nextElem.classList.toggle("flex");
                if (nextElem.classList.contains("flex")) {
                    img.src = "../icons/minus.svg";
                } else {
                    img.src = "../icons/plus.svg";
                }
            }
        });
    });
} catch (err) {}

function viewSimilar() {
    document.querySelector(".modal-holder").classList.toggle("block");
}
function viewAddon() {
    document.querySelector(".addon-modal").classList.toggle("block");
}
function viewCityPopup() {
   document.querySelector(".modal-wrapper").classList.toggle("blocked");
}
function viewOrderSummary() {
    document.querySelector(".order-details-modal").classList.toggle("blocked");
}
function moveNext() {
    let e = document.querySelector(".similar-products-slider");
    e.scrollLeft += e.offsetWidth;
}
function movePrev() {
    let e = document.querySelector(".similar-products-slider");
    e.scrollLeft -= e.offsetWidth;
}
function filterCities() {
    let e = document.querySelector(".city-search > input").value.toLowerCase(),
        t = document
            .querySelector(".city-search-list")
            .getElementsByTagName("button");
    for (let r = 0; r < t.length; r++) {
        let s = t[r];
        (s.textContent || s.innerText).toLowerCase().indexOf(e) > -1
            ? (s.style.display = "flex")
            : (s.style.display = "none");
    }
}
function filterDecorations() {
    let e = document
            .querySelector(".search-holder > input")
            .value.toLowerCase(),
        t = document.querySelectorAll(".trending-btnm");
    for (let r = 0; r < t.length; r++) {
        let s = t[r];
        (s.textContent || s.innerText).toLowerCase().indexOf(e) > -1
            ? (s.style.display = "flex")
            : (s.style.display = "none");
    }
}
function filterDecorationsDesktop() {
    document.querySelector(".desktop-searcg-results").style.display = "block";
    let e = document.querySelector(".searchHolder > input").value.toLowerCase(),
        t = document.querySelector(".trending-container").querySelectorAll("a");
    for (let r = 0; r < t.length; r++) {
        let s = t[r];
        (s.textContent || s.innerText).toLowerCase().indexOf(e) > -1
            ? (s.style.display = "flex")
            : (s.style.display = "none");
    }
}
function filterOrders() {
    let e = document.getElementById("searchOrderInput").value.toUpperCase(),
        t = document
            .getElementById("orderTableBody")
            .getElementsByTagName("tr");
    for (let r = 0; r < t.length; r++) {
        let s = t[r].getElementsByTagName("td")[0];
        s &&
            ((s.textContent || s.innerText).toUpperCase().indexOf(e) > -1
                ? (t[r].style.display = "")
                : (t[r].style.display = "none"));
    }
}
function passwordViewer(e) {
    let t = document.querySelector(".account-password");
    "password" === t.type
        ? ((t.type = "text"), (e.src = "../assets/icons/eye.svg"))
        : ((t.type = "password"), (e.src = "../assets/icons/eye-slash.svg"));
}
function confirmPasswordViewer(e) {
    let t = document.querySelector(".confirm-password");
    "password" === t.type
        ? ((t.type = "text"), (e.src = "../assets/icons/eye.svg"))
        : ((t.type = "password"), (e.src = "../assets/icons/eye-slash.svg"));
}

// document.addEventListener("keydown", function (e) {
//   ("F12" === e.key ||
//     (e.ctrlKey && e.shiftKey && "I" === e.key) ||
//     (e.metaKey && e.altKey && "I" === e.key)) &&
//     e.preventDefault();
// }),

document.querySelectorAll(".questions").forEach((e) => {
    e.addEventListener("click", () => {
        let t = e.nextElementSibling,
            r = e.querySelector("img");
        t.classList.toggle("visible"),
            t.classList.contains("visible")
                ? (r.style.transform = "rotate(45deg)")
                : (r.style.transform = "rotate(0deg)");
    });
});
try {
    function e() {
        let e = document.getElementById("new-password").value,
            t = document.getElementById("confirm-password").value,
            r = !0;
        return (
            e.length < 6
                ? ((document.getElementById("password-error").textContent =
                      "Password must be at least 6 characters long."),
                  document
                      .getElementById("new-password")
                      .classList.add("wrong-input"),
                  (r = !1))
                : (document.getElementById("password-error").textContent = ""),
            e !== t
                ? ((document.getElementById(
                      "confirm-password-error"
                  ).textContent = "Passwords do not match."),
                  document
                      .getElementById("confirm-password")
                      .classList.add("wrong-input"),
                  (r = !1))
                : (document.getElementById(
                      "confirm-password-error"
                  ).textContent = ""),
            r
        );
    }
    document
        .querySelector("#new-password")
        .addEventListener("input", function () {
            if (this.value.length >= 6)
                for (wp of (document
                    .querySelector(".correct-password")
                    .classList.remove("hidden"),
                document
                    .querySelector("#new-password")
                    .classList.add("correct-input"),
                document
                    .querySelector("#new-password")
                    .classList.remove("wrong-input"),
                document.querySelectorAll(".wrong-number")))
                    wp.classList.add("hidden");
            else
                for (wp of (document
                    .querySelector(".correct-password")
                    .classList.add("hidden"),
                document
                    .querySelector("#new-password")
                    .classList.remove("correct-input"),
                document
                    .querySelector("#new-password")
                    .classList.remove("wrong-input"),
                document.querySelectorAll(".wrong-number")))
                    wp.classList.add("hidden");
        }),
        document
            .querySelector("#confirm-password")
            .addEventListener("input", function () {
                if (this.value.length >= 6)
                    for (wp of (document
                        .querySelector(".correct-password")
                        .classList.remove("hidden"),
                    document
                        .querySelector("#confirm-password")
                        .classList.add("correct-input"),
                    document
                        .querySelector("#confirm-password")
                        .classList.remove("wrong-input"),
                    document.querySelectorAll(".wrong-number")))
                        wp.classList.add("hidden");
                else
                    for (wp of (document
                        .querySelector(".correct-password")
                        .classList.add("hidden"),
                    document
                        .querySelector("#confirm-password")
                        .classList.remove("correct-input"),
                    document
                        .querySelector("#confirm-password")
                        .classList.remove("wrong-input"),
                    document.querySelectorAll(".wrong-number")))
                        wp.classList.add("hidden");
            });
} catch (t) {}
function filterDecorationsHide() {
    document.querySelector(".desktop-searcg-results").style.display = "none";
}
function filterDecorationShow() {
    document.querySelector(".desktop-searcg-results").style.display = "block";
}
const suggestionContainer = document.querySelector(".desktop-searcg-results"),
    desktopSearch = document.querySelector(".searchHolder > input");
function viewSidebar() {
    document.querySelector(".sidemenu-wrapper").classList.toggle("block");
}
function viewSignin() {
    document.querySelector(".sign-in-modal").classList.toggle("blocked");
}
function viewSearchbar() {
    document.querySelector(".search-container").classList.toggle("block");
}
document.addEventListener("click", (e) => {
    suggestionContainer.contains(e.target) ||
        e.target === desktopSearch ||
        filterDecorationsHide();
});
try {
    document
        .querySelector("#first-form")
        .addEventListener("submit", function (e) {
            e.preventDefault();
            let t = document.getElementById("number").value.trim();
            if (t.length < 10 && t.length > 0) {
                for (error of document.querySelectorAll(".wrong-number"))
                    error.classList.remove("hidden");
                document.querySelector("#number").classList.add("wrong-input");
            }
            10 === t.length &&
                $.ajax({
                    type: "POST",
                    url: "https://www.7eventzz.com/ajax/ajax.php",
                    data: { number_key: t, action: "stepone" },
                    success: function (e) {
                        var t = e.split(" || ");
                        "OLD" == t["0"]
                            ? ($("#changenumber").val(t["1"]),
                              $("#changenumbertext").text(t["1"]),
                              $(".password_label").html("Enter Password"),
                              $("#first-form").addClass("signup-fadeout"),
                              document
                                  .querySelector("#second-form-old")
                                  .classList.remove("hidden"))
                            : "NEW" == t["0"] &&
                              ($("#changenumber1").val(t["1"]),
                              $("#changenumbertext1").text(t["1"]),
                              $("#first-form").addClass("signup-fadeout"),
                              document
                                  .querySelector("#second-form")
                                  .classList.remove("hidden"));
                    },
                });
        }),
        $("#change").click(function () {
            var e = $("#changenumber").val();
            $("#second-form-old").addClass("hidden"),
                $("#second-form").addClass("hidden"),
                $("#first-form").removeClass("signup-fadeout"),
                $("number").val(e);
        }),
        $("#change1").click(function () {
            var e = $("#changenumber1").val();
            $("#second-form-old").addClass("hidden"),
                $("#second-form").addClass("hidden"),
                $("#first-form").removeClass("signup-fadeout"),
                $("number").val(e);
        }),
        document
            .getElementById("number")
            .addEventListener("input", function () {
                let e = this.value.trim();
                if (
                    ((this.value = this.value.replace(/\D/g, "")),
                    e.length > 10 && (this.value = e.slice(0, 10)),
                    10 === e.length)
                ) {
                    for (error of document.querySelectorAll(".wrong-number"))
                        error.classList.add("hidden");
                    document
                        .querySelector(".correct-number")
                        .classList.remove("hidden"),
                        document
                            .querySelector("#number")
                            .classList.remove("wrong-input"),
                        document
                            .querySelector("#number")
                            .classList.add("correct-input");
                } else {
                    for (error of document.querySelectorAll(".wrong-number"))
                        error.classList.add("hidden");
                    document
                        .querySelector(".correct-number")
                        .classList.add("hidden"),
                        document
                            .querySelector("#number")
                            .classList.remove("wrong-input"),
                        document
                            .querySelector("#number")
                            .classList.remove("correct-input");
                }
            }),
        document.getElementById("name").addEventListener("input", function () {
            if (this.value.trim().length >= 3) {
                for (wrongname of (document
                    .querySelector(".correct-name")
                    .classList.remove("hidden"),
                document.querySelectorAll(".wrong-name")))
                    wrongname.classList.add("hidden");
                document.querySelector("#name").classList.remove("wrong-input"),
                    document
                        .querySelector("#name")
                        .classList.add("correct-input");
            } else {
                for (wrongname of (document
                    .querySelector(".correct-name")
                    .classList.add("hidden"),
                document.querySelectorAll(".wrong-name")))
                    wrongname.classList.add("hidden");
                document.querySelector("#name").classList.remove("wrong-input"),
                    document
                        .querySelector("#name")
                        .classList.remove("correct-input");
            }
        }),
        document
            .getElementById("passwordnew")
            .addEventListener("input", function () {
                if (this.value.trim().length >= 6) {
                    for (wrongname of (document
                        .querySelector(".correct-name")
                        .classList.remove("hidden"),
                    document.querySelectorAll(".wrong-name")))
                        wrongname.classList.add("hidden");
                    document
                        .querySelector("#name")
                        .classList.remove("wrong-input"),
                        document
                            .querySelector("#name")
                            .classList.add("correct-input");
                } else {
                    for (wrongname of (document
                        .querySelector(".correct-name")
                        .classList.add("hidden"),
                    document.querySelectorAll(".wrong-name")))
                        wrongname.classList.add("hidden");
                    document
                        .querySelector("#name")
                        .classList.remove("wrong-input"),
                        document
                            .querySelector("#name")
                            .classList.remove("correct-input");
                }
            });
} catch (r) {
    console.log(r);
}
// document.querySelector(".password-view").addEventListener("click", function () {
//     let e = document.querySelector("#password");
//     "password" === e.type
//         ? ((e.type = "text"), (this.src = "../assets/icons/eye.svg"))
//         : ((e.type = "password"), (this.src = "../assets/icons/eye-slash.svg"));
// }),
//     document
//         .querySelector(".password-view2")
//         .addEventListener("click", function () {
//             let e = document.querySelector("#passwordnew");
//             "password" === e.type
//                 ? ((e.type = "text"), (this.src = "../assets/icons/eye.svg"))
//                 : ((e.type = "password"),
//                   (this.src = "../assets/icons/eye-slash.svg"));
//         }),
//     document
//         .querySelector("#second-form")
//         .addEventListener("submit", function (e) {
//             e.preventDefault();
//             let t = document.getElementById("name").value.trim();
//             if (t.length < 3) {
//                 for (wrongname of document.querySelectorAll(".wrong-name"))
//                     wrongname.classList.remove("signup-fadeout");
//                 document.querySelector("#name").classList.add("wrong-input");
//             }
//             let r = document.getElementById("passwordnew").value.trim();
//             if (t.length >= 3 && r.length < 6 && r.length > 0)
//                 for (wp of (document
//                     .querySelector("#passwordnew")
//                     .classList.add("wrong-input"),
//                 document.querySelectorAll(".wrong-number")))
//                     wp.classList.remove("hidden");
//             else
//                 $.ajax({
//                     type: "POST",
//                     url: "https://www.7eventzz.com/ajax/ajax.php",
//                     data: {
//                         name_key: t,
//                         password_key: r,
//                         action: "steptwonew",
//                     },
//                     success: function (e) {
//                         "NEW" == e &&
//                             setTimeout(() => {
//                                 location.reload();
//                             }, 800);
//                     },
//                 });
//         }),
//     document
//         .querySelector("#second-form-old")
//         .addEventListener("submit", function (e) {
//             e.preventDefault();
//             let t = document.querySelector("#password").value.trim();
//             if (t.length < 6 && t.length > 0)
//                 for (wp of (document
//                     .querySelector("#password")
//                     .classList.add("wrong-input"),
//                 document.querySelectorAll(".wrong-number")))
//                     wp.classList.remove("hidden");
//             else
//                 $.ajax({
//                     type: "POST",
//                     url: "https://www.7eventzz.com/ajax/ajax.php",
//                     data: { password_key: t, action: "steptwoold" },
//                     success: function (e) {
//                         "WRONGPASS" == e
//                             ? $(".password_wrong").html(
//                                   "Please Re-Enter Password"
//                               )
//                             : ($(".login-msg").addClass("block"),
//                               setTimeout(() => {
//                                   location.reload();
//                               }, 1e3));
//                     },
//                 });
//         }),
    // document.querySelector("#password").addEventListener("input", function () {
    //     if (this.value.length >= 6)
    //         for (wp of (document
    //             .querySelector(".correct-password")
    //             .classList.remove("hidden"),
    //         document.querySelector("#password").classList.add("correct-input"),
    //         document.querySelector("#password").classList.remove("wrong-input"),
    //         document.querySelectorAll(".wrong-number")))
    //             wp.classList.add("hidden");
    //     else
    //         for (wp of (document
    //             .querySelector(".correct-password")
    //             .classList.add("hidden"),
    //         document
    //             .querySelector("#password")
    //             .classList.remove("correct-input"),
    //         document.querySelector("#password").classList.remove("wrong-input"),
    //         document.querySelectorAll(".wrong-number")))
    //             wp.classList.add("hidden");
    // }),
   
    $(".logout").click(function () {
        $.ajax({
            type: "POST",
            url: "https://www.7eventzz.com/ajax/ajax.php",
            data: { action: "logout" },
            success: function (e) {
                "LOGOUT" == e &&
                    ($(".logout-msg").fadeIn(),
                    setTimeout(() => {
                        $(".logout-msg").fadeOut(), location.reload();
                    }, 1e3));
            },
        });
    });
