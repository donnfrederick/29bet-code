let multiplier = 0;

function checkBets() {
    if (0 == multiplier) return multiplier;
    return $("#bet").val() * multiplier
}
$("#bet").on("keyup", function () {
    $("#money").attr("data-current-balance");
    0 != multiplier && $("#bet_profit").html(($(this).val() * multiplier).toFixed(2))
}), $(".add-valor").click(function () {
    $("#bet_profit").html(($("#bet").val() * multiplier).toFixed(2))
});
var __profit = function () {
    var t = "string" != typeof selected_color ? checkBets() : "green" === selected_color ? 14 * $("#bet").val() : 2 * $("#bet").val();
    isNaN(t) || $("#bet_profit").html(t.toFixed(2))
};
