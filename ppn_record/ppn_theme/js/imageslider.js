class GSlider{
	constructor(domNode){
		this.rootEl=domNode;
		this.boxEl=this.rootEl.querySelector('.gs-box');
		this.navEl=this.rootEl.querySelector('.gs-control');
		this.navList=this.navEl.querySelectorAll('a');
		this.slides=this.boxEl.querySelectorAll(':scope>.gs-face');
		this.acList=Array.from(this.navList).map(el=>el.getAttribute('aria-controls'));
		this.listLength=this.navList.length;
		this.activeIndex=0;
		this.intervalId=null;
		this.itemWidth=this.boxEl.offsetWidth;
		this.offset=0;
		this.intervalTime=10000;
		
		//find active button
		this.activeBtn=this.navEl.querySelector('a[class="active"]');
		//add Event Listener
		this.navList.forEach((a,index,arr)=>{
			arr[index].addEventListener('click',this.onBtnClick.bind(this));
		});
		const resizeObserver = new ResizeObserver((entries) => {
  			for (const entry of entries) {
    			const currentWidth=entry.contentBoxSize[0].inlineSize;
  			
				if(currentWidth!==this.itemWidth){
					this.itemWidth=currentWidth;
					this.boxEl.style.transform='translate3d(-' + (this.activeIndex * currentWidth) + 'px,0px,0px)';
				}
			}
		});
		resizeObserver.observe(this.boxEl);
		this.timer();
	}//**constructor END**
	onBtnClick(event){
		const targetEl=event.target;
		this.toggle(targetEl);
	}
	toggle(targetEl){
		if(targetEl.getAttribute('aria-controls')===this.activeBtn.getAttribute('aria-controls')){
			return;	
		}
		this.intervalId && this.stopTimer();
		this.activeBtn.classList.toggle('active'); //remove class
		this.activeBtn=targetEl; //update activeBtn
		this.activeIndex=this.acList.indexOf(this.activeBtn.getAttribute('aria-controls'));
		this.activeBtn.classList.toggle('active'); //add class
		this.swapper();
	}
	swapper(){
		this.offset=this.activeIndex * this.boxEl.offsetWidth;
		this.boxEl.style.transform='translate3d(-' + this.offset + 'px,0px,0px)';
	}
	cycle(){
		this.activeBtn.classList.toggle('active'); //remove class
		this.activeIndex=this.activeIndex < (this.listLength - 1) ? this.activeIndex+1:0;
		this.activeBtn=this.navList[this.activeIndex]; //update activeBtn
		this.swapper();
		this.activeBtn.classList.toggle('active'); //add class
	}
	timer(){
		this.intervalId=setInterval(()=>this.cycle(), this.intervalTime);
	}
	stopTimer(){
		clearInterval(this.intervalId);
		this.intervalId=null;
	}
}
window.onload=function(){
// init gs
const ppnGS=document.querySelectorAll('.gs-container');	
ppnGS.forEach(
	(gsEl) => {new GSlider(gsEl);}
);
};
