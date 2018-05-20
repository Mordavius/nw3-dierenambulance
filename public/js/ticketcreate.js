function next () {
    if(page1.style.display === "block")
    {
        page1.className = "slideOutLeft animated";
        page2.className = "slideInRight animated";
        setTimeout(function()
        {
            page1.style.display = "none";
            page2.style.display = "block";},
            1000);
    }
    if(page2.style.display === "block")
     {
        page2.className = "slideOutLeft animated";
        page3.className = "slideInRight animated";
        setTimeout(function()
        {
            page3.style.display = "none";
            page3.style.display = "block";},
            1000);
    }
}
