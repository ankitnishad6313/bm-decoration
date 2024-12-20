function viewAddon() {
    document.querySelector(".addon-modal").classList.toggle("block");
}
function viewInstructions() {
    document.querySelector(".instruction-modal").classList.toggle("block");
}
function viewSignin() {
    document.querySelector(".sign-in-modal").classList.toggle("block");
}
function goToBill() {
    document.querySelector(".payment").scrollIntoView({ behavior: "smooth" });
}

try {
    $(document).on("click", ".add-addon-btn", function () {
        let addon_count_with_price = 0;
        let countitem = $(this).closest("div").find("span.addon-counting").text();
        $(this).closest("div").find("span.addon-counting").text(parseInt(countitem) + 1);
        $(this).addClass("add-addon-added").data("custom-value2", parseInt(countitem) + 1);

        updateAddonData();
    });

    $(document).on("click", ".plus", function () {
        let countitem = $(this).closest("div").find("span.addon-counting").text();
        $(this).closest("div").find("span.addon-counting").text(parseInt(countitem) + 1);
        $(this).closest("div").next("button").addClass("add-addon-added").data("custom-value2", parseInt(countitem) + 1);

        updateAddonData();
    });

    $(document).on("click", ".minus", function () {
        let countitem = $(this).closest("div").find("span.addon-counting").text();

        if (parseInt(countitem) > 0) {
            $(this).closest("div").find("span.addon-counting").text(parseInt(countitem) - 1);
            $(this).closest("div").next("button").data("custom-value2", parseInt(countitem) - 1);
        }

        if (parseInt($(this).closest("div").find("span.addon-counting").text()) === 0) {
            $(this).closest("div").next("button").removeClass("add-addon-added").data("custom-value2", 0);
        }

        updateAddonData();
    });

    $(document).on("click", "#general-btn", function () {
        $("#popular-btn").removeClass("active-addon");
        $(this).addClass("active-addon");
        $(".populardiv").hide();
        $(".generaldiv").show();
    });

    $(document).on("click", "#popular-btn", function () {
        $("#general-btn").removeClass("active-addon");
        $(this).addClass("active-addon");
        $(".generaldiv").hide();
        $(".populardiv").show();
    });

    $(document).on("click", ".instruction-btn", function () {
        $("#instruction_cart_id").val($(this).attr("id"));
        $("#instruction_text").val($(".instruction_text_area").html());
    });

    $(document).on("click", ".instruction-cancle", function () {
        $(this).closest("form").find("#instruction_cart_id, #instruction_text").val("");
        viewInstructions();
    });

    $(document).on("click", ".instruction-save", function () {
        const cartid = $("#instruction_cart_id").val();
        const instruction_text = $("#instruction_text").val();

        if (instruction_text) {
            // Logic to handle the saved instructions
        }

        viewInstructions();
    });

    $(document).on("change", ".productquantity", function () {
        const productquantity = $(this).val();
        const cartid = $(this).data("cart-id");
    });

} catch (err) {
    console.error(err);
}

function updateAddonData() {
    let addon_ids = "";
    let addon_quantitys = "";
    let addon_count_with_price = 0;

    $(".add-addon-added").each(function () {
        addon_count_with_price += parseInt($(this).data("custom-value")) * parseInt($(this).data("custom-value2"));
        addon_ids += $(this).data("custom-value3") + ", ";
        addon_quantitys += $(this).data("custom-value2") + ", ";
    });

    addon_ids = addon_ids.slice(0, -2);
    addon_quantitys = addon_quantitys.slice(0, -2);

    console.log(addon_ids, addon_quantitys);
}
