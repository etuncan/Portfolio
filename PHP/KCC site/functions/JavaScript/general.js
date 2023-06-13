document.addEventListener("contextmenu",
	function setListener(e){
		if(e.target.className==="no-click"){
			e.preventDefault();
		}
	}
);

let dvh=window.innerHeight*0.01;
document.documentElement.style.setProperty("--dvh",`${dvh}px`);
window.addEventListener("resize",()=>{let dvh=window.innerHeight*0.01;
document.documentElement.style.setProperty("--dvh",`${dvh}px`);});