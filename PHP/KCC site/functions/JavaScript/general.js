document.addEventListener("contextmenu",
	function setListener(e){
		if(e.target.className==="no-click"){
			e.preventDefault();
		}
	}
);
function showMenu(){
	document.getElementById('menu-2-content').classList.toggle('hide-menu');
}
//Contrast Accessibility function
function dayNight(){
	let x=getComputedStyle(document.documentElement).getPropertyValue('--bg-color-op-1');
	let y=getComputedStyle(document.documentElement).getPropertyValue('--bg-color');
	if(x===y){
		document.documentElement.style.setProperty('--bg-color','var(--bg-color-op-2)');
		document.documentElement.style.setProperty('--text-color','var(--text-color-op-2)');
		document.documentElement.style.setProperty('--border-color','var(--border-color-op-2)');
	}
	else{
		document.documentElement.style.setProperty('--bg-color','var(--bg-color-op-1)');
		document.documentElement.style.setProperty('--text-color','var(--text-color-op-1)');
		document.documentElement.style.setProperty('--border-color','var(--border-color-op-1)');
	}
}
//Large Text Accessibility function
function largeText(){
	document.getElementById('access-article').classList.toggle('text-large');
}

function dyslexiaFont(){
	document.getElementById('access-article').classList.toggle('dyslexia-font');
}


//let dvh=window.innerHeight*0.01;
//document.documentElement.style.setProperty("--dvh",`${dvh}px`);
//window.addEventListener("resize",()=>{let dvh=window.innerHeight*0.01;
//document.documentElement.style.setProperty("--dvh",`${dvh}px`);});
