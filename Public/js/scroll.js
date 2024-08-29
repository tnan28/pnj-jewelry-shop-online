window.addEventListener("scroll", function () {
    var header = document.querySelector(".header_home-main");
    var scrollYOffset = window.pageYOffset;
    if (scrollYOffset < 300) {

        header.style.borderBottomLeftRadius = "initial";
        header.style.borderBottomRightRadius = "initial";
    } else {

        header.style.borderBottomLeftRadius = "100px";
        header.style.borderBottomRightRadius = "100px";
    }
});