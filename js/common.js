function show(elementId)
{
var elementStyle = document.getElementById(elementId).style;
elementStyle.display = "block";
}

function hide(elementId)
{
var elementStyle = document.getElementById(elementId).style;
elementStyle.display = "none";
}

function toggleshow(elementId)
{
if(document.getElementById(elementId).style.display == "block")
{
hide(elementId);
}
else
{
show(elementId);
}
}