.modal-dialog {
  width: 400px;
}

.modal-content {
  width: 400px;
}
.modal-body{
  padding-left: 50px;
  padding-right:50px;
}

button{
  display: inline-block;
  margin:0 5px 0 0;
  padding:15px 30px;
  font-size: 24px;
  line-height: 0.9;
  appearance:none;
  box-shadow: none;
  border-radius: 0;
  -moz-border-radius: 3px;
    -webkit-border-radius: 3px;
    border-radius: 3px;
}
button.flat{
  color:#fff;
  background-color: #00d3a3;
  text-shadow:-1px 1px #417cb8;
  border: none;
}
button.flat:hover{
  background-color: #00b180;
  text-shadow:-1px 1px #27496d;
}

button.flat:active{
background-color: #00b180;
text-shadow:-1px 1px #193047;
}
#email{
	width:340px;
	height:40px;
}
.inline-actions{
	position: absolute;
	right: 0;
	bottom: 20px;
	z-index: 1;
	overflow: hidden;
}
.check-icn{
	background: url(../assets/icons/checkmark-sm.png) center center no-repeat;
	width:34px; 
    height:34px;
}

.right-inner-addon {
    position: relative;
}
.right-inner-addon input {
    padding-right: 30px;    
}
.right-inner-addon button {
    position: absolute;
    right: -5px;
    pointer-events: none;
}
#search{
}
button.success,button.create{
	background-color: #00d3a3;
}
button.fail{
	background-color: #ffc000;
}
button.create{
	background-color: #00d3a3;
	color:#fff;
}
button.create:hover, button.create:active{
	background-color: #00b180;
	color:#fff;
}


input[type="text"], input[type="email"],input[type="password"]{

  background-color : #f7f7f7; 
  outline: none;
  border: 2px solid #e7e7e7 !important;
  -webkit-box-shadow: none !important;
  -moz-box-shadow: none !important;
  box-shadow: none !important;

}

input[type="text"]:focus, input[type="email"]:focus,input[type="password"]:focus{
  background-color : #e7e7e7; 
  outline: none;
  border: 2px solid #e7e7e7 !important;
  -webkit-box-shadow: none !important;
  -moz-box-shadow: none !important;
  box-shadow: none !important;
}