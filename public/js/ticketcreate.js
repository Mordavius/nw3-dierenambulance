function next () {
    if(page1.style.display === "block")
    {
        page1.className = "slideOutLeft animated";
        page2.className = "slideInRight animated";
        setTimeout(function()
        {
            page1.style.display = "none";
            page2.style.display = "block";
            circle1.className = "circle circle1"
            circle2.className = "circle circle2 highlighted"},
            1000);
    }
    if(page2.style.display === "block")
     {
        page2.className = "slideOutLeft animated";
        page3.className = "slideInRight animated";
        setTimeout(function()
        {
            page3.style.display = "none";
            page3.style.display = "block";
            circle2.className = "circle circle2";
            circle3.className = "circle circle3 highlighted";
            map.style.height = "400px";
            $scope.map.setView([53.03, 5.7], 10);
            $scope.map.invalidateSize();
        },
            1000);
    }
}
