import {useState} from 'react';

export default function ChangeDis(){
	const [vis, setVis]=useState(true);
	
	const hideElement=()=>{
		setVis((prev) => !prev);
	};
	return(
		//set return
	);
}