<?php
header("Content-Type: text/css; charset=utf-8");
header("Cache-Control: max-age=36000");
include 'shared_styles.css';
?>
body {
  background-color: #fff;
}
h1 {
  color: #072746;
  height: 43px;
  margin: 0;
  padding: 10px 0;
}
#allContent {
  width: 700px;
  margin: 0 auto 20px auto;
}
#mainContent {
  background-color: #14406B;
  -moz-box-shadow: 10px 10px 5px #888;
  -webkit-box-shadow: 10px 10px 5px #888;
  box-shadow: 10px 10px 5px #888;
  border: 1px solid #072746;
}
#top_img {
  float: left;
  height: 43px;
  margin-right: 10px;
}
input[type="button"] {
  height: 30px;
  cursor: pointer;
  margin: 10px 0;
}
input[type="select"] {
  cursor: pointer;
}
#loadingImg {
  margin: 10px 20px;
}
#firstWrapper {
  border-top: none;
}
.wrapper {
    border-top: 3px dashed #D29A48;
    margin: 0 8px;
    padding: 8px 0;
}