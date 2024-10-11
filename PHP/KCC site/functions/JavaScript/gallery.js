
let modal=document.getElementById("myModal");
let modalImage=document.getElementById("modalImage");
let active=document.getElementsByClassName("active");
let prev=document.getElementById("prev");
let next=document.getElementById("next");
let exit=document.getElementById("close");
var imageNum;
function listen(){
	for(i=0; i<active.length; i++){
		active[i].addEventListener("click",openModal);
		console.log(i);
	}
}
listen();

function openModal(){
	var i;
	
	modal.style.display="block";
	modalImage.src=this.src;
	for(i=0;i<active.length; i++){
		if(active[i].src===this.src){
			break;
		}
	}
	imageNum=i;
}


function closeModal(){
	modal.style.display="none";
}
exit.addEventListener("click",closeModal);


function switchImage(n){
	showImage(imageNum+=n);
}


function showImage(){
	console.log(imageNum);
	if(imageNum>=active.length){
		imageNum=0;
	}
	if(imageNum<0){
		imageNum=(active.length-1);
	}
	console.log(imageNum);
	modalImage.src=active[imageNum].src;
}

