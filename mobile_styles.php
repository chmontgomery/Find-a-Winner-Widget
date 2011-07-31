<?php
header("Content-Type: text/css; charset=utf-8");
header("Cache-Control: max-age=36000");
include 'shared_styles.css';
?>

body {
  color: #fff;
  background-color: #14406B;
}
a {
  color: #fff;
}
input[type="button"] {
  width: 100%;
  height: 30px;
  display: block;
  cursor: pointer;
  margin: 10px 0;
}
input[type="select"] {
  cursor: pointer;
}
.button a {
  background-color: #3D72A4;
  padding: 3px;
  text-decoration: none;
  color: white;
  border: solid 1px #fff;
  border-radius: 0.5em;
}
.button a:hover {
  background-color: #666;
}
.clickableSection {
  margin-bottom: 15px;
}
.wrapper {
  border-top: 4px solid #D29A48;
  padding: 6px;
}
h1 {
  margin: 0;
  padding: 3px;
}
#grp {
  width: 98%;
}
#items {
  width: 98%;
}
#loadingImg {
  margin: 10px auto;
  display: block;
}
#winnerName {
  font-weight: bold;
  font-size: 20px;
}
.radioWrapper {
  height: 30px;
}
.radioWrapper:hover {
  cursor: pointer;
  background-color: #6B4207;
}
