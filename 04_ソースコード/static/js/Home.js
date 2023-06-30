let creation,launch_background,add_launch_area;
creation = document.getElementById("creation");
launch_background = document.getElementById("launch_background");
add_launch_area = document.getElementById("add_launch_area");
creation.addEventListener("click",creationopen);
launch_background.addEventListener("click",creationclose);
function creationopen(){
    add_launch_area.hidden = false;
    launch_background.hidden = false;
}
function creationclose(){
    add_launch_area.hidden = true;
    launch_background.hidden = true;
}