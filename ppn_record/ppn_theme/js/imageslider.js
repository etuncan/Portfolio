function gsSlider(){
	const root=document.getElementById('ppn_gs-cont');
	const frame=root.querySelector('.gs-box');
	const list=root.querySelector('.gs-control').querySelectorAll('a');
	let curr_list_item=root.querySelector('a[class="active"]');
	const listener=SwipeListener(frame);
	const interval_time=10000;	
	let active_index=0;
	let offset=0;
	let interval_id=null;
	let item_width=frame.offsetWidth;

	frame.addEventListener('swipe', function(e){
		if(e.detail.directions.left===true){
			stopTimer();
			cycle();
		}
		else if(e.detail.directions.right===true){
			stopTimer();
			curr_list_item.classList.remove('active');
			active_index=active_index > 0 ? active_index-1:(list.length - 1);
			curr_list_item=list[active_index]; //update curr_list_item
			swapper();
			curr_list_item.classList.add('active');
		}
	});
	
	list.forEach((item) => {
		item.addEventListener('click', onButtonClick);
	});
	
	const resizeObserver = new ResizeObserver((entries) => {
  		for (const entry of entries){
			const curr_width=entry.contentBoxSize[0].inlineSize;
			if(curr_width!==item_width){
				item_width=curr_width;
				frame.style.transform='translate3d(-' + (active_index * curr_width) + 'px,0px,0px)';
			}
		}		
	});
	
	function swapper(){
		offset=active_index * frame.offsetWidth;
		frame.style.transform='translate3d(-' + offset + 'px,0px,0px)';
	}	
	
	function onButtonClick(){
		toggle(this);
	}
	
	function toggle(e){
		if(e.classList.contains('active')){
			return;
		}
		stopTimer();
		curr_list_item.classList.remove('active'); //remove class
		curr_list_item=e;
		curr_list_item.classList.add('active'); //add class		
		active_index=Array.from(list).findIndex(el => el.classList.contains('active'));
		swapper();
	}
	//Toggle Functions^^^
	
	function cycle(){
		curr_list_item.classList.remove('active');
		active_index=active_index < (list.length - 1) ? active_index+1:0;
		curr_list_item=list[active_index]; //update curr_list_item
		swapper();
		curr_list_item.classList.add('active');
	}//changes menu item tagged as active, calls swapper func
	
	function startTimer(){
		interval_id=setInterval(()=>cycle(), interval_time);
	}
	
	function stopTimer(){
		clearInterval(interval_id);
		interval_id=null;
	}
	//Interval Functions ^^^
	resizeObserver.observe(frame);
	startTimer();//initiate timer
}
window.addEventListener('load', gsSlider);
