function addLoadEvent(f){
    window.addEventListener("load", f);
}
function checkAdminBar(){
	const adminBar=document.getElementById('wpadminbar');
	const bodyEl=document.getElementsByTagName('body')[0];
	if(adminBar){
		bodyEl.classList.add('admin-bar-exists');
	}
}
console.log('test');
function setHeaderObject(){
	const HeaderItems={
		menucont:document.getElementById('primary-navigation'),
		menubutton:document.getElementById('primary-menu-button'),
		menu:document.getElementById('primary-menu'),
		page:document.getElementsByTagName('body')[0]
	};//set object
	HeaderItems.menulist=HeaderItems.menu.querySelectorAll(':scope > .menu-item-has-children > a');
	HeaderItems.submenulist=HeaderItems.menu.querySelectorAll(':scope .sub-menu > .menu-item-has-children > a');

	const mediaQuery= window.matchMedia("(max-width:768px)");
	
	function handleMediaQuery(e){
		if(e.matches){
			HeaderItems.menubutton.classList.add('button-show');
			HeaderItems.menu.classList.add('mobile-view');
			HeaderItems.menubutton.addEventListener('click',toggleMainMenu);
			for(n of HeaderItems.menulist){
				n.addEventListener('click', onMenuItemClick); 
			}
			setHover();
		}
		else{
			HeaderItems.menucont.classList.remove('mobile-menu-open');
			HeaderItems.menubutton.classList.remove('button-show');
			HeaderItems.menu.classList.remove('mobile-view');
			HeaderItems.menubutton.removeEventListener('click',toggleMainMenu);
			for(n of HeaderItems.menulist){
				n.removeEventListener('click', onMenuItemClick);
			}
			setHover('set');
		}
	}//function handling actions on media query state change
	//**Menu Top Level**
	function onMenuItemClick(){
		const element=this.nextElementSibling;
		console.log("tester");
		if(element.classList.contains('visible-el')){
			this.style.setProperty('--arrow-rotation','-90deg');
			element.classList.remove('visible-el');
		}
		else{
			this.style.setProperty('--arrow-rotation','0deg');
			removeClassFromList(HeaderItems.menu);
			element.classList.add('visible-el');
		}

	}
	//**Menu Sub Level**
   	function onSubItemClick(){
		const element=this.nextElementSibling;
		console.log('started');
		if(element.classList.contains('visible-el')){
			this.style.setProperty('--arrow-rotation','-90deg');
			element.classList.remove('visible-el');
		}
		else{
			this.style.setProperty('--arrow-rotation','0deg');
			removeClassFromList(element.parentElement.parentElement);
			element.classList.add('visible-el');
		}
	}
	
	let hoverTimeout;
	const hoverDelay=1000;
	
	function setHover(a){
		if(a==='set'){
			for(n of HeaderItems.submenulist){
				n.parentElement.parentElement.addEventListener('mouseleave',onHoverEnd);
				n.parentElement.parentElement.addEventListener('mouseenter',onHoverReturn);
			}
		}
		else{
			for(n of HeaderItems.submenulist){
				n.parentElement.parentElement.removeEventListener('mouseleave',onHoverEnd);
				n.parentElement.parentElement.removeEventListener('mouseenter',onHoverReturn);
			}
		}
	}
	
	function onHoverEnd(){
		hoverTimeout = setTimeout(() => {
        	removeClassFromList(HeaderItems.menu);
    	}, hoverDelay);	
	}
	function onHoverReturn(){
		clearTimeout(hoverTimeout);
	}
	
	function toggleMainMenu(){
		if(HeaderItems.menucont.classList.contains('mobile-menu-open')){
			HeaderItems.menucont.classList.remove('mobile-menu-open');
			HeaderItems.menubutton.dataset.open='no';
			HeaderItems.page.classList.remove('no-scroll');
			removeClassFromList(HeaderItems.menu);
		}
		else if(HeaderItems.menucont.classList.contains('mobile-menu-open')===false){
			HeaderItems.menucont.classList.add('mobile-menu-open');
			HeaderItems.menubutton.dataset.open='yes';
			HeaderItems.page.classList.add('no-scroll');			
		}
	}
	
	function removeClassFromList(x){
		const nl=x.querySelectorAll('.visible-el');
		for(n of nl){			
			n.classList.remove('visible-el');
			n.previousElementSibling.style.setProperty('--arrow-rotation','-90deg');
		}
	}
	
	if(window.innerWidth<768){
		console.log("works");
		HeaderItems.menubutton.classList.add('button-show');
		HeaderItems.menu.classList.add('mobile-view');
		HeaderItems.menubutton.addEventListener('click',toggleMainMenu);
		console.log(HeaderItems.submenulist);
		for(n of HeaderItems.menulist){
			n.addEventListener('click', onMenuItemClick); 
		}
		for(p of HeaderItems.submenulist){
			p.addEventListener('click', onSubItemClick); 
		}
	}
	else{
		console.log('works2');
		setHover('set');
		for(n of HeaderItems.submenulist){
			n.addEventListener('click', onSubItemClick); 
		}
		for(n of HeaderItems.menulist){
			n.removeEventListener('click', onMenuItemClick); 
		}
	}
	mediaQuery.addEventListener('change', handleMediaQuery);
	//sets listener for change in breakpoint (important to set last)
	console.log('object has set');
}//**END setHeaderObject**

function setScrollTopButton(){
	const buttonEl=document.getElementById('scroll-top-button');
	window.addEventListener('scroll', (event)=>{
		if(window.scrollY > 20){
			buttonEl.style.display="block";
		}
		else{
			buttonEl.style.display="none";
		}
	});
	buttonEl.addEventListener('click', function(){
		window.scrollTo({top:0,left:0,behavior:'smooth'});
	});
}
addLoadEvent(checkAdminBar);
addLoadEvent(setHeaderObject);
addLoadEvent(setScrollTopButton);
