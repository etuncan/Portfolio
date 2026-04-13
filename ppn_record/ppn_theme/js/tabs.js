class Tabs{
	constructor(domNode){
		this.buttonEl=domNode;
		const buttonId=this.buttonEl.firstElementChild.getAttribute('id');
		const controlId=this.buttonEl.getAttribute('aria-controls');
		this.parentEl=this.buttonEl.parentElement;
		this.contentEl=document.getElementById(controlId); 
		this.opened=this.buttonEl.getAttribute('data-open-status')==='1';
		const tabId=location.hash;
		if(tabId===("#"+buttonId)&&!this.opened){
			this.toggle(!this.opened);
		}
		
		// add event listeners
		this.buttonEl.addEventListener('click', this.onButtonClick.bind(this));
	}//*contructor end
	
	onButtonClick(){
		this.toggle(!this.opened);
	}	
	
	toggle(opened){
		// don't do anything if the opened state doesn't change
		if(opened===this.opened){
			return;
		}
		// update the internal state
		this.opened=opened;

		// handle DOM updates
			let y=this.findOpened();
			document.getElementById(y.getAttribute('aria-controls')).classList.toggle('content-hide');
			y.setAttribute('data-open-status','0');
			this.buttonEl.setAttribute('data-open-status','1');
			this.contentEl.classList.toggle('content-hide');
	}//*toggle end
	findOpened(){
		return this.parentEl.querySelector("button[data-open-status='1']");	
	}
}
window.addEventListener('load', ()=>{
// init tabs
const ppnTabs=document.querySelectorAll('.tab-trig');	
ppnTabs.forEach((tabEl) => {new Tabs(tabEl);});
});
