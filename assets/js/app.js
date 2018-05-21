jQuery(document).ready(function ($) {
    var index = 0;
    var item = blogs.blogItem[index];
    var photo = document.getElementById("photo");
    var id = document.getElementById("count");
    var previous = document.getElementById("previous");
    var next = document.getElementById("next");
    displayItem(item);
    previous.addEventListener("click", function() {
        displayItem(blogs.blogItem[--index]);
    });
    next.addEventListener("click", function() {
        displayItem(blogs.blogItem[++index]);
    });
    function displayItem(item) {
        photo.innerHTML = "<img src="+item.photo+" />";
        id.innerText = item.id;
        previous.disabled = index <= 0;
        next.disabled = index >= blogs.blogItem.length -1;
    }
});