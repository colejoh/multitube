function hideText() {
    $("#newtext").hide("100");
}
$("button").click(hideText);

function showText() {
    $("#newtext").show("100");
}
$("#addsubmit").click(showText);
