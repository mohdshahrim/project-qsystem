<!DOCTYPE html>
<html lang="en">
<head>
<title>Database Management | Qsystem</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="/css/w3.css">
<link rel="stylesheet" href="/css/w3-theme-black.css">
<link rel="stylesheet" href="/css/font-awesome.min.css">
<style>
html,body,h1,h2,h3,h4,h5,h6 {font-family: "Roboto", sans-serif;}
.w3-sidebar {
    z-index: 3;
    width: 250px;
    top: 39px;
    bottom: 0;
    height: inherit;
}
.card-150 {
    width: 150px;
    height: 150px;
    text-align: center;
}
.text-6xl {
    font-size: 3.75rem;
    line-height: 1;
}
/* suitable for text inside td */
.align-middle {
    vertical-align: middle;
}
</style>
</head>
<body>

<!-- Navbar -->
<div class="w3-top">
    <div class="w3-bar w3-theme w3-top w3-left-align">
        <a class="w3-bar-item w3-button w3-right w3-hide-large w3-hover-white w3-large w3-theme-l1" href="javascript:void(0)" onclick="w3_open()"><i class="fa fa-bars"></i></a>
        <a href="/home" class="w3-bar-item w3-button w3-hover-white">Home</a>
        <a href="/my-account" class="w3-bar-item w3-button w3-theme-l1">My Account</a>
        <a href="/dm" class="w3-bar-item w3-button w3-hover-white">Databases</a>
        <a href="#" class="w3-bar-item w3-button w3-hover-white">Setting</a>
        <a href="./version.html" class="w3-bar-item w3-button w3-hover-white">Version</a>

        <!-- logout -->
        <a href="/logout" class="w3-bar-item w3-button w3-red w3-hover-white w3-right">
            Logout
        </a>
    </div>
</div>

<!-- Sidebar -->
<nav class="w3-sidebar w3-bar-block w3-collapse w3-theme-l5" id="mySidebar">
    <a href="javascript:void(0)" onclick="w3_close()" class="w3-right w3-xlarge w3-padding-large w3-hover-black w3-hide-large" title="Close Menu">
        <i class="fa fa-remove"></i>
    </a>
    <h4 class="w3-bar-item"><b>bla bla</b></h4>
    <a class="w3-bar-item w3-button w3-hover-black" href="#">bla bla</a>
</nav>

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- Main content: shift it to the right by 250 pixels when the sidebar is visible -->
<div class="w3-main" style="margin-left:250px">