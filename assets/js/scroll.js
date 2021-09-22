function fnScrollToDiv(arg)
{
$('html, body').animate({
        scrollTop: $("#"+arg).offset().top
    }, 2000);
}